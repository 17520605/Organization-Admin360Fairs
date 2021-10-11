@extends('layouts.master')

@section('content')
    <div class="container-fluid line-time">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$webinar->topic}}</h4>
                        <h6 class="card-title">
                            <span>{{Carbon\Carbon::parse($webinar->startAt)->format('M d : h:m')}} </span>
                            to 
                            <span>{{Carbon\Carbon::parse($webinar->endAt)->format('M d : h:m')}} </span>
                            <span style="float: right;">Edit</span>
                        </h6>
                    </div>
                    <div class="card-body">
                        {{$webinar->description}}
                    </div>
                </div>
            </div>    
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Timeline</h5>
                    </div>
                    <!-- end card header -->
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="timeline">
                                    <div class="timeline-container">
                                        <div class="timeline-end">
                                            <p>Start</p>
                                        </div>
                                        <div class="timeline-continue">
                                            @php
                                                $time = Carbon\Carbon::parse($webinar->startAt);
                                            @endphp
                                            @foreach ($webinar->details as $detail)
                                            <div class="row timeline-box-card">
                                                <div class="col-md-6">
                                                    <div class="timeline-icon">
                                                        <i class="bx bx-briefcase-alt-2 text-primary h2 mb-0"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="timeline-box">
                                                        <div class="timeline-date bg-primary text-center rounded">
                                                            <h4 class="text-white mb-0"> {{$time->format('h')}}</h4>
                                                            <h5 class="text-white mb-0"> {{$time->format('m')}}'</h5>
                                                        </div>
                                                        <div class="event-content">
                                                            <div class="timeline-text">
                                                                <h3 class="font-size-18">{{$detail->speaker->name}}</h3>
                                                                <h3 class="font-size-18">{{$detail->title}}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $time =  $time->addMinutes($detail->duration);
                                            @endphp
                                            @endforeach
                                        </div>
                                        <div class="timeline-start">
                                            <p>End</p>
                                        </div>
                                        <div class="timeline-launch">
                                            <div class="timeline-box">
                                                <div class="timeline-text">
                                                    <h3 class="font-size-18">Launched our company on 21 June 2021</h3>
                                                    <p class="text-muted mb-0">Pellentesque sapien ut est.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>
@endsection
