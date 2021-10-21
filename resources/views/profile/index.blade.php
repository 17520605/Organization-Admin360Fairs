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
                                            <img style="width: 150px; height: 150px; border: 2px" src="{{$profile->avatar}}" alt="" class="rounded-circle img-thumbnail">
                                        @else
                                            <img style="width: 150px; height: 150px; border: 2px" src="https://res.cloudinary.com/virtual-tour/image/upload/v1634823839/icons/default_avatar_jeqa4w.png" alt="" class="rounded-circle img-thumbnail">
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
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                <button class="btn btn-edit-profile" onclick="onOpenPopupEditProfile(this);"><i class="fas fa-user-cog"></i></button>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-12 upload-box-cv" style="display: none">
                    <div class="dropify-wrapper">
                        <div class="dropify-message">
                            <i class="fas fa-upload" style="font-size: 40px;"></i>
                            <p>Drag and drop a file here or click</p>
                            <p class="dropify-error">Ooops, something wrong appended.</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                            <ul></ul>
                        </div><input type="file" class="dropify"><button type="button" class="dropify-clear">Remove</button>
                        <div class="dropify-preview"><span class="dropify-render"></span>
                            <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                    <p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>
                                    <p class="dropify-infos-message">Drag and drop or click to replace</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3"></div>
                </div>
                <div class="col-12 preview-box-cv">
                    <button class="btn btn-edit-cv" data-toggle="modal" data-target="#create_profile"><i class="far fa-trash-alt"></i></button>
                    <img style="width: 100%; border-radius: 5px;" src="https://res.cloudinary.com/virtual-tour/image/upload/v1634802979/6a41bbc0ff3b5f81168190e86b5f2a10_hqwkdk.jpg" alt="">
                </div>
            </div> <!-- end row -->
        </div>
    </div>

    <div class="modal fade" id="popup_create_profile"  tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Profile Organization</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <div class="modal-body" style="flex: 0 1 0%;">
                            <nav class="nav_profile">
                                <a href="javascript:void(0)" class="{{$profile->type == 'company' ? 'active' : ''}}" id="btn-form-business-profile" style="width: 50%;">
                                    <div class="d-block d-sm-inline">Profile Business</div>
                                </a>
                                <a href="javascript:void(0)" class="{{$profile->type == 'personal' ? 'active' : ''}}" id="btn-form-personal-profile" style="width: 50%;">
                                    <div class="d-block d-sm-inline">Profile Personal</div>
                                </a>
                            </nav>
                        </div>
                        <div class="">
                        {{-- BUSINESS --}}
                            <div class="form-step1 profile__upload-box" style="display: {{$profile->type == 'company' ? 'block' : 'none'}}">
                                <form action="/profile/save-edit" method="POST">
                                    @csrf
                                    <input type="hidden" id="profile_business_edit_id" name="id" value="{{$profile->type == 'company' ? $profile->id : ''}}">
                                    <input type="hidden" id="profile_business_edit_type" name="type" value="company">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="">Organization Name</label>
                                        <input class="form-control" name="name" id="profile_business_edit_name" type="text" placeholder="Enter Organization Name" value="{{$profile->type == 'company' ? $profile->name : ''}}">
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Organization Email</label>
                                            <input class="form-control" name="email" id="profile_business_edit_email" disabled type="email" placeholder="Enter Type Email" value="{{$profile->type == 'company' ? $profile->email : ''}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Organization Phone</label>
                                            <input class="form-control" name="contact" id="profile_business_edit_contact" type="tel" placeholder="Enter your Phone" value="{{$profile->type == 'company' ? $profile->contact : ''}}">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Organization Address</label>
                                            <input class="form-control" name="address" id="profile_business_edit_address" type="text" placeholder="Enter location company" value="{{$profile->type == 'company' ? $profile->address : ''}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Link Website Organization</label>
                                            <input class="form-control" name="website" id="profile_business_edit_website" type="text" placeholder="Enter your website" value="{{$profile->type == 'company' ? $profile->website : ''}}">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Link Facebook Organization</label>
                                            <input class="form-control" name="facebook" id="profile_business_edit_facebook" type="text" placeholder="Enter your link facebook" value="{{$profile->type == 'company' ? $profile->facebook : ''}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Link Youtube Organization</label>
                                            <input class="form-control" name="youtube" id="profile_business_edit_youtube" type="text" placeholder="Enter your link youtube" value="{{$profile->type == 'company' ? $profile->youtube : ''}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="padding: 0.85rem 0px;">
                                        <button class="btn btn-primary btn-block" type="submit">Save Organization Profile</button>
                                    </div>
                                </form>
                            </div>
                            {{-- PESONAL --}}
                            <div class="form-step2 profile__upload-box" style="display: {{$profile->type == 'personal' ? 'block' : 'none'}}">
                                <form action="/profile/save-edit" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="profile_personal_edit_id" value="{{$profile->type == 'personal' ? $profile->id : ''}}">
                                    <input type="hidden" name="type" id="profile_personal_edit_type" value="personal">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="">Presonal Name</label>
                                        <input class="form-control" name="name" id="profile_personal_edit_name" type="text" placeholder="Enter Your Full Name" value="{{$profile->type == 'personal' ? $profile->name : ''}}">
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Email</label>
                                            <input class="form-control" name="email" id="profile_personal_edit_email" type="email" placeholder="Enter Your Email" value="{{$profile->type == 'personal' ? $profile->email : ''}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Phone</label>
                                            <input class="form-control" name="phone" id="profile_personal_edit_contact" type="tel" placeholder="Enter Your Phone" value="{{$profile->type == 'personal' ? $profile->contact : ''}}">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Address</label>
                                            <input class="form-control" name="address" id="profile_personal_edit_address" type="text" placeholder="Enter Your Address" value="{{$profile->type == 'personal' ? $profile->address : ''}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Link Website</label>
                                            <input class="form-control" name="website" id="profile_personal_edit_website" type="text" placeholder="Enter your website" value="{{$profile->type == 'personal' ? $profile->website : ''}}">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Link Facebook</label>
                                            <input class="form-control" name="facebook" id="profile_personal_edit_facebook" type="text" placeholder="Enter your link facebook" value="{{$profile->type == 'personal' ? $profile->facebook : ''}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Link Youtube</label>
                                            <input class="form-control" name="youtube" id="profile_personal_edit_youtube" type="text" placeholder="Enter your link youtube" value="{{$profile->type == 'personal' ? $profile->youtube : ''}}"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="padding: 0.85rem 0px;">
                                        <button class="btn btn-primary btn-block" type="submit">Save Personal Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                    <div class="form_upload">
                                        <input type="hidden" name="avatar" id="popup-upload-avatar__url-hidden-input" >
                                        <input type="hidden" name="id" value="{{$profile->id}}">
                                        <input type="file"  id="popup-upload-avatar__local-file-hidden-input" style="display: none">
                                        <button type="button" id="popup-upload-avatar__local-upload-btn" class="btn"><i class="fas fa-upload" style="font-size: 50px;"></i></button>
                                        <p>Drop your file here or Click to browse</p>
                                    </div>
                                    <div class="form_preview" style="display: none;">
                                        <img id="popup-upload-avatar__local-preview-img" src="" style="border-radius: 5px;" >
                                        <div class="remove_item_object">
                                            <div id="popup-upload-avatar__local-remove-btn" class="btn_remove ">Remove</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"  style="padding: 0.85rem 0px;">
                                    <button type="submit" id="popup-upload-avatar__local-save-btn" class="btn btn-primary btn-block" disabled>Save New Avatar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

    </script>   
<script>
    $(document).ready(function () {
        $('#popup-upload-avatar__local-upload-btn').click(function (e) {  
            $('#popup-upload-avatar__local-file-hidden-input').trigger('click');
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

        $('#popup-upload-avatar__local-remove-btn').click(function (e) { 
            $('#popup-upload-avatar__local-preview-img').attr('src', null);
            $('#popup-upload-avatar').find(".form_upload").show();
            $('#popup-upload-avatar').find(".form_preview").hide();
            $('#popup-upload-avatar__local-save-btn').prop('disabled', true);
            $('#popup-upload-avatar__local-remove-btn').hide();
            $('#popup-upload-avatar').find('input[name="url"]').val(null);

        });
    });
</script>

@endsection

