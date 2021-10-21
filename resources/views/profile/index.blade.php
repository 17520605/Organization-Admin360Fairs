@extends('layouts.super')
@section('content')
    @php
        xdebug_break();
    @endphp
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, Khai 👋 </h3>
            </div>
            <div class="card" style="background: radial-gradient(circle, rgba(47,87,203,1) 50%, rgba(78,115,223,1) 100%);">
                <div class="card-body profile-user-box">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img style="width: 150px; height: 150px; border: 2px" src="https://scontent.fsgn2-1.fna.fbcdn.net/v/t1.6435-9/51568341_850608448607841_3264893430995615744_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=CPJKKX-F2m4AX9zLCro&_nc_ht=scontent.fsgn2-1.fna&oh=d6893deb5c95b0f9957ee0bdee11b4ed&oe=61964E14" alt="" class="rounded-circle img-thumbnail">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <h4 class="mt-1 text-white font-weight-bold" style="margin-bottom: 15px">Nguyễn Hữu Minh Khai</h4>
                                        <h6 class="font-13 text-white-50"><i class="fas fa-envelope" style="margin-right: 5px"></i><span> nguyenhuuminhkhai@mail.com</span></h6>
                                        <h6 class="font-13 text-white-50"><i class="fas fa-phone-alt" style="margin-right: 5px"></i><span> 0969888999</span></h6>
                                        <h6 class="font-13 text-white-50"><i class="fas fa-map-marker-alt" style="margin-right: 5px"></i><span> Linh Trung Thu Duc TP Ho Chi Minh VietNam</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                <button class="btn btn-edit-profile" data-toggle="modal" data-target="#create_profile"><i class="fas fa-user-cog"></i></button>
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

    <div class="modal fade" id="create_profile"  tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <a href="javascript:void(0)" class="active" id="btn-form-business-profile" style="width: 50%;">
                                    <div class="d-block d-sm-inline">Profile Business</div>
                                </a>
                                <a href="javascript:void(0)" id="btn-form-personal-profile" style="width: 50%;">
                                    <div class="d-block d-sm-inline">Profile Personal</div>
                                </a>
                            </nav>
                        </div>
                        <div class="">
                            <div class="form-step1 profile__upload-box">
                                <div class="mb-3">
                                    <label class="small mb-1" for="">Organization Name</label>
                                    <input class="form-control" id="" type="text" placeholder="Enter Organization Name">
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Email</label>
                                        <input class="form-control" id="" type="email" placeholder="Enter Type Email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Phone</label>
                                        <input class="form-control" id="" type="tel" placeholder="Enter your Phone">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Address</label>
                                        <input class="form-control" id="" type="text" placeholder="Enter location company">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Link Website</label>
                                        <input class="form-control" id="" type="text" placeholder="Enter your website">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Link Facebook</label>
                                        <input class="form-control" id="" type="text" placeholder="Enter your link facebook">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Link Youtube</label>
                                        <input class="form-control" id="" type="text" placeholder="Enter your link youtube">
                                    </div>
                                </div>
                                <div class="modal-footer" style="padding: 0.85rem 0px;">
                                    <a class="btn btn-primary btn-block" href="">Create Organization Profile</a>
                                </div>
                            </div>
                            <div class="form-step2 profile__upload-box" style="display: none">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">First Name</label>
                                        <input class="form-control" id="" type="text" placeholder="Enter your First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Last Name</label>
                                        <input class="form-control" id="" type="text" placeholder="Enter your Last Name">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Email</label>
                                        <input class="form-control" id="" type="email" placeholder="Enter Type Email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Phone</label>
                                        <input class="form-control" id="" type="tel" placeholder="Enter your Phone">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Gender</label>
                                        <select class="form-control" name="" id="">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Link Website</label>
                                        <input class="form-control" id="" type="text" placeholder="Enter your website">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Link Facebook</label>
                                        <input class="form-control" id="" type="text" placeholder="Enter your link facebook">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="">Link Youtube</label>
                                        <input class="form-control" id="" type="text" placeholder="Enter your link youtube">
                                    </div>
                                </div>
                                <div class="modal-footer" style="padding: 0.85rem 0px;">
                                    <a class="btn btn-primary btn-block" href="">Create Personal Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

