@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, Khai 👋 </h3>
                <button class="btn btn-add-tour" data-toggle="modal" data-target="#create_profile"><i class="fas fa-plus" style="margin-right: 10px;"></i> Create Profile</button>
            </div>
            <div class="card border-5 pt-2 active pb-0 px-3">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-12 ">
                            <h4 class="card-title" style="color: #35373b;"><b>Company Culture</b></h4>
                        </div>
                        <div class="col">
                            <h6 class="card-subtitle mb-2 text-muted">
                                <p class="card-text text-muted small "> 
                                    <img src="https://img.icons8.com/color/26/000000/christmas-star.png" class="mr-1 " width="19" height="19" id="star"> <span class="vl mr-2 ml-0"></span> <i class="fa fa-users text-muted "></i> Public 
                                    <span class="vl ml-1 mr-2 "></span>Updated by 1 Nov , 2018 
                                </p>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white px-0 ">
                    <div class="row">
                        <div class=" col-md-auto ">
                            <a href="#" class="btn btn-outlined btn-black text-muted"><i class="fas fa-cog" style="margin-right: 5px;"></i> <small>SETTINGS</small></a>
                            <a href="#" class=" btn-outlined btn-black text-muted"> <i class="fas fa-link" style="margin-right: 5px;"></i><small>PROGRAM LINK</small> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Profile Organization</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-step1" style="margin-bottom: 30px">
                        <div class="row justify-content-center">
                            <!-- Create Organization-->
                            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 mt-4" >
                                <div class="card text-center h-100" >
                                    <div class="card-body px-5 pt-5 d-flex flex-column" style=" border-radius: 10px 10px 0px 0px; background-image: url('https://khoinghiep.thuvienphapluat.vn/uploads/images/2019/05/09/dn2.jpg');background-size: 100%; ">
                                        <div>
                                            <div class="h3 text-primary" >Business Profile</div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent px-5 py-4">
                                        <div class="small text-center"><a id="btn-form-business-profile" class="btn btn-block btn-primary">Create profile</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Join Organization-->
                            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 mt-4">
                                <div class="card text-center h-100">
                                    <div class="card-body px-5 pt-5 d-flex flex-column align-items-between"  style=" border-radius: 10px 10px 0px 0px; background-image: url('https://static.tapchitaichinh.vn/images/upload/hoangthuviet/09062021/luatdoanhnghiep.jpeg'); background-size: 100%;">
                                        <div>
                                            <div class="h3 text-secondary1" style="color: #fff">Pesonal Profile</div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent px-5 py-4">
                                        <div class="small text-center"><a id="btn-form-personal-profile" class="btn btn-block btn-secondary1" >Create profile</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-step2" style="display: none">
                        <div class="mb-3">
                            <label class="small mb-1" for="">Organization Name</label>
                            <input class="form-control" id="" type="text" placeholder="Enter Organization Name">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="">Organization Email</label>
                                <input class="form-control" id="" type="email" placeholder="Enter Type Email">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="">Organization Phone</label>
                                <input class="form-control" id="" type="tel" placeholder="Enter your Phone">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Link Images or Link Model 3D Company</label>
                            <input placeholder="Enter Link Image or Model 3D Of Company" class="form-control">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="">Organization Location Company</label>
                                <input class="form-control" id="" type="text" placeholder="Enter location company">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="">Organization link Website</label>
                                <input class="form-control" id="" type="text" placeholder="Enter your website">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Organization Description</label>
                            <textarea placeholder="Enter your tour description" class="form-control" name="" id="" rows="6"></textarea>
                        </div>
                        <!-- Form Group (create account submit)-->
                        <a class="btn btn-primary btn-block" href="">Create Organization Profile</a>
                    </div>
                    <div class="form-step3" style="display: none">
                        <div class="mb-3">
                            <label class="small mb-1" for="">Full Name</label>
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
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Link Images or Link Model 3D </label>
                            <input placeholder="Enter Link Image or Model 3D " class="form-control">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="">Location</label>
                                <input class="form-control" id="" type="text" placeholder="Enter location company">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="">Link Website</label>
                                <input class="form-control" id="" type="text" placeholder="Enter your website">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Description</label>
                            <textarea placeholder="Enter your tour description" class="form-control" name="" id="" rows="6"></textarea>
                        </div>
                        <!-- Form Group (create account submit)-->
                        <a class="btn btn-primary btn-block" href="">Create Personal Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

