@extends('layouts.super')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top">
            <div style="position: relative; margin-bottom: 3%;">
                <h3>Hi, <span> {{$profile->name}}</span> 👋 </h3>
            </div>
            @foreach ($tours as $tour)
                <div class="row partner_card mb-3">
                    <div class="col-lg-12">
                        <div class="card card-margin">
                            <div class="card-body pt-4">
                                <div class="widget-49 speaker-49">
                                    <div class="widget-49-title-wrapper" style="padding-bottom: 20px;">
                                        <div class="widget-49-date-primary">
                                            <i class="fab fa-accusoft" style="font-size: 32px ;color: #4e73df"></i>
                                        </div>
                                        <div class="widget-49-meeting-info">
                                            <span style="font-weight: bold; font-size: 22px; color: #4e73df;cursor: pointer;">{{$tour->name}}</span>
                                            <li class="list-inline-item me-3" style="left: 0;">{{$tour->startTime != null ? Carbon\Carbon::parse($tour->startTime)->format('M-d-y g:i A') : 'N/A'}} - {{$tour->startTime != null ? Carbon\Carbon::parse($tour->endTime)->format('M-d-y g:i A') : 'N/A'}}</li>
                                        </div>
                                    </div>
                                    @foreach ($tour->booths as $booth)
                                        <div class="widget-49-meeting-action px-4 py-3 border-top mt-4" style="position: relative; ">
                                            <li class="list-inline-item me-3" style="position: absolute;left: 0;"><i class="fas fa-store" style="color: #5462fc; margin-right: 5px; "></i>{{$booth->name}}</li>
                                            <a class="btn btn-df btn-page-loader" href="{{env('APP_URL')}}/partner/booths/{{$booth->id}}" style="position: absolute; right: 0; top: 2rem;border-radius: 3px;"> Manager</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

