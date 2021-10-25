@extends('layouts.partner')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">{{$tour->name}}</h1>
                    <div class="div_cardheader_btn">
                        <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#"><i class="fas fa-globe"></i> Publish </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1.5rem;">
            <div class="col-md-5" style="height: 60vh;">
                <div class="card" style="height: 48vh;">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex process-overview">
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="row" style="margin-bottom: 0.5rem">
                                    <div class="col-lg-2">
                                        <span style="color: #555;font-weight: 600 ;" >Zones : </span> 
                                    </div>
                                    <div class="col-lg-9">
                                        <span>
                                            <div id="progress-striped progress-xs" class="progress progress-striped mb-0">
                                                <div class="progress-bar progress-bar-warning" data-transitiongoal="43" aria-valuenow="43" style="width: 43%;">43%</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 1rem">
                                    <div class="col-lg-2">
                                        <span style="color: #555;font-weight: 600 ;" >Booths :</span> 
                                    </div>
                                    <div class="col-lg-9">
                                        <span>
                                            <div id="progress-striped progress-xs" class="progress progress-striped mb-0">
                                                <div class="progress-bar progress-bar-warning" data-transitiongoal="43" aria-valuenow="43" style="width: 43%;">43%</div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="font-size-15 font-weight-bold">General information: </h6>
                        <div class="d-flex">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-building mr-3"></i></span> <span> {{$profile->name != null ? $profile->name : "N/A" }} </span></p>
                                <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-map-marker-alt mr-3"></i></span> <span>{{$tour->location != null ? $tour->location : "N/A" }}</span></p>
                            </div>
                        </div>
                        <h6 class="font-size-15 font-weight-bold">Description: </h6>
                        <div class="text-muted discription_tour_text" style="max-height: 10rem">
                            {{$tour->description != null ? $tour->description : 'N/A'}}
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 2vh; height: 10vh;">
                    <div class="row">
                        <div class="col-5" style="margin-left: 20px;margin-top: 10px;">
                            <span style="font-size:12px">Start at</span>
                            <h6 style="font-size:15px"><i class="fas fa-calendar-alt mr-3" style="color: #4348dfb0;"></i><span>{{$tour->endTime != null ? Carbon\Carbon::parse($tour->startTime)->format('M-d  h:m') : 'N/A'}}</span></h6>
                        </div>
                        <div class="col-5" style="margin-left: 20px;margin-top: 10px;">
                            <span style="font-size:12px">End at</span>
                            <h6 style="font-size:15px"><i class="fas fa-calendar-alt mr-3" style="color: #4348dfb0;"></i><span>{{$tour->endTime != null ? Carbon\Carbon::parse($tour->endTime)->format('M-d  h:m') : 'N/A'}}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7" style="position: relative; height: 60vh;">
                <div class="card" style="width: 100%; height: 100%; padding:20px;">
                    <div id="viewer-container" style="width: 100%; height: 100%;">
                    </div>
                    <div class="bg-config-overview">
                        <a href="https://360fairs.com/" class="btn-config-overview ">
                            <i class="fas fa-cog"></i>
                            <span>Config</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="group-head">
                        <tr style="background: #eef2f7;">
                            <th style="text-align: center;width: 5%">#</th>
                            <th style="width: 15%;">Name</th>
                            <th style="width: 20%;">Owner</th>
                            <th style="width: 15%;">Last change at</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tr style="background-color: #4e73dfcf !important; color:#fff;">
                        <td colspan="8">
                            <span style="float: left">*</span>
                            <span style="float: right"> <i class="fas fa-caret-down"></i> </span>
                        </td>
                    </tr>
                    <tbody class="group-0" style="display: none" >
                        <tr>
                            <td colspan="10"><center><span>No booths</span></center></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
    <div class="modal fade" id="popup-edit-tour" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light"> Edit Tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="/administrator/tours/{{$tour->id}}/tour/save-edit" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small mb-1">Tour Name</label>
                        <input class="form-control" name="name" type="text" value="{{$tour->name}}" placeholder="Enter tour name" />
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Start at</label>
                            <input class="form-control" name="start" value="{{ Carbon\Carbon::parse($tour->startTime)->format('Y-m-d\TH:i')}}" type="datetime-local" />
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">End at</label>
                            <input class="form-control" name="end" value="{{ Carbon\Carbon::parse($tour->startTime)->format('Y-m-d\TH:i')}}" type="datetime-local" />
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                            <label class="small mb-1">Location</label>
                            <input class="form-control" name="location" value="{{$tour->location}}" type="text" placeholder="Enter your location" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1">Tour Description</label>
                        <textarea name="description" placeholder="Enter your tour description" class="form-control" rows="6"> {{$tour->description}} </textarea>
                    </div>
                    <!-- Form Group (create account submit)-->
                    <button type="submit" class="btn btn-primary btn-block">Update Edit Tour</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
