@extends('layouts.speaker')

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
                                                    <div class="timeline-box detail-items-speaker" style="max-width: 90%;">
                                                        <div class="timeline-date1 bg-primary text-center rounded">
                                                            <h6 class="text-white mb-0"> {{$time->format('h')}} : {{$time->format('m')}}</h6>
                                                        </div>
                                                        <button class="btn-edit-webinar-sp btn btn-primary btn-circle btn-sm" onclick="onOpenPopupEditWebinarDetail({{$detail->id}}, event)"><i  class=" fas fa-pen" data-title="{{$detail->title}}"></i></button>
                                                        <div class="event-content">
                                                            <div class="timeline-text">
                                                                <h3 class="font-size-17"> {{$detail->speaker != null ? $detail->speaker->name : "N/A"}}</h3>
                                                                <h3 class=" text-primary" style="font-weight: 600 ; font-size: 20px"><i class="fas fa-hashtag"></i> <span class="detail-title">{{$detail->title}}</span></h3>
                                                                <div style="width: 115%;" class="detail-content">
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
    {{-- POPUP ADD DOCUMENT --}}
    <div class="modal fade" id="popup-add-documents" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Add Documents</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tabs">
                    <div class="row tab-header tab_upload_files" style="text-align: center">
                        <div class="col-6 tab-header-btn active" data-tab="upload">Upload New Documents</div>
                        <div class="col-6 tab-header-btn" data-tab="choose">Choose Existing Documents</div>
                    </div>
                    <div class="modal-body tab-body" data-tab="upload">
                        <div class="card">
                            <div>
                                <div class="upload-box" style="display: block; width: 100%">
                                    <div class="dropify-wrapper upload-form-document">
                                        <div class="dropify-message">
                                            <i class="fas fa-upload" style="font-size: 40px;"></i>
                                            <p>Drag and drop a file CV here or click</p>
                                        </div>
                                        <div class="dropify-loader"></div>
                                        <input type="file" class="dropify" id="popup-add-documents__file-input" multiple>
                                    </div>
                                    <div style="width: 100% ;display: none;" class="upload-form-preview" >
                                        <div id="popup-add-documents__files-wrapper" class="row p-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="mt-2" style="padding: 0">
                            <input type="hidden" name="webinarDetailId">
                            <button id="popup-add-documents__upload-save-btn" type="button" class="btn btn-primary btn-block btn-icon-loader"> <span class="icon-loader-form"></span> Upload </button>
                        </div>
                    </div>
                    <div class="modal-body tab-body" data-tab="choose" style="display: none;">
                        <div class="card p-2">
                            <form id="popup-add-documents__choose-form" class="row" style="max-height: 400px; overflow-y: scroll;    overflow-x: hidden;">
                                @csrf
                                <input type="hidden" name="webinarDetailId">
                                @foreach ($documents as $document)
                                <label class="col-12" for="popup-add-documents__checkbox-{{$document->id}}">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col-1">
                                                <input id="popup-add-documents__checkbox-{{$document->id}}" class="form-control form-check-input1" name="documentIds[]" type="checkbox" value="{{$document->id}}" style="width: 20px; height: 20px; margin-top: 5px">
                                            </div>
                                            <div class="col-auto" style="font-size: 20px">
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
                                            </div>
                                            <div class="col-9" style="text-align: left;">{{$document->name}}</div>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </form>
                        </div>
                        <div class="mt-2" style="padding: 0">
                            <button id="popup-add-documents__choose-save-btn" type="button" class="btn btn-primary btn-block btn-icon-loader"> <span class="icon-loader-form"></span> Upload </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP EDIT WEBINAR DETAIL --}}
    <div class="modal fade" id="popup-edit-webinar-detail" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Edit Webinar Detail</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form id="popup-edit-webinar-detail__form">
                            @csrf
                            <input type="hidden" name="webinarDetailId">
                            <div class="form-group">
                                <input name="title" id="popup-edit-webinar-detail__title-input" class="form-control" placeholder="Enter title of webinar detail" value="{{$detail->title}}">
                            </div>
                            <div class="form-group">
                                <textarea id="popup-edit-webinar-detail__content-input" name="content" class="form-control" style="height: 300px">
                                
                                </textarea>
                            </div>
                            <div class="row">
                                <input type="hidden" id="popup-edit-webinar-detail__IDWebinar-input" name="webinarDetailId">
                                <button id="popup-edit-webinar-detail__save-btn" type="button" class="btn btn-primary btn-block btn-icon-loader"> <span class="icon-loader-form"></span> Save </button>
                            </div>
                        </form>
                    </div>
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

            $('#popup-add-documents__file-input').change(function () {  

                let detailId = $('#popup-add-documents').find('input[type="hidden"][name="webinarDetailId"]').val();
                data.append( 'webinarDetailId', detailId);
                $('#popup-add-documents').find('.upload-form-preview').show();
                $('#popup-add-documents').find('.upload-form-document').hide();
                $('#popup-add-documents__files-wrapper').empty();
                
                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    data.append( i, file);

                    let ext = file.name.split('.').pop();
                    let icon = '<i class="fas fa-file" style=" color: #be4bdb;"></i>';

                    switch (ext) {
                        case 'pdf':
                            icon = '<i class="fas fa-file-pdf" style=" color: #B11B1E;"></i>';
                            break;
                        case 'docx':
                            icon = '<i class="fas fa-file-word" style=" color: #2B5796;"></i>';
                            break;
                        case 'pptx':
                            icon = '<i class="fas fa-file-powerpoint" style=" color: #D04526;"></i>';
                            break;
                        case 'txt':
                            icon = '<i class="fas fa-file-alt" style=" color: #056BE1;"></i>';
                            break;
                        case 'csv':
                            icon = '<i class="fas fa-file-csv" style=" color: #1E7145;"></i>';
                            break;
                        case 'jpg':
                            icon = '<i class="fas fa-file-image" style=" color: #183153;"></i>';
                            break;
                        case 'mp4':
                            icon = '<i class="fas fa-file-video" style=" color: #183153;"></i>';
                            break;
                        case 'html':
                            icon = '<i class="fas fa-file-code" style=" color: #6F357D;"></i>';
                            break;
                        default:
                            break;
                    }

                    let elm = $(`
                        <div class="col-12 document-item mb-1">
                            <div class="card p-3">
                                <div class="row">
                                    <div class="col-1">`+ icon +`</div>
                                    <div class="col-10" style="text-align: left;">`+ file.name +`</div>
                                    <div class="col-1" style="padding:0;">
                                        <i class="fas fa-trash-alt" onclick="onRemoveUploadingDocument(`+ i +`, event)"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    $('#popup-add-documents__files-wrapper').append(elm);
                }
            });

            $('#popup-add-documents__upload-save-btn').click(function (){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}/upload-documents",
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: data,
                    dataType: 'json',
                    success: function (res) { 
                        location.href = '/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}?tab=documents';
                    }
                });
            });

            $('#popup-edit-webinar-detail__save-btn').click(function (){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}/save-edit-webinar-detail",
                    method: 'post',
                    data: $('#popup-edit-webinar-detail__form').serializeArray(),
                    dataType: 'json',
                    success: function (res) { 
                        location.href = '/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}?tab=timeline';
                    }
                });
            });

            $('#popup-add-documents__choose-save-btn').click(function () {  
                let data = $('#popup-add-documents__choose-form').serializeArray();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}/choose-documents",
                    method: 'post',
                    data: data,
                    dataType: 'json',
                    success: function (res) { 
                        location.href = '/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}?tab=documents';
                    }
                });
            });
        });
    </script>
    <script>
        function onRemoveUploadingDocument(id, e) { 
            if(data != null){
                data.delete(1);
                $(e.currentTarget).parents('.document-item').remove();
            }

            if($('#popup-add-documents__files-wrapper').children().length == 0){
                $('#popup-add-documents').find('.upload-form-document').show();
                $('#popup-add-documents').find('.upload-form-preview').hide();
            }
        };

        function onDeleteDocument(webinarDetailId, documentId) { 
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}/delete-document",
                method: 'post',
                data: {
                    webinarDetailId: webinarDetailId,
                    documentId: documentId
                },
                dataType: 'json',
                success: function (res) { 
                    location.href = '/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}?tab=documents';
                }
            });
        };

        function onOpenPopupAddDocuments(detailId) {  
            $('#popup-add-documents').modal('show');
            $('#popup-add-documents').find('input[type="hidden"][name="webinarDetailId"]').val(detailId);
        }

        function onOpenPopupEditWebinarDetail(detailId, e) {  
            let title = $(e.currentTarget).parents('.detail-items-speaker').find('.detail-title').text();
            let content = $(e.currentTarget).parents('.detail-items-speaker').find('.detail-content').html();
            $('#popup-edit-webinar-detail').modal('show');
            $('#popup-edit-webinar-detail__title-input').val(title);
            $('#popup-edit-webinar-detail__content-input').summernote('code', content );
            $('#popup-edit-webinar-detail__IDWebinar-input').val(detailId);
        }
    </script>
    <script>
        $(function() {
            //Add text editor
            $('#popup-edit-webinar-detail__content-input').summernote()
        })
    </script>
@endsection
