@extends('layouts.admin')
@section('title', 'Applicants')
@section('page', 'Applicants')

@section('content')
    <style>
        .modal-dialog,
        .modal-content {
            /* 80% of window height */
            height: 100%;
        }

        .modal-body {
            /* 100% = dialog height, 120px = header + footer */
            max-height: calc(100% - 120px);
            overflow-y: scroll;
        }

        .rotater {
            transition: all 0.3s ease;
            border: 0.0625em solid #f3f3f3;
        }

        label {
            padding: 0px 31px;
        }
    </style>

    <script>
        let rotateAngle = 90;

        function rotate(image) {
            image.setAttribute("style", "transform: rotate(" + rotateAngle + "deg)");
            rotateAngle = rotateAngle + 90;
        }
    </script>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Status Applicants</h4>
                    <a class=" m-2 btn btn-sm btn-success" href="/admin/status/applicants?winner=1">Winner List</a>

                    <table id="datatable-buttonss" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>User Input</th>
                            <th>Winner</th>
                            <th>Active</th>
                            <th>Action</th>


                        </tr>
                        </thead>


                        <tbody>
                        <?php
                        $i = $start_number;
                        ?>
                        @foreach($data as $res)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$res->name}}</td>
                                <td>{{$res->phone}}</td>

                                <td>

                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                            data-target="#modelId{{$res->id}}">
                                        Status
                                    </button>


                                    <div class="modal fade" id="modelId{{$res->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if($res->fb_link != null)
                                                        <iframe
                                                            src="https://www.facebook.com/plugins/post.php?href=https://www.facebook.com/DainikJugantor/posts/{{$res->fb_link}}&show_text=true&width=500"
                                                            width="100%" height="200px"
                                                            style="border:none;overflow:hidden"
                                                            scrolling="no" frameborder="0" allowfullscreen="true"
                                                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">

                                                        </iframe>
                                                    @else
                                                        <div class="mb-2">
                                                            <p>{!! $res->status !!}</p>
                                                        </div>


                                                        <?php
                                                        $images = [];
                                                        if ($res->multi_images != null) {
                                                            $images = json_decode($res->multi_images, true);
                                                        }
                                                        ?>

                                                        @foreach ($images as $image)

                                                            <img src="{{ url('images/applicant/' . $image) }}"
                                                                 class="img-responsive mb-2" width="100%"
                                                                 alt="--">

                                                        @endforeach
                                                    @endif
                                                </div>


                                            </div>
                                        </div>

                                    </div>

                                </td>
                                <td><a target="_blank" href="{{$res->fb_user_input}}">{!! $res->fb_user_input !!}</a>
                                </td>

                                <td>

                                    @if($res->is_short_listed==1)
                                        <span class="badge badge-success">Yes</span>
                                        <br>
                                        <a href="/admin/winner/status-update/{{$res->id}}/0"
                                           class="btn btn-sm btn-danger">Change</a>
                                    @else
                                        <span class="badge badge-warning">No</span>
                                        <br>
                                        <a href="/admin/winner/status-update/{{$res->id}}/1"
                                           class="btn btn-sm btn-primary">Winner</a>
                                    @endif


                                </td>
                                <td>

                                    @if($res->is_active==1)
                                        <span class="badge badge-success">Yes</span>
                                        <a href="/admin/status/inactive/{{$res->id}}" class="btn btn-sm btn-danger">Inactive</a>
                                    @else
                                        <span class="badge badge-warning">No</span>
                                        <a href="/admin/status/active/{{$res->id}}" class="btn btn-sm btn-success">active</a>
                                    @endif
                                </td>
                                <td><a href="/admin/status/delete/{{$res->id}}"><i class="fa fa-trash"></i> </a>

                                    <a href="/admin/status/edit/{{$res->id}}"><i class="fa fa-edit"></i> </a></td>


                            </tr>
                        @endforeach
                        {{ $data->appends(Request::except('page'))->links("pagination::bootstrap-4") }}
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
