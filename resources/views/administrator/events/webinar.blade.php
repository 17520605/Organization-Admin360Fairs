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
                                    <span style="font-size:14px">Start at</span>
                                    <h6 class="mt-2" style="font-size:15px"><i class="fas fa-calendar-alt mr-3" style="color: #4348dfb0;"></i><span>{{Carbon\Carbon::parse($webinar->startAt)->format('M-d g:i A')}}</span></h6>
                                </div>
                                <div class="col-3" style="margin-left: 20px;margin-top: 10px;">
                                    <span style="font-size:14px">End at</span>
                                    <h6 class="mt-2" style="font-size:15px"><i class="fas fa-calendar-alt mr-3" style="color: #4348dfb0;"></i><span>{{Carbon\Carbon::parse($webinar->endAt)->format('M-d g:i A')}}</span></h6>
                                </div>
                                <div class="col-3" style="margin-left: 20px;margin-top: 10px;">
                                    <span style="font-size:14px">Register by</span>
                                    <h6 class="mt-2" style="font-size:15px">
                                        <span><img src="{{(isset($webinar->registrant) && isset($webinar->registrant->avatar)) ? $webinar->registrant->avatar : 'https://res.cloudinary.com/virtual-tour/image/upload/v1637651914/Background/webinar-default-poster_f23c8z.jpg'}}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 25px;">
                                        </span><span style="line-height: 30px ;font-weight: 600">{{isset($webinar->registrant) ? $webinar->registrant->name : 'N/A'}}</span>
                                    </h6>
                                </div>
                                <div class="col-auto" style="margin-left: 20px;margin-top: 10px;">
                                    <span style="font-size:14px">Status</span>
                                    <h6 class="mt-2" style="font-size:15px">
                                        @if($webinar->isConfirmed === null && $webinar->isWaitingApproval == false)
                                            <span class="badge bg-info">Editting</span>
                                        @elseif($webinar->isConfirmed == true && $webinar->isWaitingApproval == false)
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($webinar->isConfirmed == false && $webinar->isWaitingApproval == false)
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($webinar->isWaitingApproval == true)
                                            <span class="badge bg-warning">Waiting for approval</span>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="div_cardheader_btn">
                                @if ($webinar->registerBy == $profile->id)
                                    <button class="mb-0 btn float-right btn-page-loader" onclick="window.location.href='/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}/edit'"><i class="fas fa-pen-alt"></i> Edit</button>
                                    <button class="mb-0 btn float-right del" data-toggle="modal" data-target="#popup-delete-webinar"><i class="fas fa-trash-alt"></i> Delete</button>
                                @else
                                    @if ($webinar->isWaitingApproval == true && $webinar->isConfirmed === null)
                                        <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-approve-webinar">Approve</button>
                                        <button class="mb-0 btn float-right del"  data-toggle="modal" data-target="#popup-reject-webinar"></span>Reject</button>
                                    @elseif($webinar->isConfirmed == true && $webinar->isWaitingApproval == false)
                                        <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-reedit-webinar"></span>Request Re-Edit</button>
                                    @endif
                                @endif
                            </div>
                        </h6>
                    </div>
                    <div class="card-header">
                        <div>
                            <img src="{{$webinar->poster}}" alt="" style="width: 100%; height: 60vh;">
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Link Zoom : <a href="{{$webinar->zoom}}" class="font-weight-bold" target="_blank">{{$webinar->zoom}}</a></p>
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
                                            <img type="image" src="{{$speaker->avatar}}" style="object-fit: cover;width: 80px; height: 80px; border-radius: 40px"/>
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
                                                    <div class="timeline-box" style="position: relative;">
                                                        <div class="event-content">
                                                            <div class="timeline-text">
                                                                <h3 class=" text-primary title_event_content"><i class="fas fa-hashtag"></i> {{$detail->title}}</h3>
                                                                <h3 class=" text-primary font-weight-bold"  style="font-size: 16px"><i class="fas fa-user-tie"></i> {{ isset($detail->speaker) ?  $detail->speaker->honorific.'.'.$detail->speaker->name : "N/A"}} <span style="margin-left: 10px ;"><i class="fas fa-clock"></i> {{$time->format('g:i A')}}</span></h3>
                                                                <div class="content_show_event">
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

    {{-- POPUP APPROVE WEBINAR --}}
    <div class="modal fade" id="popup-approve-webinar" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Confirm Approve</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <span>Are you sure to approve this webinar ?</span>
                    <span class="error text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="approveWebinar()">Approve</button>
                </div>
            </div>
        </div>
    </div>

    {{-- POPUP REJECT WEBINAR --}}
    <div class="modal fade" id="popup-reject-webinar" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Confirm Reject</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <span>Are you sure to reject this webinar ?</span>
                    <span class="error text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="rejectWebinar()">Reject</button>
                </div>
            </div>
        </div>
    </div>
     {{-- POPUP REEDIT WEBINAR --}}
     <div class="modal fade" id="popup-reedit-webinar" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Confirm Send Request Re-Edit</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <span>Are you sure to send request re-edit this webinar ?</span>
                    <span class="error text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="reeditWebinar()">Send Request</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#popup-approve-webinar').on("shown.bs.modal", function () {
            $('#popup-approve-webinar').find('.error').hide();
        })

        $('#popup-reject-webinar').on("shown.bs.modal", function () {
            $('#popup-reject-webinar').find('.error').hide();
        })


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

        function approveWebinar() {  
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/events/webinars/save-approve",
                type: 'post',
                dataType: 'json',
                data:{
                    webinarId: '{{$webinar->id}}'
                },
                success: function (res) { 
                    if(res.success == true){
                        location.reload()
                    }
                    else{
                        $('#popup-approve-webinar').find(".error").text(res.error);
                        $('#popup-approve-webinar').find(".error").show();
                    }
                }
            });
        }

        function rejectWebinar() {  
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/events/webinars/save-reject",
                type: 'post',
                dataType: 'json',
                data:{
                    webinarId: '{{$webinar->id}}'
                },
                success: function (res) { 
                    if(res.success == true){
                        location.reload()
                    }
                    else{
                        $('#popup-reject-webinar').find(".error").text(res.error);
                        $('#popup-reject-webinar').find(".error").show();
                    }
                }
            });
        }
        
        function reeditWebinar() {  
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/events/webinars/save-reedit",
                type: 'post',
                dataType: 'json',
                data:{
                    webinarId: '{{$webinar->id}}'
                },
                success: function (res) { 
                    if(res.success == true){
                        location.reload()
                    }
                    else{
                        $('#popup-reedit-webinar').find(".error").text(res.error);
                        $('#popup-reedit-webinar').find(".error").show();
                    }
                }
            });
        }
    </script>
@endsection

