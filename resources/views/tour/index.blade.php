@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 text-gray-800" style="margin: 0px">{{$tour->name}}</h1>
                    <a href="" class="btn btn-df" target="_blank" style="width: 180px; position: absolute ;top: 0.75rem; right: 1rem;"><i class="fas fa-cog"></i> Config Zone</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1.5rem;">
            <div class="col-md-5">
                <div class="card" style="height: 60vh;">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="font-size-14 font-weight-bold">ZONES : (<a style="color: #4e73df">7 / 8</a>)</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="font-size-14 font-weight-bold">BOOTHS : (<a style="color: #4e73df">7 / 8</a>)</h6>
                                    </div>
                                </div>
                                <p class="text-muted"><i class="fas fa-building"></i> Name organization : <span>CTTNHH ABCD</span></p>
                                <p class="text-muted"><i class="fas fa-envelope-square"></i> Email organization : <span>ctytnhhabc@gmail.com</span></p>
                                <p class="text-muted"><i class="fas fa-phone-square-alt"></i> Hotline organization : <span>0909909999</span></p>
                                <p class="text-muted"><i class="fas fa-map-marked"></i> Address organization : <span>{{$tour->location}}</span></p>
                            </div>
                        </div>
                        <h6 class="font-size-15 font-weight-normal">Project Details :</h6>
                        <div class="text-muted discription_tour_text" style="">
                            {{$tour->description != null ? $tour->description : 'N/A'}}
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div style="padding-left: 1rem;padding-right: 1rem;">
                                <h6 class="font-size-15 font-weight-normal"><i class="fas fa-users"></i> Tour manager :</h6>
                                <a href="javascript:void(0);">
                                    <img src="http://admin.360fairs.com/admin-master/asset/images/undraw_profile.svg" style="width: 50px; height: 50px;margin-left: 5px;" class="rounded-circle img-thumbnail avatar-sm" alt="friend">
                                </a>
                            </div>
                        </div>
                        <div class="task-dates row">
                            <div class="col-6">
                                <div class="mt-4">
                                    <h6 class="font-size-14"><i class="fas fa-calendar-alt" style="color: #4348dfb0;"></i> Start Date : <span>{{$tour->endTime != null ? Carbon\Carbon::parse($tour->startTime)->format('Y-m-d') : 'N/A'}}</span></h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-4">
                                    <h6 class="font-size-14"><i class="fas fa-calendar-alt" style="color: #4348dfb0;"></i> Due Date : <span>{{$tour->endTime != null ? Carbon\Carbon::parse($tour->endTime)->format('Y-m-d') : 'N/A'}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-7">
                <div class="card" style="width: 100%; height: 60vh;padding: 0.25rem;">
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1.5rem;">
            <div class="col-md-4">
                <div class="card" style="height: 55vh;">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-truncate font-size-15">Object Zone</h5>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-6" style="margin-bottom: 1rem;">
                                <div class="shadow-none border card">
                                    <div class="p-3 card-body">
                                        <div class="">
                                            <div class="avatar-xs me-3 mb-3">
                                                <div class="avatar-title bg-transparent rounded"><i class="fas fa-folder" style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i></div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="overflow-hidden me-auto">
                                                    <h6 class="font-size-14 text-truncate mb-1"><a class="text-body" href="/apps-filemanager">Development</a></h6>
                                                    <p class="text-muted text-truncate mb-0">20 Files</p>
                                                </div>
                                                <div class="align-self-end ms-2">
                                                    <p class="text-muted mb-0">8GB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" style="margin-bottom: 1rem;">
                                <div class="shadow-none border card">
                                    <div class="p-3 card-body">
                                        <div class="">
                                            <div class="avatar-xs me-3 mb-3">
                                                <div class="avatar-title bg-transparent rounded"><i class="fas fa-folder" style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i></div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="overflow-hidden me-auto">
                                                    <h6 class="font-size-14 text-truncate mb-1"><a class="text-body" href="/apps-filemanager">Development</a></h6>
                                                    <p class="text-muted text-truncate mb-0">20 Files</p>
                                                </div>
                                                <div class="align-self-end ms-2">
                                                    <p class="text-muted mb-0">8GB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" style="margin-bottom: 1rem;">
                                <div class="shadow-none border card">
                                    <div class="p-3 card-body">
                                        <div class="">

                                            <div class="avatar-xs me-3 mb-3">
                                                <div class="avatar-title bg-transparent rounded"><i class="fas fa-folder" style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i></div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="overflow-hidden me-auto">
                                                    <h6 class="font-size-14 text-truncate mb-1"><a class="text-body" href="/apps-filemanager">Development</a></h6>
                                                    <p class="text-muted text-truncate mb-0">20 Files</p>
                                                </div>
                                                <div class="align-self-end ms-2">
                                                    <p class="text-muted mb-0">8GB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" style="margin-bottom: 1rem;">
                                <div class="shadow-none border card">
                                    <div class="p-3 card-body">
                                        <div class="">

                                            <div class="avatar-xs me-3 mb-3">
                                                <div class="avatar-title bg-transparent rounded"><i class="fas fa-folder" style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i></div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="overflow-hidden me-auto">
                                                    <h6 class="font-size-14 text-truncate mb-1"><a class="text-body" href="/apps-filemanager">Development</a></h6>
                                                    <p class="text-muted text-truncate mb-0">20 Files</p>
                                                </div>
                                                <div class="align-self-end ms-2">
                                                    <p class="text-muted mb-0">8GB</p>
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
            <div class="col-md-8">
                <div class="card card_object_zone" style="height: 55vh;" >
                    <div class="card-body" >
                        <div class="row">
                            <div class="col-12 title">
                                <h6 class="text-gray-600 float-left">Objects </h6>
                                <button class="btn float-right"><i class="fas fa-plus"></i> Add </button>
                            </div>
                        </div>
                        <div class="row list_object">
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                    alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                    alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                    alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                    alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                    alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                    alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                    alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                    alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                    alt="img" class="img-fluid">
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
        <div class="row">
            <div class="col-md-12">
                <div class="card  shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Images</th>
                                        <th>Price</th>
                                        <th>Link Products</th>
                                        <th>Code</th>
                                        <th>Booths</th>
                                        <th style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Brielle Williamson</td>
                                        <td><img class="products-tables" src="./../asset/images/apps-1.jpg" alt=""></td>
                                        <td>150$</td>
                                        <td>
                                            <a href="https://github.com/">https://github.com/</a>
                                        </td>
                                        <td>SALE123</td>
                                        <td>Booth-01</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="#"><i class="fa fa-pen"></i></a>
                                            <a class="btn btn-xs btn-danger" href="#"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Brielle Williamson</td>
                                        <td><img class="products-tables" src="./../asset/images/apps-1.jpg" alt=""></td>
                                        <td>150$</td>
                                        <td><a href="https://github.com/">https://github.com/</a></td>
                                        <td>SALE123</td>
                                        <td>Booth-01</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="#"><i class="fa fa-pen"></i></a>
                                            <a class="btn btn-xs btn-danger" href="#"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
