@extends('layouts.speaker')

@section('content')
    <div class="container-fluid tags-wrapper">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 id="page-title" class="h4 font-weight-bold text-primary" style="margin: 0px">All Events</h1>
                </div>
            </div>
        </div>
        
        <div class="tab-header mb-3 webinar-tab" style="width: 100%; height: 40px; mb-2 ">
            <span class="tab-header-btn btn btn-primary float-left active" data-tag="all" data-name="All Events"><i class="fas fa-stream"></i></span>
            <span class="tab-header-btn btn btn-primary float-left " data-tag="my" data-name="My Events"><i class="fab fa-accusoft"></i></span>
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
                                                                    <a href="/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="hover-a-webinar popov mt-3" 
                                                                        data-toggle="popover" 
                                                                        title="{{$webinar->topic}}" 
                                                                        data-content="
                                                                            @foreach ($webinar->details as $detail) 
                                                                                <a class='text-detail-webinar'><i class='fas fa-check'></i>  {{$detail->title}} </a><br>
                                                                            @endforeach
                                                                        " 
                                                                        data-html="true"><i class="fas fa-angle-right"></i> {{$webinar->topic}} <span class="host-line-webinar">(Host)</span>
                                                                    </a><br>
                                                                @else
                                                                    <a href="/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="hover-a-webinar popov mt-3" 
                                                                        data-toggle="popover" 
                                                                        title="{{$webinar->topic}}" 
                                                                        data-content="
                                                                            @foreach ($webinar->details as $detail) 
                                                                                <a class='text-detail-webinar'><i class='fas fa-check'></i>  {{$detail->title}} </a><br>
                                                                            @endforeach
                                                                        " 
                                                                        data-html="true">
                                                                        <span class="text-primary"><i class="fas fa-angle-right"></i> {{$webinar->topic}}</span>
                                                                        <img src="{{$webinar->poster}}" class="mt-3" style="border-radius: 5px" width="100%" height="100%" alt="">
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
                            <div class="col-xl-12">
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
                                                                <a style="display: block" href="/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="hover-a-webinar popov" 
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
    </div>

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
                        url: "{{env('APP_URL')}}/speaker/tours/{{$tour->id}}/events/webinars/" + id,
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





