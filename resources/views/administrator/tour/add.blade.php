@extends('layouts.master')

@section('content')
    <div class="container-fluid profile-tour">
        <div class="container-fluid">
            <section class="content">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Tour Picture</div>
                            <div class="card-body text-center">
                                <img class=" mb-2" style="width: 100%;" src="https://gconnect.edu.vn/wp-content/uploads/2016/06/bg-slide-01.jpg" alt="">
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                <button class="btn btn-primary" type="button">Upload new image</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header">Tour Edit
                                <span style="position: absolute; right: 10px; top: 8px;">
                                    <button class="btn btn-df1" style="padding: 5px 25px;margin-right: 5px; font-weight: 600;"><i class="fas fa-cog"></i> Configs </button>
                                    <button class="btn btn-df1" style="padding: 5px 25px;font-weight: 600;"><i class="fas fa-blog"></i> Public </button>
                                </span>
                            </div>

                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputUsername">Tour Name</label>
                                        <input class="form-control" id="inputUsername" type="text" placeholder="Enter Tour Name">
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Start time</label>
                                            <input class="form-control" id="inputFirstName" type="date">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLastName">End time</label>
                                            <input class="form-control" id="inputLastName" type="date">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputOrgName">Type Tour</label>
                                            <input class="form-control" id="inputOrgName" type="text" placeholder="Enter Type tour">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLocation">Location</label>
                                            <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputUsername">Tour Name</label>
                                        <textarea placeholder="Enter your tour description" class="form-control" name="" id="" rows="6"></textarea>
                                    </div>
                                    <button class="btn btn-primary" type="button">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
