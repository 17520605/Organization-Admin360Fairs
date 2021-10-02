@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, <span>Khai</span> 👋 </h3>
                <button class="btn btn-add-tour" data-toggle="modal" data-target="#add_newtour"><i class="fas fa-plus" style="margin-right: 10px;"></i> Add New Tour</button>
            </div>
            <div class="border_card">
                <div class="card_header">
                    <span>Tours</span>
                    <i onclick="onActiveTourCard()" class="icon_show_hide_card fas fa-chevron-up"></i>
                </div>
                <div class="card_body active">
                    @foreach ($tours as $tour)
                        <div class="row mb-3 mt-3">
                            <div class="col-auto">
                                <i class="fab fa-accusoft"></i>
                            </div>
                            <div class="col-9">
                                <span class="span-name-tour"> {{$tour->name}} </span>
                                <span>Expires on {{$tour->end_at != null ? $tour->end_at : 'N/A'}}</span>
                            </div>
                            <div class="col-auto" style="padding-left: 50px;">
                                <a href="{{env('APP_URL')}}/tours/{{$tour->id}}" class="btn btn-manage-tour"> Manage </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_newtour" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Tour</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="small mb-1" for="">Tour Name</label>
                            <input class="form-control" id="" type="text" placeholder="Enter email address">
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
                            <label class="small mb-1" for="inputUsername">Tour Description</label>
                            <textarea placeholder="Enter your tour description" class="form-control" name="" id="" rows="6"></textarea>
                        </div>
                        <!-- Form Group (create account submit)-->
                        <a class="btn btn-primary btn-block" href="">Create New Tour</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

