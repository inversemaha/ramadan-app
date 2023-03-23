@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page', 'Dashboard')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2"><a href="/admin/drawing"> Number of
                                            Status Received</a></p>
                                    <h4 class="mb-0">{{($mcq)}}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-user-2-fill font-size-24"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
           {{--     <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Total Selfie Submission</p>
                                    <h4 class="mb-0">{{$selfie}}</h4>
                                </div>
                                <div class="text-primary">
                                    <i class="ri-list-check font-size-24"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body overflow-hidden">
                                    <p class="text-truncate font-size-14 mb-2">Today's Question</p>
                                    @if(!is_null($question))
                                        <h4 class="mb-0">
                                            {{$question->question_title}}
                                        </h4>
                                    @endif
                                </div>
                                <div class="text-primary">
                                    <i class="ri-question-answer-fill font-size-24"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>--}}

            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end row -->


@endsection
