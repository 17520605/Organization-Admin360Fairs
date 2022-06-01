@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, <span> {{$profile->name}} </span> 👋 </h3>
                <button class="btn btn-add-tour" data-toggle="modal" data-target="#popup-create-tour"><i class="fas fa-plus" style="margin-right: 10px;"></i> Add New Tour</button>
            </div>
            <div class="border_card">
                <div class="card_header">
                    <span>Tours</span>
                    <i onclick="onActiveTourCard()" class="icon_show_hide_card fas fa-chevron-up"></i>
                </div>
                <div class="card_body active">
                    @foreach ($tours as $tour)
                        <div class="border-top-card-tour">
                            <div class="row mb-3 mt-3">
                                <div class="col-auto">
                                    <i class="fab fa-accusoft"></i>
                                </div>
                                <div class="col-9">
                                    <span class="span-name-tour"> {{$tour->name}} </span>
                                    <span>Expires on {{$tour->endTime != null ? Carbon\Carbon::parse($tour->endTime)->format('Y-m-d') : 'N/A'}}</span>
                                </div>
                                <div class="col-auto" style="padding-left: 50px;">
                                    <a class="btn btn-manage-tour btn-page-loader" href="{{env('APP_URL')}}/administrator/tours/{{$tour->id}}"> Manage </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup-create-tour" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Tour</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/administrator/tours/save-create" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1">Tour Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Enter name tour" required>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" >Start time</label>
                                <input class="form-control" name="start_at" type="date" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">End time</label>
                                <input class="form-control"  name="end_at" type="date" required>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-12">
                                <label class="small mb-1" >Location</label>
                                <input class="form-control"  name="location" type="text" placeholder="Enter your location" required>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-12">
                                <label class="small mb-1" for="">Banner Tour</label>
                                <div class="card" style="width: 100%">
                                    <div class="upload-box" style="display: block; width: 100%">
                                        <div class="upload-text text-center" style="width: 100%">
                                            <div class="upload-form border-dashed" style="height: 100%;">
                                                <div class="m-4"> 
                                                    <input type="hidden"name="image" value="">
                                                    <input type="file"  hidden id="popup-create-tour__file-input">
                                                    <button type="button" class="btn btn-primary" id="popup-create-tour__upload-img-btn"><i class="fas fa-upload"></i> Upload Banner</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-box" style="display: none ;width: 100%; padding:1rem;">
                                        <div class="upload-text text-center">
                                            <img id="popup-create-tour__preview-img" src="" style="height: 100%;height: 400px; width:100%" alt="">
                                        </div>
                                        <div class="m-4" style="display: flex;justify-content: center;align-items: center;position: absolute;width: 90%;height: 400px;top: 0;">
                                            <button type="button" class="btn btn-danger" id="popup-create-tour__remove-btn">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Tour Description</label>
                            <textarea name="description"  placeholder="Enter your tour description" class="form-control" rows="6" required></textarea>
                        </div>
                        <!-- Form Group (create account submit)-->
                        <button id="popup-create-tour__save-btn" type="submit" class="btn btn-primary btn-block"> <span class="icon-loader-form"></span> Create New Tour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#popup-create-tour__upload-img-btn').click(function () { $('#popup-create-tour__file-input').trigger('click')});

        $('#popup-create-tour__file-input').change(function () {  
            let file = this.files[0];
            $('#popup-create-tour__save-btn').prop('disabled', true);
            if(file != null){
                $('#popup-create-tour__preview-img').attr('src', URL.createObjectURL(file));
                $('#popup-create-tour').find('.upload-box').hide();
                $('#popup-create-tour').find('.preview-box').show();

                let data = new FormData();
                data.append('file', file);
                let ajax = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/storage/upload",
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: data,
                    dataType: 'json',
                    success: function (res) { 
                        if (res != null) {
                            $('#popup-create-tour').find('input[type="hidden"][name="image"]').val(res.url);
                            $('#popup-create-tour__save-btn').prop('disabled', false);
                        }
                    }
                });
            }
        })

        $('#popup-create-tour__remove-btn').click(function(){
            $('#popup-create-tour').find('.upload-box').show();
            $('#popup-create-tour').find('.preview-box').hide();
            $('#popup-create-tour').find('input[type="hidden"][name="image"]').val(null);
        });
    </script>

@endsection

