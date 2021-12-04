@extends('layouts.master')
@section('content')
    <div class="container-fluid tags-wrapper">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Webinars of Tour</h1>
                    <div class="div_cardheader_btn">
                        <button class="mb-0 btn float-right" onclick="location.href='/administrator/tours/{{$tour->id}}/events/webinars/create'"><i class="fas fa-plus"></i> Create New Webinar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-header mb-3 webinar-tab" style="width: 100%; height: 40px; mb-2 ">
            <span class="tab-header-btn btn btn-primary float-left active" data-tag="list" data-name="All Events"><i class="fas fa-stream"></i></span>
            <span class="tab-header-btn btn btn-primary float-left" data-tag="card" data-name="All Events"><i class="fas fa-clone"></i></span>
        </div>
        <div class="card shadow mb-4 tag-body" style="display: block" data-tag="list">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background: #eef2f7;">
                                <th style="text-align: center">#</th>
                                <th>Topic event</th>
                                <th>Requied by</th>
                                <th>Date Request</th>
                                <th>Status</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($webinars as $webinar)
                        <tr data-webinar-id="{{$webinar->id}}">
                            <td style="text-align: center">{{$number++}}</td>
                            <td><a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="font-weight-bold text-primary">{{$webinar->topic}}</a></td>
                            <td>{{$webinar->registrant != null ? $webinar->registrant->name : 'N/A'}}</td>
                            <td>{{$webinar->created_at}}</td>
                            <td>
                                @if($webinar->isConfirmed === null && $webinar->isWaitingApproval == false)
                                    Editting 
                                @elseif($webinar->isConfirmed == true && $webinar->isWaitingApproval == false)
                                    Approved
                                @elseif($webinar->isConfirmed == false && $webinar->isWaitingApproval == false)
                                    Rejected
                                @elseif($webinar->isWaitingApproval == true)
                                    Waiting for approval
                                @endif
                            </td>
                            <td>
                                <a href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="font-weight-bold text-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tag-body row card-event" style="display: none" data-tag="card">
            @foreach ($webinars as $webinar)
                @if ($webinar->isConfirmed === null || $webinar->isConfirmed === 0)
                    <div class="col-lg-4 webinar-item" data-webinar-id="{{$webinar->id}}">
                        <a class="card card-margin" href="/administrator/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}">
                            <div class="card-header no-border">
                                <h6 class="card-title text-primary" style="font-weight: 700">EVENT-{{$webinar->id}}</h6>
                                <button class="btn btn-default btn-remove-event-card" data-webinar-id="{{$webinar->id}}" onclick="onOpenPopupDeleteWebinar(this);"><i class="far fa-times-circle"></i></button>
                            </div>
                            <div class="card-body pt-0">
                                <div class="widget-49">
                                    <div class="widget-49-title-wrapper">
                                        <div class="widget-49-date-primary">
                                            <span class="widget-49-date-day">{{Carbon\Carbon::parse($webinar->startAt)->format('d')}}</span>
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
                                        Bị Từ Chối                      
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <script>
         $('.tab-header-btn').click(function(){
            let area = $(this).parents('.tags-wrapper');
            let tag = $(this).data('tag');
            let name = $(this).data('name');

            $('#page-title').text(name);

            area.find('.tab-header-btn').removeClass("active");
            $(this).addClass("active");

            area.find('.tag-body').hide();
            area.find('.tag-body[data-tag="'+tag+'"]').show();
        });
    </script>
@endsection





