@extends('layouts.partner')

@section('content')
    <div class="container-fluid card-event">
        <h1 class="h3 mb-4 text-gray-800">Events <button class="btn btn-df" style="position: absolute; right: 1.5rem;" data-toggle="modal" data-target="#popup-create-webinar"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new event</button></h1>
        
        <div class="row">
            @foreach ($webinars as $webinar)
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
                                <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="btn btn-sm btn-flash-border-primary">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
debugger;
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

@endsection





