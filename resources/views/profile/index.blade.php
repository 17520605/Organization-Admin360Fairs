@extends('layouts.super')
@section('content')
    @php
        xdebug_break();
    @endphp
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

