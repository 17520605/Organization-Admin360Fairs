@extends('layouts.master')
@section('content')
    <div class="container-fluid tags-wrapper">
        <h1 class="h3 text-gray-800"> <span>Request Events</span></h1>
        <div class="tab-header mb-3 webinar-tab" style="width: 100%; height: 40px; mb-2 ">
            <span class="tab-header-btn btn btn-primary float-left active" data-tag="list" data-name="All Events"><i class="fas fa-stream"></i></span>
            <span class="tab-header-btn btn btn-primary float-left" data-tag="card" data-name="All Events"><i class="fas fa-clone"></i></span>
        </div>
        <div class="card shadow mb-4 tag-body" style="display: {{ $tag == null || $tag == 'list' ? 'block' : 'none'}}" data-tag="list">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background: #eef2f7;">
                                <th style="text-align: center">#</th>
                                <th>Topic event</th>
                                <th>Requied by</th>
                                <th>Date Request</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($webinars as $webinar)
                            @if ($webinar->isConfirmed === null || $webinar->isConfirmed === 0)
                                <tr data-webinar-id="{{$webinar->id}}">
                                    <td style="text-align: center">{{$number++}}</td>
                                    <td><a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="font-weight-bold text-primary">{{$webinar->topic}}</a></td>
                                    <td>{{$webinar->registrant != null ? $webinar->registrant->name : 'N/A'}}</td>
                                    <td>{{$webinar->created_at}}</td>
                                    <td>
                                        @if ($webinar->isConfirmed === 0)
                                            <span class="badge bg-danger">Reject</span>
                                        @else
                                            <button type="button" class="btn btn-sm btn-success" onclick="onOpenPopupConfirmApprove({{$webinar->id}})" title="Edit" style="width: 32px;"><i class="fas fa-check"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="onOpenPopupConfirmReject({{$webinar->id}})" title="Delete" style="width: 32px;"><i class="fas fa-times"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tag-body row card-event" style="display: {{ $tag == 'card' ? 'block' : 'none'}};" data-tag="card">
            @foreach ($webinars as $webinar)
                @if ($webinar->isConfirmed === null || $webinar->isConfirmed === 0)
                    <div class="col-lg-4 webinar-item" data-webinar-id="{{$webinar->id}}">
                        <a class="card card-margin" href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}">
                            <div class="card-header no-border">
                                <h6 class="card-title text-primary" style="font-weight: 700">EVENT-{{$webinar->id}}</h6>
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
                                        <div class="div_cardheader_btn" style="bottom: 1rem !important;top: auto;">
                                            <button class="mb-0 btn float-right" onclick="onOpenPopupConfirmReject({{$webinar->id}})"> Reject </button>
                                            <button class="mb-0 btn float-right active" onclick="onOpenPopupConfirmApprove({{$webinar->id}})"></i> Approve </button>
                                        </div>                           
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
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
                        <button id="popup-confirm-approve-webinar__confirm-btn " type="button" class="btn btn-primary btn-icon-loader-delete"><span class="icon-loader-form-delete" style="border: 5px solid #4e73df;"></span> Approve</button>
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
                        <button id="popup-confirm-reject-webinar__confirm-btn" type="button" class="btn btn-danger btn-icon-loader-delete"><span class="icon-loader-form-delete"></span> Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function onOpenPopupConfirmReject(webinarId){
            $('#popup-confirm-reject-webinar__id-hidden-input').val(webinarId);
            $('#popup-confirm-reject-webinar').modal('show');
        }

        function onOpenPopupConfirmApprove(webinarId){
            $('#popup-confirm-approve-webinar__id-hidden-input').val(webinarId);
            $('#popup-confirm-approve-webinar').modal('show');
        }

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

            $('#popup-confirm-approve-webinar__confirm-btn').click(function (){
                let id = $('#popup-confirm-approve-webinar__id-hidden-input').val();
                if(id != null && id != ""){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/events/webinars/save-approve",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            webinarId: id,
                        },
                        success: function (res) { 
                            if (res == 1) {
                                location.reload();
                            }
                        }
                    });
                }
            });

            $('#popup-confirm-reject-webinar__confirm-btn').click(function (){
                let id = $('#popup-confirm-reject-webinar__id-hidden-input').val();
                if(id != null && id != ""){
                    let ajax = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/events/webinars/save-reject",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            webinarId: id,
                        },
                        success: function (res) { 
                            if (res == 1) {
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





