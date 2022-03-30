@extends('layouts.master')
@section('content')
    <div class="container-fluid tags-wrapper">
        <h1 class="h3 text-gray-800"> <span id="page-title">All Events</span> </h1>
        <div class="tab-header mb-3 webinar-tab" style="width: 100%; height: 40px; mb-2 ">
            <span class="tab-header-btn btn btn-primary float-left active" data-tag="all" data-name="All Events"><i class="fas fa-stream"></i></span>
            <span class="tab-header-btn btn btn-primary float-left " data-tag="my" data-name="Tour's Events"><i class="fab fa-accusoft"></i></span>
        </div>
        <div class="tag-body row line-time timeline_area section_padding_130" style="display: {{ $tag == null || $tag == 'all' ? 'block' : 'none'}};" data-tag="all">
            <div class="mb-4" style="width: 90%; margin-left: 5%" >
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-8 col-lg-6">
                        <!-- Section Heading-->
                        <div class="section_heading text-center">
                            <h3 class="text-primary font-weight-bold">Event schedule</h3>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="apland-timeline-area">
                            @foreach ($all_dates as $date)
                            @php
                                $time = Carbon\Carbon::parse($date->date);
                            @endphp
                                <div class="single-timeline-area">
                                    <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                        <p class="btn btn-primary font-weight-bold" style="background: #fd9800;color: #FFF; border: 3px solid #f1c40faa;border-radius:25px ;box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">{{$time->format('M')}} {{$time->format('d')}}  {{$time->format('Y')}} </p>
                                    </div>
                                    <div class="row">
                                        @foreach ($date->webinars as $webinar)
                                            @if ($webinar->registerBy == $profile->id)
                                                {{-- Webinar của chính mình  --}}
                                                <div class="col-12">
                                                    <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="btn-page-loader single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;min-height: 170px;">
                                                        <div class="timeline-banner">
                                                            <img src="{{$webinar->poster}}" width="100%" height="100%" alt="">
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5 class="font-weight-bold text-primary">{{$webinar->topic}}</h5>
                                                            <h6>Created by: <span class="text-primary"> {{$webinar->registrant != null ? $webinar->registrant->name : 'N/A'}}</span></h6>
                                                            @foreach ($webinar->details as $detail) 
                                                                <p><i class="fas fa-check text-primary"></i> {{$detail->title}}</p>
                                                            @endforeach
                                                        </div>
                                                        <img src="https://res.cloudinary.com/virtual-tour/image/upload/v1641139547/icons/user_pw9vhf.png" style="position: absolute;width: 30px;right: 10px; top: 10px" alt="">
                                                    </a>
                                                </div>
                                            @else  
                                            {{-- Webinar không phải của mình  --}}
                                                <div class="col-12">
                                                    <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="btn-page-loader single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;min-height: 170px;">
                                                        <div class="timeline-banner">
                                                            <img src="{{$webinar->poster}}" width="100%" height="100%" alt="">
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5 class="font-weight-bold text-primary">{{$webinar->topic}}</h5>
                                                            <h6>Created by: <span class="text-primary"> {{$webinar->registrant != null ? $webinar->registrant->name : 'N/A'}}</span></h6>
                                                            @foreach ($webinar->details as $detail) 
                                                                <p><i class="fas fa-check text-primary"></i> {{$detail->title}}</p>
                                                            @endforeach
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach 
                                    </div>
                                </div>
                            @endforeach 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tag-body row line-time" style="display: {{ $tag == 'my' ? 'block' : 'none'}}" data-tag="my">
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
                                                                <a style="display: block" href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="hover-a-webinar popov btn-page-loader" 
                                                                    data-toggle="popover" 
                                                                    title="{{$webinar->topic}}" 
                                                                    data-content=" 
                                                                        @foreach ($webinar->details as $detail) 
                                                                            <a class='text-detail-webinar' ><i class='fas fa-check'></i>  {{$detail->title}} </a><br>
                                                                        @endforeach
                                                                    " 
                                                                    data-html="true">
                                                                    <span class="text-primary"><i class="fas fa-angle-right"></i> {{$webinar->topic}}</span>
                                                                    <img src="{{$webinar->poster}}" class="mt-3" style="border-radius: 5px" width="100%" height="100%" alt="">
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
    @include('components.add_event')
    {{-- POPUP DELETE WEBINAR --}}
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
                        <button id="popup-confirm-delete-webinar__delete-btn" type="button" class="btn btn-danger btn-icon-loader-delete"><span class="icon-loader-form-delete"></span> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- POPUP CONFIRM APPROVE WEBINAR --}}
    <div class="modal fade" id="popup-confirm-approve-webinar" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="popup-edit-webinar__form">
                    <div class="modal-header">
                        <h5 class="fw-light">Approve Webinar </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <p>Do you really want to approve it?</p>
                    </div>
                    <div class="modal-footer" style="padding: 0">
                        <input id="popup-confirm-approve-webinar__id-hidden-input" type="hidden">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="popup-confirm-approve-webinar__confirm-btn" type="button" class="btn btn-danger btn-icon-loader-delete"><span class="icon-loader-form-delete" style="border: 5px solid #4e73df;"></span> Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- POPUP CONFIRM REJECT WEBINAR --}}
    <div class="modal fade" id="popup-confirm-reject-webinar" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="popup-edit-webinar__form">
                    <div class="modal-header">
                        <h5 class="fw-light">Reject Webinar </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <p>Do you really want to reject it?</p>
                    </div>
                    <div class="modal-footer" style="padding: 0">
                        <input id="popup-confirm-reject-webinar__id-hidden-input" type="hidden">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="popup-confirm-reject-webinar__confirm-btn" type="button" class="btn btn-danger btn-icon-loader-delete"><span class="icon-loader-form-delete" ></span> Delete</button>
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
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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





