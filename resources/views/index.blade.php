@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <h3>Hi, Khai 👋 </h3>
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

@endsection

