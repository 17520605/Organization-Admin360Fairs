@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, <span>{{$profile->name}}</span> 👋 </h3>
            </div>
            <div class="row partner_card">
                @foreach ($tours as $tour)
                    <div class="col-lg-12">
                        <div class="card card-margin">
                            <div class="card-body pt-4">
                                <div class="widget-49 speaker-49">
                                    <div class="widget-49-title-wrapper" style="padding-bottom: 20px;">
                                        <div class="widget-49-date-primary">
                                            <span class="widget-49-date-day">{{Carbon\Carbon::parse($tour->startTime)->format('d')}}</span>
                                            <span class="widget-49-date-month">{{Carbon\Carbon::parse($tour->startTime)->format('M')}}</span>
                                        </div>
                                        <div class="widget-49-meeting-info">
                                            <span style="font-weight: bold; font-size: 20px; color: #5462fc;cursor: pointer;">{{$tour->name}}</span>
                                            <span class="widget-49-pro-title font-weight-bold"> {{$tour->organizer}}</span>
                                        </div>
                                    </div>
                                    <div class="widget-49-meeting-action px-4 py-3 border-top" style="position: relative;">
                                        <li class="list-inline-item me-3" style="position: absolute;left: 0;"><i class="fas fa-calendar-check" style="color: #5462fc; margin-right: 5px; "></i> Date Mangager : {{$tour->startTime != null ? Carbon\Carbon::parse($tour->startTime)->format('Y-m-d') : 'N/A'}}</li>
                                        <a class="btn btn-df btn-page-loader" href="{{env('APP_URL')}}/speaker/tours/{{$tour->id}}" style="position: absolute; right: 0; top: 2rem;border-radius: 3px;"> Manager</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

