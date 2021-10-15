@extends('layouts.master')

@section('content')
    <div class="container-fluid" style="margin-bottom: 3rem;">
        <h1 class="h3 mb-2 text-gray-800">Booths</h1>
        <div class="row" style="margin-bottom: 1.5rem;">
            <div class="col-md-7">
                <div class="card" style="width: 100%; height: 50vh;padding: 0.25rem;">
                </div>
            </div>
            <div class="col-md-5">
                <div class="card" style="height: 50vh;">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-truncate font-size-15">TÊN BOOTHS</h5>
                                <p class="text-muted"><i class="fas fa-trophy"></i> Loại Booths</p>
                                <p class="text-muted"><i class="fas fa-dice-d6"></i> Tên đại diện : Nguyễn Hữu Minh Khai</p>
                            </div>
                        </div>
                        <h6 class="font-size-15 mt-1" style="font-weight: 700;">Contact Details :</h6>
                        <p class="text-muted"><i class="fas fa-phone-square-alt"></i> Phone Number : <span>0969-888-999</span></p>
                        <p class="text-muted"><i class="fas fa-envelope-square"></i> Email Booth : <span>Nguyenhuuminhkhai@gmail.com</span></p>
                        <p class="text-muted"><i class="fas fa-map-marked"></i> Address : <span>Trường đại học công nghệ thông tin HCM</span></p>
                        <div class="row">
                            <div style="padding-left: 1rem;padding-right: 1rem;">
                                <h6 style="font-weight: 700;">Booth Manager:</h6>
                                <a href="javascript:void(0);">
                                    <img src="./../asset/images/undraw_profile_1.svg" style="width: 55px; height: 55px;" class="rounded-circle img-thumbnail avatar-sm" alt="friend">
                                </a>
                                <a href="javascript:void(0);">
                                    <img src="./../asset/images/undraw_profile_1.svg" style="width: 55px; height: 55px;" class="rounded-circle img-thumbnail avatar-sm" alt="friend">
                                </a>
                                <a href="javascript:void(0);">
                                    <img src="./../asset/images/undraw_profile_1.svg" style="width: 55px; height: 55px;" class="rounded-circle img-thumbnail avatar-sm" alt="friend">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1.5rem;">
            <div class="col-md-12">
                <div class="card" style="width: 100%; height: 80vh;padding: 0.25rem;">
                    <div class="col-md-12">
                        <div class="card-body" style="color: #555; font-size: 14px;">
                            <div class="d-flex">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-15">Object Zone <button class="btn btn-df" onclick="openPopupCreateObject('audio')" style="position: absolute; right: 1.5rem;top: 1rem;" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new file</button></h5>
                                </div>
                            </div>
                            <div class="row" style="height: 65vh; margin-top: 20px; overflow-y: scroll;">
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Choose Object for Booths</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" style="border-radius:0 ;">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <div class="modal-body" style="flex: 0 1 0%;">
                            <nav class="nav_profile">
                                <a href="javascript:void(0)" class="active" id="switch-local-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline"><i class="fas fa-file-image"></i> Images</div>
                                </a>
                                <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline"><i class="fas fa-file-video"></i> Videos</div>
                                </a>
                                <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline"><i class="fas fa-file-audio"></i> Audios</div>
                                </a>
                                <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline"><i class="fas fa-file-prescription"></i> Modes</div>
                                </a>
                            </nav>
                            <div class="step-1">
                                <div class="row" style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                    <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file" style="border-radius:0 ;">
                                                <label class="image-checkbox">
                                                    <img class="img-responsive" src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" style="width: 100%;">
                                                    <input name="image[]" value="" type="checkbox">
                                                    <i class="fa fa-check hidden"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-2" style="display: none;">
                                <div class="row" style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                    <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file" style="border-radius:0 ;">
                                                <label class="image-checkbox">
                                                    <img class="img-responsive" src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" style="width: 100%;">
                                                    <input name="image[]" value="" type="checkbox">
                                                    <i class="fa fa-check hidden"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-3" style="display: none;">
                                <div class="row" style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                    <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file" style="border-radius:0 ;">
                                                <label class="image-checkbox">
                                                    <img class="img-responsive" src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" style="width: 100%;">
                                                    <input name="image[]" value="" type="checkbox">
                                                    <i class="fa fa-check hidden"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-4" style="display: none;">
                                <div class="row" style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                    <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file" style="border-radius:0 ;">
                                                <label class="image-checkbox">
                                                    <img class="img-responsive" src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" style="width: 100%;">
                                                    <input name="image[]" value="" type="checkbox">
                                                    <i class="fa fa-check hidden"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-df1" type="button" data-dismiss="modal">Save Change</button>
                </div>
            </div>
        </div>
    </div>
@endsection
