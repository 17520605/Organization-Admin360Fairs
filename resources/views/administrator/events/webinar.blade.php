@extends('layouts.master')

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
                <div class="card tabs">
                    <div class="card-header">
                        <div class="tab-header webinar-tab" style="width: 100%; height: 40px; mb-2 ">
                            <span class="tab-header-btn btn btn-primary float-left {{ $tab == null || $tab == 'timeline' ? 'active' : ''}}" data-tab="timeline"><i class="fas fa-calendar-check"></i></span>
                            <span class="tab-header-btn btn btn-primary float-left {{ $tab == 'documents' ? 'active' : ''}}" data-tab="documents"><i class="fas fa-folder-open"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center tab-body" data-tab="timeline" style="display: {{ $tab == null || $tab == 'timeline' ? 'block' : 'none'}}">
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
                                                        <div class="timeline-date1 bg-primary text-center rounded">
                                                            <h6 class="text-white mb-0"> {{$time->format('h')}} : {{$time->format('m')}}</h6>
                                                        </div>
                                                        <div class="event-content">
                                                            <div class="timeline-text">
                                                                <h3 class="font-size-17"> {{$detail->speaker != null ? $detail->speaker->name : "N/A"}}</h3>
                                                                <h3 class=" text-primary" style="font-weight: 500 ; font-size: 17px"><i class="fas fa-hashtag"></i> {{$detail->title}}</h3>
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
                                                    <h3 style="font-size: 17px" class="text-primary font-weight-bold">Launched our company on 21 June 2021</h3>
                                                    <p class="text-muted mb-0">Copyright © by 360Fairs</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center tab-body" data-tab="documents" style="display: {{$tab == 'documents' ? 'block' : 'none'}}">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="border: 1px">
                                        <thead>
                                            <tr style="background: #eef2f7">
                                                <th style="3% ;text-align:center">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date modified</th>
                                                <th scope="col">Size</th>
                                                <th scope="col" style="text-align: center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>    
                                            @foreach ($webinar->details as $detail)
                                            <tr>
                                                <td class="font-weight-bold" style="line-height: 35px;background: #eaecf4 " colspan="5">
                                                    <span>{{$detail->title}}</span>
                                                    <span style="ml-3">( <a href="" class="text-primary font-weight-bold">{{$detail->speaker->name}}</a> )</span>
                                                    @if ($detail->speaker != null && $detail->speaker->id == $profile->id)
                                                        <button class="mb-0 btn float-right btn-add-document active "  onclick="onOpenPopupAddDocuments({{$detail->id}})"><i class="fas fa-plus"></i> Add documnet </button>
                                                    @endif
                                                </td>  
                                            </tr>
                                                @if (count($detail->documents) == 0)
                                                <tr>
                                                    <td colspan="5" style="text-align: center">There are no documents</td>  
                                                </tr>
                                                @else
                                                    @foreach ($detail->documents as $document)
                                                    <tr>
                                                        <td style="font-size: 20px ;text-align: center">
                                                            @if (in_array($document->format, array('docx')))
                                                                <i class="fas fa-file-word" style=" color: #2B5796;"></i>
                                                            @elseif (in_array($document->format, array('pdf')))
                                                                <i class="fas fa-file-pdf" style=" color: #B11B1E;"></i>
                                                            @elseif (in_array($document->format, array('pptx')))
                                                                <i class="fas fa-file-powerpoint" style=" color: #D04526;"></i>
                                                            @elseif (in_array($document->format, array('csv')))
                                                                <i class="fas fa-file-csv" style=" color: #1E7145;"></i>
                                                            @elseif (in_array($document->format, array('html')))
                                                                <i class="fas fa-file-code" style=" color: #6F357D;"></i>
                                                            @elseif (in_array($document->format, array('txt')))
                                                                <i class="fas fa-file-alt" style=" color: #056BE1;"></i>
                                                            @else 
                                                                <i class="fas fa-file" style=" color: #be4bdb;"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="text-dark fw-medium">
                                                                {{$document->name}}
                                                            </a>
                                                        </td>
                                                        <td>{{$document->created_at}}</td>
                                                        <td>{{$document->size != null ? strval(number_format(floatval($document->size)/(1048576), 1)).' MB' : 'N/A'}}</td>   
                                                        <td class="btn-action-icon">
                                                            <i class="fas fa-download edit"></i>
                                                            @if ($detail->speaker != null && $detail->speaker->id == $profile->id)
                                                            <i onclick="onDeleteDocument({{$detail->id}}, {{$document->id}})" class="fas fa-trash-alt delete"></i>
                                                            @endif
                                                        </td>  
                                                    </tr>
                                                    @endforeach
                                                @endif  
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP EDIT WEBINAR --}}
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
                        <button type="submit" class="btn btn-primary btn-block btn-icon-loader"><span class="icon-loader-form"></span> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        var data = new FormData();
        $(document).ready(function () {
            $('.tab-header-btn').click(function(){
                let area = $(this).parents('.tabs');
                let tab = $(this).data('tab');
                let name = $(this).data('name');

                area.find('.tab-header-btn').removeClass("active");
                $(this).addClass("active");

                area.find('.tab-body').hide();
                area.find('.tab-body[data-tab="'+tab+'"]').show();
            });
        });
    </script>
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

