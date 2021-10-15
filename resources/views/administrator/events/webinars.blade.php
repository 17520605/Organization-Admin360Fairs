@extends('layouts.master')

@section('content')
    <div class="container-fluid card-event">
        <h1 class="h3 mb-4 text-gray-800">Events <button  class="btn btn-df" style="position: absolute; right: 1.5rem;" data-toggle="modal" data-target="#popup-create-webinar"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new event</button></h1>
        <div class="row">
            @foreach ($webinars as $webinar)
            <div class="col-lg-4">
                <div class="card card-margin">
                    <div class="card-header no-border">
                        <h5 class="card-title">MOM</h5>
                        <button class="btn btn-default btn-remove-event-card"><i class="far fa-times-circle"></i></button>
                    </div>
                    <div class="card-body pt-0">
                        <div class="widget-49">
                            <div class="widget-49-title-wrapper">
                                <div class="widget-49-date-primary">
                                    <span class="widget-49-date-day">{{Carbon\Carbon::parse($webinar->startAt)->format('m')}}</span>
                                    <span class="widget-49-date-month">{{Carbon\Carbon::parse($webinar->startAt)->format('M')}}</span>
                                </div>
                                <div class="widget-49-meeting-info">
                                    <span class="widget-49-pro-title">{{$webinar->topic}}</span>
                                    <span class="widget-49-meeting-time">{{Carbon\Carbon::parse($webinar->startAt)->format('h:m')}} to {{Carbon\Carbon::parse($webinar->endAt)->format('h:m')}}</span>
                                </div>
                            </div>
                            <ol class="widget-49-meeting-points">
                                @foreach ($webinar->details as $detail)
                                <li class="widget-49-meeting-item"><span>{{$detail->title}}</span></li>
                                @endforeach
                            </ol>
                            <div class="widget-49-meeting-action">
                                <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="btn btn-sm btn-flash-border-primary">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @include('components.add_event')
@endsection





