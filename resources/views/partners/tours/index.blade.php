@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, <span> {{$profile->name}}</span> 👋 </h3>
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
                                    <a href="{{env('APP_URL')}}/partner/tours/{{$tour->id}}" class="btn btn-manage-tour"> Manage </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

