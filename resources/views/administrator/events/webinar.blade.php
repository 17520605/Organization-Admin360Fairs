@extends('layouts.master')

@section('content')
    <div class="container-fluid line-time">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-primary font-weight-bold">{{$webinar->topic}}</h4>
                        <h6 class="card-title">
                            <div class="row">
                                <div class="col-3" style="margin-left: 20px;margin-top: 10px;">
                                    <span style="font-size:12px">Start at</span>
                                    <h6 style="font-size:15px"><i class="fas fa-calendar-alt mr-3" style="color: #4348dfb0;"></i><span>{{Carbon\Carbon::parse($webinar->startAt)->format('M-d g:i A')}}</span></h6>
                                </div>
                                <div class="col-3" style="margin-left: 20px;margin-top: 10px;">
                                    <span style="font-size:12px">End at</span>
                                    <h6 style="font-size:15px"><i class="fas fa-calendar-alt mr-3" style="color: #4348dfb0;"></i><span>{{Carbon\Carbon::parse($webinar->endAt)->format('M-d g:i A')}}</span></h6>
                                </div>
                                <div class="col-4" style="margin-left: 20px;margin-top: 10px;">
                                    <span style="font-size:12px">Register by</span>
                                    <h6 style="font-size:15px">
                                        <span><img src="{{(isset($webinar->registrant) && isset($webinar->registrant->avatar)) ? $webinar->registrant->avatar : 'https://res.cloudinary.com/virtual-tour/image/upload/v1637651914/Background/webinar-default-poster_f23c8z.jpg'}}" style="width: 30px; height: 30px; border-radius: 15px;">
                                        </span><span>{{isset($webinar->registrant) ? $webinar->registrant->name : 'N/A'}}</span>
                                    </h6>
                                </div>
                            </div>
                            <span class="btn-edit-webinars">
                                <button data-toggle="modal" data-target="#popup-delete-webinar">Delete</button>
                                <i class="fas fa-pen-square"></i>
                                <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}/edit">Edit</a>
                            </span>
                        </h6>
                    </div>
                    <div class="card-header">
                        <div>
                            <img src="{{$webinar->poster}}" alt="" style="width: 100%; height: 60vh;">
                        </div>
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
                        <div style="width: 100%; height: 30px; mb-2 "> <h5>Speakers</h5></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($webinar->speakers as $speaker)
                            <div class="col-lg-6">
                                <div class="row mb-4 pl-3 speaker-wrapper">
                                    <div style="float: left; width: 120px;"> 
                                        <div style="width: 100%; height: 100%;">
                                            <img type="image" src="{{$speaker->avatar}}" style="width: 80px; height: 80px; border-radius: 40px"/>
                                        </div>
                                    </div>
                                    <div style="float: left; width: calc(100% - 120px); height: 80px;">
                                        <div class="row">
                                            <h5 style="font-weight: bold"><span>{{$speaker->honorific}}.</span> <span>{{$speaker->name}}</span></h5>
                                        </div>
                                        <div class="row">
                                            <span class="text-muted">{{$speaker->position}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div style="width: 100%; height: 30px; mb-2 "> <h5>Timeline</h5></div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center tab-body">
                            <div class="col-xl-12">
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
                                                        
                                                    </div>
                                                    <div class="timeline-box">
                                                        <div class="event-content">
                                                            <div class="timeline-text">
                                                                <h3 class=" text-primary" style="font-weight: 500 ; font-size: 17px"><i class="fas fa-hashtag"></i> {{$detail->title}}</h3>
                                                                <h3 class="font-size-17" style="color: #727cf5"><i class="fas fa-user-tie"></i> {{ isset($detail->speaker) ?  $detail->speaker->honorific.'.'.$detail->speaker->name : "N/A"}} <span style="margin-left: 10px ;"><i class="fas fa-clock"></i> {{$time->format('g:i A')}}</span></h3>
                                                                <div style="width: 115%;">
                                                                    {!! $detail->content !!}
                                                                </div>
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
                                                    <h3 style="font-size: 17px" class="text-primary font-weight-bold">Thank you for your watching</h3>
                                                    <p class="text-muted mb-0">Copyright © by 360Fairs</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP DELETE WEBINAR --}}
    <div class="modal fade" id="popup-delete-webinar" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Confirm Delete Webinar</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <span>Are you sure to detele this webinar ?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="deleteWebinar()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteWebinar() {  
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}",
                type: 'delete',
                dataType: 'json',
                success: function (res) { 
                    if(res != null){
                        location.href = '/administrator/tours/{{$tour->id}}/events/webinars';
                    }
                }
            });
        }
    </script>
@endsection

