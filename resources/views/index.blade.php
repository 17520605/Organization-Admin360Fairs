@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <h3>Hi, Khai 👋 </h3>
            <div class="border_card">
                <div class="card_header">
                    <span>Hosting</span>
                    <i onclick="onActiveTourCard()" class="icon_show_hide_card fas fa-chevron-up"></i>
                </div>
                <div class="card_body active">
                    <div class="row">
                        <div class="col-auto">
                            <i class="fab fa-accusoft"></i>
                        </div>
                        <div class="col-9">
                            <span class="span-name-tour"> 360fairs.com </span>
                            <span>Expires on 2022-09-12</span>
                        </div>
                        <div class="col-auto" style="padding-left: 50px;">
                            <a href="{{env('APP_URL')}}/tour/1" class="btn btn-manage-tour"> Manage </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

