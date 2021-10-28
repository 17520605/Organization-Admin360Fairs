@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, <span> {{$profile->name}} </span> 👋 </h3>
                <button class="btn btn-add-tour" data-toggle="modal" data-target="#popup-create-tour"><i class="fas fa-plus" style="margin-right: 10px;"></i> Add New Tour</button>
            </div>
            <div class="border_card">
                <div class="card_header">
                    <span>Tours</span>
                    <i onclick="onActiveTourCard()" class="icon_show_hide_card fas fa-chevron-up"></i>
                </div>
                <div class="card_body active">
                    @foreach ($tours as $tour)
                        <div class="border-top-card-tour">
                            <div class="row mb-3 mt-3">
                                <div class="col-auto">
                                    <i class="fab fa-accusoft"></i>
                                </div>
                                <div class="col-9">
                                    <span class="span-name-tour"> {{$tour->name}} </span>
                                    <span>Expires on {{$tour->endTime != null ? Carbon\Carbon::parse($tour->endTime)->format('Y-m-d') : 'N/A'}}</span>
                                </div>
                                <div class="col-auto" style="padding-left: 50px;">
                                    <a href="{{env('APP_URL')}}/administrator/tours/{{$tour->id}}" class="btn btn-manage-tour"> Manage </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup-create-tour" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Tour</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/administrator/tours/save-create" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1">Tour Name</label>
                            <input class="form-control" name="name" type="text" placeholder="Enter email address">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" >Start time</label>
                                <input class="form-control" name="start_at" type="date">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">End time</label>
                                <input class="form-control"  name="end_at" type="date">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-12">
                                <label class="small mb-1" >Location</label>
                                <input class="form-control"  name="location" type="text" placeholder="Enter your location">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Tour Description</label>
                            <textarea name="description"  placeholder="Enter your tour description" class="form-control" rows="6"></textarea>
                        </div>
                        <!-- Form Group (create account submit)-->
                        <button type="submit" class="btn btn-primary btn-block icon-loader-show"> <span class="loader-icon-btn"></span> Create New Tour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

