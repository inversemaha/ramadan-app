@extends('layouts.admin')
@section('title', 'Status Edit')
@section('page', 'Status Edit')

@section('content')

    <div class="row">


        <div class="col-8 ">

            @include('includes.admin.message')


            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Status Edit</h4>
                    <form class="form-horizontal" method="post"
                          action="/admin/status/update" enctype="multipart/form-data">


                        @csrf


                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-2 col-form-label">নাম</label>
                            <div class="col-md-10">
                                <input class="form-control form-control-name" placeholder="নাম" name="name"
                                       id="f-name" type="text" required="" value="{{$result->name}}">
                                <input type="hidden" name="id" value="{{$result->id}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-2 col-form-label">ফোন নাম্বার</label>
                            <div class="col-md-10">
                                <input class="form-control form-control-phone" placeholder="ফোন নাম্বার "
                                       name="phone" id="phone" type="phone" required="" value="{{$result->phone}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-2 col-form-label">ফেসবুক ভিডিও লিংক</label>
                            <div class="col-md-10">
                                <textarea rows="5" class="form-control form-control-phone" placeholder="ফেসবুক ভিডিও লিংক"
                                          name="fb_link" id="fb_link_input" type="text" >{!! $result->fb_link  !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-2 col-form-label">স্মৃতিকথা</label>
                            <div class="col-md-10">
                                     <textarea rows="10" class="form-control form-control-phone"
                                               placeholder="স্মৃতিকথা........ "
                                               name="status" id="msg_input" type="text">{!! $result->status !!}</textarea>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="" class="col-md-2 col-form-label"></label>
                            <div class="col-md-10">
                                <button class="btn btn-primary w-md waves-effect waves-light"
                                        type="submit">Update
                                </button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div> <!-- end col -->
    </div>


@endsection
