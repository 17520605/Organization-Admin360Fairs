@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">
                <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Webinars</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background: #eef2f7;">
                                <th style="text-align: center">#</th>
                                <th>Topic</th>
                                <th>Requied by</th>
                                <th>Request at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($webinars as $webinar)
                        <tr data-webinar-id="{{$webinar->id}}">
                            <td style="text-align: center">{{$number++}}</td>
                            <td><a href="/speaker/tours/{{$tour->id}}/events/webinars/{{$webinar->id}}" class="font-weight-bold text-primary btn-page-loader">{{$webinar->topic}}</a></td>
                            <td>{{$webinar->registrant != null ? $webinar->registrant->name : 'N/A'}}</td>
                            <td>{{$webinar->updated_at}}</td>
                            <td><a href="/administrator/tours/1/events/webinars/{{$webinar->id}}" class="btn-visit-now btn-page-loader">View Details</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Booths</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background: #eef2f7;">
                                <th style="text-align: center">#</th>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Request at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($booths as $booth)
                        <tr>
                            <td style="text-align: center">{{$number++}}</td>
                            <td><a href="/partner/tours/{{$tour->id}}/booths/{{$booth->id}}" class="font-weight-bold text-primary btn-page-loader">{{$booth->name}}</a></td>
                            <td>{{$booth->owner != null ? $booth->owner->name : 'Host'}}</td>
                            <td>{{$booth->updated_at}}</td>
                            <td><a href="/administrator/tours/1/booths/{{$booth->id}}" class="btn-visit-now btn-page-loader">View Details</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-bottom')
    <script>
        $('.table').DataTable();
        let count = {{count($webinars) + count($booths)}};
        if(count > 0){
            $('#navbar-left__request-count').text(count)
            $('#navbar-left__request-count').show();
        }
        else{
            $('#navbar-left__request-count').hide();
        }
        
    </script>
@endsection





