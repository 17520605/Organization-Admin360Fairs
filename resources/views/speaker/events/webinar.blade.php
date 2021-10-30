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
                        <div class="tab-header" style="flex: 0 1 0%;">
                            <div class="float-left tab-header-btn {{ $tab == null || $tab == 'timeline' ? 'active' : ''}}" data-tab="timeline">Timeline</div>
                            <div class="float-right tab-header-btn {{ $tab == null || $tab == 'documents' ? 'active' : ''}}" data-tab="documents">Documents</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center tab-body" data-tab="timeline" style="display: {{ $tab == null || $tab == 'timeline' ? 'block' : 'none'}}">
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
                                                <div class="col-md-6">
                                                    <div class="timeline-icon">
                                                        <i class="fas fa-pen text-primary h2 mb-0" data-title="{{$detail->title}}" onclick="onOpenPopupEditWebinarDetail({{$detail->id}}, event)"></i>
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
                                                                <div>
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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        Documents
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap table-hover mb-0 table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Date modified</th>
                                                        <th scope="col">Size</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>    
                                                    @foreach ($webinar->details as $detail)
                                                    <tr>
                                                        <td class="font-weight-bold" colspan="5">
                                                            <span>{{$detail->title}}</span>
                                                            <span style="ml-3">( <a href="">{{$detail->speaker->name}}</a> )</span>
                                                            @if ($detail->speaker != null && $detail->speaker->id == $profile->id)
                                                                <span class="float-right" onclick="onOpenPopupAddDocuments({{$detail->id}})"><i class="fas fa-plus"></i>Add</span> 
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
                                                                <td>
                                                                    <a class="text-dark fw-medium">
                                                                        @if (in_array($document, array('docx, doc')))
                                                                            <i class="fas fa-docx mr-2"></i> 
                                                                        @elseif (in_array($document, array('pdf')))
                                                                            <i class="fas fa-pdf mr-2"></i> 
                                                                        @else
                                                                            <i class="fas fa-file-code font-size-16 align-middle text-primary mr-2"></i> 
                                                                        @endif
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
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
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
                    <div class="row tab-header">
                        <div class="col-6 tab-header-btn active" data-tab="upload">Upload New Documents</div>
                        <div class="col-6 tab-header-btn" data-tab="choose">Choose Existing Documents</div>
                    </div>
                    <div class="modal-body tab-body" data-tab="upload">
                        <div class="card">
                            <div>
                                <div class="upload-box" style="display: block; width: 100%">
                                    <div class="upload-text text-center" style="width: 100%">
                                        <div class="upload-form border-dashed" style="height: 100%;">
                                            <div class="ml-3"> 
                                                <input type="file" hidden="" id="popup-add-documents__file-input" multiple>
                                                <button type="button" id="popup-add-documents__upload-btn">Upload</button>
                                                <div style="width: 100%">
                                                    <div id="popup-add-documents__files-wrapper" class="row p-3">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="webinarDetailId">
                                <button id="popup-add-documents__upload-save-btn" type="button" class="btn btn-primary btn-block icon-loader-show"> <span class="loader-icon-btn"></span> Upload </button>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-body tab-body" data-tab="choose" style="display: none;">
                        <div class="card">
                            <form id="popup-add-documents__choose-form" class="row p-3" style="max-height: 500px; overflow-y: scroll;">
                                @csrf
                                <input type="hidden" name="webinarDetailId">
                                @foreach ($documents as $document)
                                <label class="col-12 m-2" for="popup-add-documents__checkbox-{{$document->id}}">
                                    <div class="card p-2">
                                        <div class="row">
                                            <div class="col-1">
                                                <input id="popup-add-documents__checkbox-{{$document->id}}" class="form-control" name="documentIds[]" type="checkbox" value="{{$document->id}}" style="width: 20px; height: 20px;">
                                            </div>
                                            <div class="col-1"><i class="fas fa-file-code font-size-16 align-middle text-primary mr-2"></i></div>
                                            <div class="col-9" style="text-align: left;">{{$document->name}}</div>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </form>
                        </div>
                        <div class="row">
                            <button id="popup-add-documents__choose-save-btn" type="button" class="btn btn-primary btn-block icon-loader-show"> <span class="loader-icon-btn"></span> Upload </button>
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
                                <input name="title" id="popup_create_notification__title-input" class="form-control" placeholder="Enter title of webinar detail">
                            </div>
                            <div class="form-group">
                                <textarea id="compose-textarea" name="content" class="form-control" style="height: 300px" placeholder="Enter content">
                                    {!! $detail->content !!}
                                </textarea>
                            </div>
                            <div class="row">
                                <input type="hidden" name="webinarDetailId">
                                <button id="popup-edit-webinar-detail__save-btn" type="button" class="btn btn-primary btn-block icon-loader-show"> <span class="loader-icon-btn"></span> Save </button>
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

            $('#popup-add-documents__upload-btn').click(function () {  
                $('#popup-add-documents__file-input').trigger('click');
            })

            $('#popup-add-documents__file-input').change(function () {  

                let detailId = $('#popup-add-documents').find('input[type="hidden"][name="webinarDetailId"]').val();
                data.append( 'webinarDetailId', detailId);

                $('#popup-add-documents__upload-btn').hide();
                $('#popup-add-documents__files-wrapper').empty();

                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    data.append( i, file);

                    let ext = file.name.split('.').pop();
                    let icon = '<i class="fas fa-file"></i>';

                    switch (ext) {
                        case 'pdf':
                            icon = '<i class="fas fa-pdf"></i>';
                            break;
                        case 'docx':
                            icon = '<i class="fas fa-docx"></i>';
                        case 'txt':
                            icon = '<i class="fas fa-txt"></i>';
                        case 'jpg':
                            icon = '<i class="fas fa-jpg"></i>';
                            break;
                        case 'mp4':
                            icon = '<i class="fas fa-mp4"></i>';
                            break;
                        default:
                            break;
                    }

                    let elm = $(`
                        <div class="col-6 document-item">
                            <div class="card p-2">
                                <div class="row">
                                    <div class="col-1">`+ icon +`</div>
                                    <div class="col-10" style="text-align: left;">`+ file.name +`</div>
                                    <div class="col-1">
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
                $('#popup-add-documents__upload-btn').show();
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
            let title = $(e.currentTarget).data('title');

            $('#popup-edit-webinar-detail').modal('show');
            $('#popup_create_notification__title-input').val(title);
            $('#popup-edit-webinar-detail').find('input[type="hidden"][name="webinarDetailId"]').val(detailId);
        }


    </script>
@endsection
