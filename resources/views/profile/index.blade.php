@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, <span> {{$profile->name}} </span> 👋 </h3>
            </div>
            <div class="card" style="background: radial-gradient(circle, rgba(47,87,203,1) 50%, rgba(78,115,223,1) 100%);">
                <div class="card-body profile-user-box">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        @if ($profile->avatar != null || $profile->avatar !='')
                                            <img style="width: 150px; height: 150px; border: 2px ;object-fit: cover;" src="{{$profile->avatar}}" alt="" class="rounded-circle img-thumbnail">
                                        @else
                                            <img style="width: 150px; height: 150px; border: 2px ;object-fit: cover;" src="{{asset('/admin-master/asset/images/undraw_profile.svg')}}" alt="" class="rounded-circle img-thumbnail">
                                        @endif
                                        <button onclick="onOpenPopupUploadAvatar(this)" data-id-profile="{{$profile->id}}" class="btn btn-default change-avatar-profile"><i class="fas fa-pen"></i></button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <h4 class="mt-1 text-white font-weight-bold" style="margin-bottom: 15px">{{$profile->name != null ? $profile->name : 'N/A'}}</h4>
                                        <h6 class="font-13 text-white-50"><i class="fas fa-envelope" style="margin-right: 5px"></i><span> {{$profile->email != null ? $profile->email : 'N/A'}}</span></h6>
                                        <h6 class="font-13 text-white-50"><i class="fas fa-phone-alt" style="margin-right: 5px"></i><span> {{$profile->contact != null ? $profile->contact : 'N/A'}}</span></h6>
                                        <h6 class="font-13 text-white-50" style="max-width: 500px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><i class="fas fa-map-marker-alt" style="margin-right: 9px"></i><span> {{$profile->address != null ? $profile->address : 'N/A'}}</span></h6>
                                        <h6 class="font-13 text-white-50"><i class="fab fa-black-tie" style="margin-right: 7px"></i></i><span> {{$profile->type != null ? $profile->type : 'N/A'}}</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                <button class="btn btn-edit-profile" onclick="onOpenPopupEditProfile(this);"><i class="fas fa-user-cog"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-4">
                <div class="mt-2 mb-2" style="position: relative; display: flex;align-items: center;justify-content: center;width: 100%;">
                    <img src="{{$profile->logo != null ? $profile->logo : 'https://davidmeessen.com/wp-content/uploads/2019/11/yourlogohere-1-2-3-1-1.png'}}" style="max-width: 300px;" alt="">
                    <button onclick="onOpenPopupUploadLogo(this)" data-id-profile="{{$profile->id}}" class="btn btn-default change-avatar-profile" style="background: #4666c7;color:#FFF;position: relative"><i class="fas fa-pen"></i></button>
                </div>
                <span style="padding: 10px;font-size: 20px;color: #444">{{$profile->description != null ? $profile->description : 'This is description of company'}} </span>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-lg-12" style="min-height: 450px">
                    <div>
                        <ul class="nav nav-pills" id="myTabalt" role="tablist" style="padding: 15px ">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab1" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile" aria-expanded="true">List Images Popular</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab1" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-expanded="true">Image Introduce</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="video-tab1" data-toggle="tab" href="#video1" role="tab" aria-controls="video">Video Introduce</a>
                            </li>
                        </ul>
                        <div class="tab-content text-muted" id="myTabaltContent">
                            <div role="tabpanel" class="tab-pane fade in active show" id="profile1"  aria-labelledby="profile-tab">
                                <div class="mt-4">
                                    <div class="col-sm-12 popular_img" >
                                        <form action="/profile/save-edit-image-popular" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$profile->id}}">
                                            <div class="row">
                                                @php
                                                    $images = json_decode($profile->imagesId, TRUE);
                                                @endphp
                                                @for ( $i = 0; $i < count($images); $i++)
                                                <div class="col-sm-4 mb-3 dropify-file-wrapper">
                                                    <input type="hidden" class="changed" name="changedFiles[]" value="0">
                                                    <input type="file" name="file{{$i+1}}" class="dropify" data-default-file="{{\App\Services\StorageService::getUrl($images[$i])}}" data-max-file-size="10M">
                                                </div>
                                                @endfor
                                                @for (; $i < 6; $i++)
                                                <div class="col-sm-4 mb-3 dropify-file-wrapper">
                                                    <input type="hidden" class="changed" name="changedFiles[]" value="0">
                                                    <input type="file" name="file{{$i+1}}" class="dropify" data-max-file-size="10M">
                                                </div>
                                                @endfor
                                            </div>
                                            <button class="btn btn-primary btn-block btn-icon-loader" disabled type="submit" id="save-edit-images-popular">Save Edit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="home1" aria-labelledby="home-tab">
                                <div class="row mt-4 mb-4" id="box-cv-up">
                                    <div class="col-12 box-dropify" id="upload-box-cv" style="display: {{$profile->profile == '' ? 'block' : 'none'}}">
                                        <input type="file" class="dropify" id="upload-cv__local-file-hidden-input">
                                    </div>
                                    <div class="col-12" id="preview-box-cv" style="display: {{$profile->profile == '' ? 'none' : 'block'}}"> 
                                        <button class="btn btn-edit-cv" data-cv-id="{{$profile->id}}" onclick="onOpenPopupDeleteCV(this)"><i class="far fa-trash-alt"></i></button>
                                        <img id="preview-box-cv-img" style="width: 100%; border-radius: 5px;" src="{{$profile->profile == '' ? '':$profile->profile}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="video1" role="tabpanel" aria-labelledby="video-tab">
                                <div class="row mt-4 mb-4 box-dropify" id="box-vd-up">
                                    <div class="col-12" id="upload-box-video">
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="">Link Youtube</label>
                                                <input class="form-control" id="upload-vd__local-file-hidden-input" name="youtube" type="text" placeholder="Enter your link youtube" value="{{$profile->video}}"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" id="preview-box-video">
                                        <img id="preview-box-video-img" style="width: 100%;height: 600px; border-radius: 5px; display: {{$profile->profile != null ? 'none' : 'block'}} " src="http://baidich.com/images/noyoutube.jpg" />
                                        <iframe id="preview-box-video-iframe" style="width: 100%;height: 600px; border-radius: 5px; display: {{$profile->profile == null ? 'none' : 'block'}}" src="{{$profile->video == '' ? '':$profile->video}}" frameborder="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    {{-- POPUP UPLOAD INFO --}}
    <div class="modal fade" id="popup_create_profile"  tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Profile Organization</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <div class="">
                            {{-- PESONAL --}}
                            <div class="form-step2 profile__upload-box">
                                <form action="/profile/save-edit" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="profile_personal_edit_id" value="{{$profile->id}}">
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-9">
                                            <label class="small mb-1" for="">Name Organization</label>
                                        <input class="form-control" name="name" type="text" placeholder="Enter Your Full Name" value="{{$profile->name}}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="small mb-1" for="">Type</label>
                                            <select name="type" id="type_profile"  class="form-control">
                                                <option value="bussiness">Bussiness</option>
                                                <option value="personal">Personal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Email</label>
                                            <input class="form-control" name="email" disabled type="email" placeholder="Enter Your Email" value="{{$profile->email}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Phone</label>
                                            <input class="form-control" name="contact" type="tel" placeholder="Enter Your Phone" value="{{$profile->contact}}">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Address</label>
                                            <input class="form-control" name="address" type="text" placeholder="Enter Your Address" value="{{$profile->address}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Link Website</label>
                                            <input class="form-control" name="website" type="text" placeholder="Enter your website" value="{{$profile->website}}">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Link Facebook</label>
                                            <input class="form-control" name="facebook" type="text" placeholder="Enter your link facebook" value="{{$profile->facebook}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Link Youtube</label>
                                            <input class="form-control" name="youtube" type="text" placeholder="Enter your link youtube" value="{{$profile->youtube}}"> 
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="">Discription</label>
                                        <textarea class="form-control" name="description" rows="6" placeholder="Enter description">{{$profile->description}}</textarea>
                                    </div>
                                    <div class="modal-footer" style="padding: 0.85rem 0px;">
                                        <button class="btn btn-primary btn-block btn-icon-loader" type="submit"> <span class="icon-loader-form"></span>Save Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- POPUP UPLOAD AVATAR --}}
    <div class="modal fade" id="popup-upload-avatar" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Upload Avatar</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <div>
                            <form action="/profile/save-avatar" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <div class="form_upload" style="display: {{$profile->avatar != null ? 'none' : 'block'}};">
                                        <input type="hidden" name="avatar" id="popup-upload-avatar__url-hidden-input" >
                                        <input type="hidden" name="id" value="{{$profile->id}}">
                                        <input type="file"  id="popup-upload-avatar__local-file-hidden-input" style="display: none">
                                        <button type="button" id="popup-upload-avatar__local-upload-btn" class="btn"><i class="fas fa-upload" style="font-size: 50px;"></i></button>
                                        <p>Drop your file here or Click to browse</p>
                                    </div>
                                    <div class="form_preview avatar" style="display: {{$profile->avatar != null ? 'block' : 'none'}};">
                                        <img id="popup-upload-avatar__local-preview-img" src="{{$profile->avatar?$profile->avatar:''}}" style="border-radius: 5px;" >
                                        <div class="remove_item_object">
                                            <div id="popup-upload-avatar__local-remove-btn" class="btn_remove ">Remove</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"  style="padding: 0.85rem 0px;">
                                    <button id="popup-upload-avatar__local-save-btn" class="btn btn-primary btn-block" disabled><span class="icon-loader-form"></span> Save New Avatar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- POPUP UPLOAD LOGO --}}
    <div class="modal fade" id="popup-upload-logo" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Upload Logo</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <div>
                            <form action="/profile/save-logo" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <div class="form_upload" style="display: {{$profile->logo != null ? 'none' : 'block'}};">
                                        <input type="hidden" name="logo" id="popup-upload-logo__url-hidden-input" >
                                        <input type="hidden" name="id" value="{{$profile->id}}">
                                        <input type="file"  id="popup-upload-logo__local-file-hidden-input" style="display: none">
                                        <button type="button" id="popup-upload-logo__local-upload-btn" class="btn"><i class="fas fa-upload" style="font-size: 50px;"></i></button>
                                        <p>Drop your file here or Click to browse</p>
                                    </div>
                                    <div class="form_preview logo" style="display: {{$profile->logo != null ? 'block' : 'none'}};">
                                        <img id="popup-upload-logo__local-preview-img" src="{{$profile->logo?$profile->logo:''}}" style="border-radius: 5px;" >
                                        <div class="remove_item_object">
                                            <div id="popup-upload-logo__local-remove-btn" class="btn_remove ">Remove</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"  style="padding: 0.85rem 0px;">
                                    <button id="popup-upload-logo__local-save-btn" class="btn btn-primary btn-block" disabled><span class="icon-loader-form"></span> Save New Logo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- POPUP DELETE CV --}}
    <div class="modal fade" id="popup-confirm-delete-cv" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="popup-edit-partner__form" class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h5 class="fw-light">Delete introduce company </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <p>Do you really want to delete it?</p>
                    </div>
                    <div class="modal-footer" style="padding: 0">
                        <span class="icon-loader-form-delete" style="left: 10px; margin-left: 2px; margin-top: 6px;"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="popup-confirm-delete-cv__delete-btn" type="button" class="btn btn-danger btn-icon-loader"> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        
    {{-- POPUP DELETE CV --}}
    <div class="modal fade" id="popup-confirm-delete-video" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="popup-edit-partner__form" class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h5 class="fw-light">Delete Video Introduce </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <p>Do you really want to delete it?</p>
                    </div>
                    <div class="modal-footer" style="padding: 0">
                        <span class="icon-loader-form-delete" style="left: 10px; margin-left: 2px; margin-top: 6px;"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="popup-confirm-delete-video__delete-btn" type="button" class="btn btn-danger btn-icon-loader"> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function onOpenPopupEditProfile(target){
            let profileId = $(target).attr('data-profile-id');
            $('#popup_create_profile').modal('show');
        }
        function onOpenPopupUploadAvatar(target){
            let profileId = $(target).attr('data-profile-id');
            $('#popup-upload-avatar').modal('show');
        }
        function onOpenPopupUploadLogo(target){
            let profileId = $(target).attr('data-profile-id');
            $('#popup-upload-logo').modal('show');
        }
        function onOpenPopupDeleteCV(target){
            let cvId = $(target).attr('data-cv-id');
            $('#popup-confirm-delete-cv').modal('show');
        }
        function onOpenPopupDeleteVD(target){
            let vdId = $(target).attr('data-video-id');
            $('#popup-confirm-delete-video').modal('show');
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#popup-upload-avatar__local-upload-btn').click(function (e) {  
                $('#popup-upload-avatar__local-file-hidden-input').trigger('click');
            });
            $('#popup-upload-logo__local-upload-btn').click(function (e) {  
                $('#popup-upload-logo__local-file-hidden-input').trigger('click');
            });
            $('#popup-upload-avatar__local-file-hidden-input').change(function () { 
                let type =$('#popup-upload-avatar').find('input[name="type"]').val();
                let file = this.files[0];
                if(file != null){
                    $('#popup-upload-avatar__local-preview-img').attr('src', URL.createObjectURL(this.files[0]));
                    $('#popup-upload-avatar').find(".form_upload").hide();
                    $('#popup-upload-avatar').find(".form_preview").show();
                    $('#popup-create-upload-avatar-save-btn').prop('disabled', true);
                    $('#popup-create-upload-avatar-remove-btn').hide();
                    
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
                                $('#popup-upload-avatar__local-save-btn').prop('disabled', false);
                                $('#popup-upload-avatar__url-hidden-input').val(res.url);
                                $('#popup-upload-avatar__local-remove-btn').show();
                            }
                        }
                    });
                }
            });

            $('#popup-upload-logo__local-file-hidden-input').change(function () { 
                let type =$('#popup-upload-logo').find('input[name="type"]').val();
                let file = this.files[0];
                if(file != null){
                    $('#popup-upload-logo__local-preview-img').attr('src', URL.createObjectURL(this.files[0]));
                    $('#popup-upload-logo').find(".form_upload").hide();
                    $('#popup-upload-logo').find(".form_preview").show();
                    $('#popup-create-upload-logo-save-btn').prop('disabled', true);
                    $('#popup-create-upload-logo-remove-btn').hide();
                    
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
                                $('#popup-upload-logo__local-save-btn').prop('disabled', false);
                                $('#popup-upload-logo__url-hidden-input').val(res.url);
                                $('#popup-upload-logo__local-remove-btn').show();
                            }
                        }
                    });
                }
            });

            $('#upload-cv__local-file-hidden-input').change(function () { 
                let file = this.files[0];
                if(file != null){
                    $('#box-cv-up').find("#preview-box-cv-img").attr('src', URL.createObjectURL(this.files[0]));
                    $('#box-cv-up').find("#upload-box-cv").hide();
                    $('#box-cv-up').find("#preview-box-cv").show();

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
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: "{{env('APP_URL')}}/profile/save-cv",
                                    type: 'POST',
                                    data : { id: {{$profile->id}} , url: res.url} ,
                                    dataType: 'json',
                                    success: function (res) { 
                                        if (res == 1) {
                                            tata.success('Thành công', 'Đã thay đổi thành công', {
                                                animate: 'slide',
                                                closeBtn: true,
                                            })
                                        }
                                    }
                                });
                            }
                        }
                    });
                }
            });

            function youtube_parser(url){
                var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
                var match = url.match(regExp);
                return (match&&match[7].length==11)? match[7] : false;
            }

            $('#upload-vd__local-file-hidden-input').change(function () { 
                let file = $('#upload-vd__local-file-hidden-input').val();
                
                if(file != null){
                    let youtubeId = youtube_parser(file);
                    let linkYoutube = 'https://www.youtube.com/embed/'+youtubeId;
                    if(youtubeId != null)
                    {
                        $('#preview-box-video-iframe').show();
                        $('#preview-box-video-img').hide();
                        $('#preview-box-video-iframe').attr('src',linkYoutube);
                        let data = new FormData();
                        data.append('file', file);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{env('APP_URL')}}/profile/save-vd",
                            type: 'POST',
                            data : { id: {{$profile->id}} , url: linkYoutube} ,
                            dataType: 'json',
                            success: function (res) { 
                                tata.success('Thành công', 'Đã thay đổi thành công', {
                                    animate: 'slide',
                                    closeBtn: true,
                                })
                            }
                        });
                    }
                    else
                    {
                        $('#preview-box-video-iframe').hide();
                        $('#preview-box-video-img').show();
                    }
                }
                else{
                    $('#preview-box-video-iframe').hide();
                    $('#preview-box-video-img').show();
                }
            });

            $('#popup-upload-avatar__local-remove-btn').click(function (e) { 
                $('#popup-upload-avatar__local-preview-img').attr('src', null);
                $('#popup-upload-avatar').find(".form_upload").show();
                $('#popup-upload-avatar').find(".form_preview").hide();
                $('#popup-upload-avatar__local-save-btn').prop('disabled', true);
                $('#popup-upload-avatar__local-remove-btn').hide();
                $('#popup-upload-avatar').find('input[name="url"]').val(null);

            });

            $('#popup-upload-logo__local-remove-btn').click(function (e) { 
                $('#popup-upload-logo__local-preview-img').attr('src', null);
                $('#popup-upload-logo').find(".form_upload").show();
                $('#popup-upload-logo').find(".form_preview").hide();
                $('#popup-upload-logo__local-save-btn').prop('disabled', true);
                $('#popup-upload-logo__local-remove-btn').hide();
                $('#popup-upload-logo').find('input[name="url"]').val(null);

            });

            $('#popup-confirm-delete-cv__delete-btn').click(function (){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/profile/delete-cv",
                    type: 'POST',
                    data :{ id: {{$profile->id}} , url:''} ,
                    dataType: 'json',
                    success: function (res) { 
                        if (res == 1) {
                           $('#popup-confirm-delete-cv').modal('hide');
                           $('#box-cv-up').find('#upload-box-cv').show();
                           $('#box-cv-up').find('#preview-box-cv').hide();
                           $('#box-cv-up').find('#preview-box-cv-img').attr('src','');
                        }
                        $('#save-edit-images-popular').find('.icon-loader-form').hide();
                    }
                });
            });
        });
    </script>
    
    {{-- AJAX UPLOAD AVATAR --}}
    <script>
        $('#popup-upload-avatar__local-save-btn').click(function(){
            $('#popup-upload-avatar').find('.icon-loader-form').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/administrator/profile/save-avatar",
                type: 'POST',
                dataType: 'json',
                success: function () { 
                    $('#popup-upload-avatar').find('.icon-loader-form').hide();
                    location.reload();
                }
            });
        });

        $('#popup-upload-logo__local-save-btn').click(function(){
            $('#popup-upload-logo').find('.icon-loader-form').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/administrator/profile/save-logo",
                type: 'POST',
                dataType: 'json',
                success: function () { 
                    $('#popup-upload-logo').find('.icon-loader-form').hide();
                    location.reload();
                }
            });
        });

        $('.dropify').dropify();
    </script>

    <script>
        $('.dropify-clear').click(function() {
            let wrapper = $(this).parents('.dropify-file-wrapper');
            wrapper.find('.changed').val(1);
            let inputFile = wrapper.find('.dropify');
        });

        $('.dropify').click(function() {
            let wrapper = $(this).parents('.dropify-file-wrapper');
            wrapper.find('.changed').val(1);
        });
        //dropify change 
        $('#profile1').find('.dropify').change(function(){
            $('#save-edit-images-popular').prop('disabled', false);
            $('#save-edit-images-popular').find('.icon-loader-form').show();
        })
    </script>
@endsection

