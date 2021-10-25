@extends('layouts.partner')

@section('content')
    <div class="container-fluid line-time">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-primary font-weight-bold">{{$webinar->topic}}</h4>
                        <h6 class="card-title">
                            <span>{{Carbon\Carbon::parse($webinar->startAt)->format('M d : h:m')}} </span>
                            to 
                            <span>{{Carbon\Carbon::parse($webinar->endAt)->format('M d : h:m')}} </span>
                            <span class="btn-edit-webinars" onclick="onOpenPopupEditWebinar(this)"><i class="fas fa-pen-square"></i> Edit</span>
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
                                                {{-- <div class="col-md-6">
                                                    
                                                </div> --}}

                                                <div class="col-md-6">
                                                    <div class="timeline-icon">
                                                        {{-- <i class="bx bx-briefcase-alt-2 text-primary h2 mb-0"></i> --}}
                                                    </div>
                                                    <div class="timeline-box">
                                                        <div class="timeline-date bg-primary text-center rounded">
                                                            <h4 class="text-white mb-0"> {{$time->format('h')}}</h4>
                                                            <h5 class="text-white mb-0"> {{$time->format('m')}}'</h5>
                                                        </div>
                                                        <div class="event-content">
                                                            <div class="timeline-text">
                                                                <h3 class="font-size-17"> {{$detail->speaker != null ? $detail->speaker->name : "N/A"}}</h3>
                                                                <h3 class="font-size-14"><i class="fas fa-check"></i> {{$detail->title}}</h3>
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
                                                    <h3 style="font-size: 17px" class="text-primary font-weight-bold">Launched our company on 21 June 2021</h3>
                                                    <p class="text-muted mb-0">Copyright © by 360Fairs</p>
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
        <div class="modal fade" id="popup-edit-webinar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Edit Webinar</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/administrator/tours/{{$tour->id}}/events/webinars/save-edit" method="POST">
                        @csrf
                        <input type="hidden" name="webinarId" value="{{$webinar->id}}">
                        <div class="mb-3">
                            <label class="small mb-1">Topic</label>
                            <input class="form-control" type="text" name="topic" value="{{$webinar->topic}}" placeholder="Enter topic">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="start">Start time</label>
                                <input class="form-control" id="start" name="start" value="{{Carbon\Carbon::parse($webinar->startAt)->format('Y-m-d\TH:i')}}" type="datetime-local">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="end">End time</label>
                                <input class="form-control" id="end" name="end" value="{{Carbon\Carbon::parse($webinar->endAt)->format('Y-m-d\TH:i')}}" type="datetime-local">
                            </div>
                        </div>
                        <label class="small mb-1" for="">Agenda</label>
                        <div id="agenda-wrapper">
                            @foreach ($webinar->details as $detail)
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="titles[]" value="{{$detail->title}}" placeholder="Title">
                                </div>
                                <div class="col-md-1" style="padding: 0;">
                                    <input class="form-control" type="number" name="durations[]" value="{{$detail->duration}}" min="0" max="500" style="padding-right: 0!important;" placeholder="Duration">
                                </div>
                                <div class="col-md-4" style="padding-right:0px ;">
                                    <select class="form-control" name="speakers[]">
                                        <option>--Choose speaker--</option>
                                        @foreach ($speakers as $key => $speaker)
                                            <option value="{{$speaker->id}}" {{$speaker->id == $detail->speakerId ? 'selected' : '' }}>{{$speaker->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1" style="text-align: center;">
                                    <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px;"></i>
                                </div>
                            </div>
                            @endforeach
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="titles[]" placeholder="Title">
                                </div>
                                <div class="col-md-1" style="padding: 0;">
                                    <input class="form-control" type="number" name="durations[]" min="0" max="500" style="padding-right: 0!important;" placeholder="Duration">
                                </div>
                                <div class="col-md-4" style="padding-right:0px ;">
                                    <select class="form-control" name="speakers[]">
                                        <option>--Choose speaker--</option>
                                        @foreach ($speakers as $key => $speaker)
                                            <option value="{{$speaker->id}}"> {{$speaker->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1" style="text-align: center;">
                                    <i class="fas fa-plus-circle add-agenda" onclick="addAgenda();" style="font-size: 25px;color: #4e73df;line-height: 38px;"></i>
                                    <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px; display:none"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="description">Tour Description</label>
                            <textarea placeholder="Enter your tour description" class="form-control" name="description" rows="6"> {{$webinar->description}} </textarea>
                        </div>
                        <!-- Form Group (create account submit)-->
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function onOpenPopupEditWebinar(target){
            $('#popup-edit-webinar').modal('show');
        }
        function addAgenda() {
            $('.add-agenda').hide();
            $('.remove-agenda').show();
            $("#agenda-wrapper").append( 
                `<div class="row gx-3 mb-3 agenda-item">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="titles[]" placeholder="Title">
                    </div>
                    <div class="col-md-1" style="padding: 0;">
                        <input class="form-control" type="number" name="durations[]" min="0" max="500" style="padding-right: 0!important;" placeholder="Duration">
                    </div>
                    <div class="col-md-4" style="padding-right:0px ;">
                        <select class="form-control" name="speakers[]">
                            <option>--Choose speaker--</option>
                            @foreach ($speakers as $key => $speaker)
                                <option value="{{$speaker->id}}">{{$speaker->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1" style="text-align: center;">
                        <i class="fas fa-plus-circle add-agenda" onclick="addAgenda();" style="font-size: 25px;color: #4e73df;line-height: 38px;"></i>
                        <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px; display: none;"></i>
                    </div>
                </div>`
            );

            let a = "{{$tour->id}}";
        }

        function removeAgenda(e) {
            $(e.currentTarget).parent().parent().remove();
        }
    </script>
@endsection
