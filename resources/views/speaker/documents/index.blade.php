@extends('layouts.speaker')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Documents</h1>
            <div class="div_cardheader_btn" >
                <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-create-documents"><i class="fas fa-plus"></i> Add </button>
            </div>
        </div>
        <div class="card-body" style="border: none !important;">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap table-hover mb-0 table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Date modified</th>
                            <th scope="col">Size</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>    
                        @if (count($documents) == 0)
                        <tr>
                            <td colspan="5" style="text-align: center">There are no documents</td>  
                        </tr>
                        @else
                            @foreach ($documents as $document)
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
                                        @if ($document->isUsed == true)
                                            <span style="margin-left:10px; padding: 2px 10px; color:gray; border-radius: 15px; border: 1px solid gray;"> Used </span>
                                        @endif
                                    </a>
                                </td>
                                <td><a href="">{{$document->owner != null ? $document->owner->name : 'N/A'}}</a></td>
                                <td>{{$document->created_at}}</td>
                                <td>{{$document->size != null ? strval(number_format(floatval($document->size)/(1048576), 1)).' MB' : 'N/A'}}</td>   
                                <td class="btn-action-icon">
                                    <i onclick="onDownloadDocument()" class="fas fa-download edit"></i>
                                    <i onclick="onOpenPopupDeleteDocument({{$document->id}})" class="fas fa-trash-alt delete"></i>
                                </td>  
                            </tr>
                            @endforeach
                        @endif  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- POPUP CREATE PARTICIANT --}}
<div class="modal fade" id="popup-create-partner" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-create-partner__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Create Partner </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Enter partner name" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter partner name
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Enter email" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter email
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Contact</label>
                        <input type="tel" name="contact" class="form-control form-control-user" id="contact" placeholder="Enter Contact" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter contact
                        </div>
                    </div>
                    <div class="form-group messages-wrapper border" style="display: none">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Change</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- POPUP ADD DOCUMENT --}}
<div class="modal fade" id="popup-create-documents" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light">Create New Documents</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="card">
                        <div>
                            <div class="upload-box" style="display: block; width: 100%">
                                <div class="upload-text text-center" style="width: 100%">
                                    <div class="upload-form border-dashed" style="height: 100%;">
                                        <div class="ml-3"> 
                                            <input type="file" hidden="" id="popup-create-documents__file-input" multiple>
                                            <button type="button" id="popup-create-documents__upload-btn">Upload</button>
                                            <div style="width: 100%">
                                                <div id="popup-create-documents__files-wrapper" class="row p-3">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button id="popup-create-documents__save-btn" type="submit" class="btn btn-primary btn-block icon-loader-show"> <span class="loader-icon-btn"></span> Upload </button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

{{-- POPUP DELETE DOCUMENT --}}
<div class="modal fade" id="popup-confirm-delete-document" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light">Delete Document </h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <p>Do you really want to delete it?</p>
            </div>
            <div class="modal-footer" style="padding: 0">
                <input type="hidden" name="documentId">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="onDeleteDocument()">Delete</button>
            </div>
        </div>
    </div>
</div>


<script>
    function onOpenPopupCreateDocuments(detailId) {  
        $('#popup-create-documents').modal('show');
        $('#popup-create-documents').find('input[type="hidden"][name="webinarDetailId"]').val(detailId);
    }

    function onOpenPopupDeleteDocument(documentId){
        $('#popup-confirm-delete-document').find('input[type="hidden"][name="documentId"').val(documentId);
        $('#popup-confirm-delete-document').modal('show');
    }

    function onDeleteDocument(){
        let documentId = $('#popup-confirm-delete-document').find('input[type="hidden"][name="documentId"]').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/speaker/tours/{{$tour->id}}/documents/save-delete",
            data: {
                documentId: documentId
            },
            dataType: 'json',
            success: function (res) {
                location.reload();
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        
        var data = new FormData();

        $('#popup-create-documents__upload-btn').click(function () {  
            $('#popup-create-documents__file-input').trigger('click');
        })

        $('#popup-create-documents__file-input').change(function () {  

            $('#popup-create-documents__upload-btn').hide();
            $('#popup-create-documents__files-wrapper').empty();

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

                $('#popup-create-documents__files-wrapper').append(elm);
            }
        });

        $('#popup-create-documents__save-btn').click(function (){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/speaker/tours/{{$tour->id}}/documents/save-create",
                method: 'post',
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                success: function (res) { 
                    location.href = '/speaker/tours/{{$tour->id}}/documents';
                }
            });
        });
    });
</script>
@endsection
