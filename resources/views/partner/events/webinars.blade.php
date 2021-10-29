@extends('layouts.partner')

@section('content')
    <div class="container-fluid tags-wrapper">
        <h1 class="h3 text-gray-800"> <span id="page-title">All Events</span> <button class="btn btn-df" style="position: absolute; right: 1.5rem;" data-toggle="modal" data-target="#popup-create-webinar"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new event</button></h1>
        <div class="tab-header mb-3" style="width: 100%; height: 40px; mb-2 ">
            <span class="tab-header-btn btn btn-primary float-left active" data-tag="all" data-name="All Events"><i class="fas fa-stream"></i></span>
            <span class="tab-header-btn btn btn-primary float-left " data-tag="my" data-name="My Events"><i class="fas fa-stream"></i></span>
            <span class="tab-header-btn btn btn-primary float-left" data-tag="card" data-name="All Events"><i class="fas fa-clone"></i></span>
        </div>
        <div class="tag-body row line-time" style="display: block;" data-tag="all">
            <div class="col-lg-12">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="timeline">
                                    <div class="timeline-container">
                                        <div class="timeline-end">
                                            <p>Start</p>
                                        </div>
                                        <div class="timeline-continue">
                                            
                                            @foreach ($all_dates as $date)
                                            <div class="row timeline-box-card">
                                                @php
                                                    $time = Carbon\Carbon::parse($date->date);
                                                @endphp
                                                <div class="col-md-6">
                                                    <div class="timeline-icon">
                                                        {{-- <i class="bx bx-briefcase-alt-2 text-primary h2 mb-0"></i> --}}
                                                    </div>
                                                    <div class="timeline-box">
                                                        <div class="timeline-date bg-primary text-center rounded">
                                                            <h4 class="text-white mb-0">{{$time->format('d')}}</h4>
                                                            <h5 class="text-white mb-0" style="text-transform: uppercase ;font-size: 16px">{{$time->format('M')}}</h5>
                                                        </div>
                                                        <div class="event-content">
                                                            <div class="timeline-text">
                                                                @foreach ($date->webinars as $webinar)
                                                                @if ($webinar->registerBy == $profile->id)
                                                                    {{-- WEBINAR CUA CHINH MINH --}}
                                                                    <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="hover-a-webinar popov mt-3" 
                                                                        data-toggle="popover" 
                                                                        title="{{$webinar->topic}}" 
                                                                        data-content="
                                                                            @foreach ($webinar->details as $detail) 
                                                                                <a class='text-detail-webinar'><i class='fas fa-check'></i>  {{$detail->title}} </a><br>
                                                                            @endforeach
                                                                        " 
                                                                        data-html="true"><i class="fas fa-angle-right"></i> {{$webinar->topic}}
                                                                    </a><br>
                                                                @else
                                                                    <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="hover-a-webinar popov mt-3" 
                                                                        data-toggle="popover" 
                                                                        title="{{$webinar->topic}}" 
                                                                        data-content="
                                                                            @foreach ($webinar->details as $detail) 
                                                                                <a class='text-detail-webinar'><i class='fas fa-check'></i>  {{$detail->title}} </a><br>
                                                                            @endforeach
                                                                        " 
                                                                        data-html="true"><i class="fas fa-angle-right"></i> {{$webinar->topic}}
                                                                    </a><br>
                                                                @endif
                                                                @endforeach 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
            </div>
        </div>
        <div class="tag-body row line-time" style="display: none;" data-tag="my">
            <div class="col-lg-12">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="timeline">
                                    <div class="timeline-container">
                                        <div class="timeline-end">
                                            <p>Start</p>
                                        </div>
                                        <div class="timeline-continue">
                                            
                                            @foreach ($my_dates as $date)
                                            <div class="row timeline-box-card">
                                                @php
                                                    $time = Carbon\Carbon::parse($date->date);
                                                @endphp
                                                <div class="col-md-6">
                                                    <div class="timeline-icon">
                                                        {{-- <i class="bx bx-briefcase-alt-2 text-primary h2 mb-0"></i> --}}
                                                    </div>
                                                    <div class="timeline-box">
                                                        <div class="timeline-date bg-primary text-center rounded">
                                                            <h4 class="text-white mb-0">{{$time->format('d')}}</h4>
                                                            <h5 class="text-white mb-0" style="text-transform: uppercase ;font-size: 16px">{{$time->format('M')}}</h5>
                                                        </div>
                                                        <div class="event-content">
                                                            <div class="timeline-text">
                                                                @foreach ($date->webinars as $webinar)
                                                                <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="hover-a-webinar popov" 
                                                                    data-toggle="popover" 
                                                                    title="{{$webinar->topic}}" 
                                                                    data-content=" 
                                                                        @foreach ($webinar->details as $detail) 
                                                                            <a class='text-detail-webinar'><i class='fas fa-check'></i>  {{$detail->title}} </a><br>
                                                                        @endforeach
                                                                    " 
                                                                    data-html="true"><i class="fas fa-angle-right"></i> {{$webinar->topic}}
                                                                </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
            </div>
        </div>
        <div class="tag-body row card-event" style="display: none;" data-tag="card">
            @foreach ($webinars as $webinar)
                @if ($webinar->status == null || $webinar->status == \App\Models\Webinar::STATUS_UNCONFIRM)
                <div class="col-lg-4 ">
                    <div class="card card-margin">
                        <div class="card-header no-border">
                            <h6 class="card-title" style="font-weight: 400">360 EVENT</h6>
                            <button class="btn btn-default btn-remove-event-card" data-webinar-id="{{$webinar->id}}" onclick="onOpenPopupDeleteWebinar(this);"><i class="far fa-times-circle"></i></button>
                        </div>
                        <div class="card-body pt-0">
                            <div class="widget-49">
                                <div class="widget-49-title-wrapper">
                                    <div class="widget-49-date-primary">
                                        <span class="widget-49-date-day">{{Carbon\Carbon::parse($webinar->startAt)->format('d')}}</span>
                                        <span class="widget-49-date-month">{{Carbon\Carbon::parse($webinar->startAt)->format('M')}}</span>
                                    </div>
                                    <div class="widget-49-meeting-info">
                                        <span class="widget-49-pro-title">{{$webinar->topic}}</span>
                                        <span class="widget-49-meeting-time">{{Carbon\Carbon::parse($webinar->startAt)->format('h:m')}} to {{Carbon\Carbon::parse($webinar->endAt)->format('h:m')}}</span>
                                    </div>
                                </div>
                                <ol class="widget-49-meeting-points">
                                    @foreach ($webinar->details as $detail)
                                    <li class="widget-49-meeting-item"><span>{{$detail->title}}</span></li>
                                    @endforeach
                                </ol>
                                <div class="widget-49-meeting-action">
                                    <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="btn btn-sm btn-flash-border-primary">Reject</a>
                                    <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="btn btn-sm btn-flash-border-primary">Approve </a>
                                    <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="btn btn-sm btn-flash-border-primary">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @include('components.add_event')
    {{-- POPUP DELETE PARTICIANT --}}
    <div class="modal fade" id="popup-confirm-delete-webinar" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="popup-edit-webinar__form" class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h5 class="fw-light">Delete Webinar </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <p>Do you really want to delete it?</p>
                    </div>
                    <div class="modal-footer" style="padding: 0">
                        <input id="popup-confirm-delete-webinar__id-hidden-input" type="hidden">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="popup-confirm-delete-webinar__delete-btn" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function onOpenPopupDeleteWebinar(target){
            let webinarId = $(target).attr('data-webinar-id');
            $('#popup-confirm-delete-webinar__id-hidden-input').val(webinarId);
            $('#popup-confirm-delete-webinar').modal('show');
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#popup-confirm-delete-webinar__delete-btn').click(function (){
                let id = $('#popup-confirm-delete-webinar__id-hidden-input').val();
                if(id != null && id != ""){
                    let ajax = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/events/webinars/" + id,
                        type: 'delete',
                        dataType: 'json',
                        success: function (res) { 
                            if (res == 1) {
                                $('#popup-confirm-delete-webinar').modal('hide');
                                location.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script>
         $('.tab-header-btn').click(function(){
            let area = $(this).parents('.tags-wrapper');
            let tag = $(this).data('tag');
            let name = $(this).data('name');

            $('#page-title').text(name);

            area.find('.tab-header-btn').removeClass("active");
            $(this).addClass("active");

            area.find('.tag-body').hide();
            area.find('.tag-body[data-tag="'+tag+'"]').show();
        });
    </script>
@endsection





