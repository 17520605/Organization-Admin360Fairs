@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, <span>{{$profile->name}}</span> 👋 </h3>
            </div>
            <div class="border_card">
                <div class="card_header">
                    <span>Tours</span>
                    <i onclick="onActiveTourCard()" class="icon_show_hide_card fas fa-chevron-up"></i>
                </div>
               <div class="row partner_card">
                    <div class="col-lg-12">
                        <div class="card card-margin">
                            <div class="card-body pt-4">
                                <div class="widget-49">
                                    <div class="widget-49-title-wrapper" style="padding-bottom: 20px;">
                                        <div class="widget-49-date-primary">
                                            <span class="widget-49-date-day">09</span>
                                            <span class="widget-49-date-month">apr</span>
                                        </div>
                                        <div class="widget-49-meeting-info">
                                            <span style="font-weight: bold; font-size: 20px; color: #5462fc;cursor: pointer;">CTTNHH ABC</span>
                                            <span class="widget-49-pro-title font-weight-bold">PRO-08235 DeskOpe. Website</span>
                                        </div>
                                    </div>
                                    <div class="widget-49-meeting-action px-4 py-3 border-top" style="position: relative;">
                                        <li class="list-inline-item me-3" style="position: absolute;left: 0;"><i class="fas fa-calendar-check" style="color: #5462fc; margin-right: 5px; "></i> Date Mangager : 2019-10-15 - 14:00</li>
                                        <a class="btn btn-df" style="position: absolute; right: 0; top: 0.5rem;border-radius: 3px;"> Manager</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

