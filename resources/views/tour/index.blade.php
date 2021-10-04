@extends('layouts.master')

@section('content')
    <div class="container-fluid booths-card">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-start-lg border-start-primary">
                        <div class="card-body">
                            <div class="small text-muted">Current monthly bill</div>
                            <div class="h3">$20.00</div>
                            <a class="text-arrow-icon small" href="#!">
                                Switch to yearly billing
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-start-lg border-start-secondary">
                        <div class="card-body">
                            <div class="small text-muted">Next payment due</div>
                            <div class="h3">July 15</div>
                            <a class="text-arrow-icon small text-secondary" href="#!">
                                View payment history
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-start-lg border-start-success">
                        <div class="card-body">
                            <div class="small text-muted">Current plan</div>
                            <div class="h3 d-flex align-items-center">Freelancer</div>
                            <a class="text-arrow-icon small text-success" href="#!">
                                Upgrade plan
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="card card-header-actions mb-4">
                <div class="card-header">
                    Tour View     
                    <div style="float: right">
                        <div class="btn-toolbar" >
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <a href="/tours/{{$tour->id}}/tour/edit"><button class="btn btn-light">Edit </button></a> 
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <a><button class="btn btn-light"> Tool Config </button></a> 
                            </div>
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <a><button class="btn btn-primary"> Publish </button></a> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="mb-4 mb-xl-0">
                                <div class="card-body">
                                    @if ($tour->image != null)
                                        <img class="card-img-top" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="{{$tour->image}}" data-holder-rendered="true">
                                    @else
                                        <img class="card-img-top" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17c4158f272%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17c4158f272%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                    @endif
                                    <div class="card-body" style=" padding: 1.25em 0; ">
                                        <strong><i class="fas fa-building mr-1"></i> Organization</strong>
                                        <p class="text-muted">
                                            Company UIT
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                        <p class="text-muted">{{$tour->location}}</p>
                                        <hr>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block"><b>Share</b></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="mb-4">
                                <div class="card-body">
                                    <h3 class="mt-0" style="color: #35373b;">
                                        {{$tour->name}}
                                    </h3>
                                    <div class="row" style="margin-top: 25px;">
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <h5 style="color: #35373b;">Start Date</h5>
                                                <p>{{$tour->end_at != null ? Carbon\Carbon::parse($tour->start_at)->format('Y-m-d') : 'N/A'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <h5 style="color: #35373b;">End Date</h5>
                                                <p>{{$tour->end_at != null ? Carbon\Carbon::parse($tour->end_at)->format('Y-m-d') : 'N/A'}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 style="color: #35373b;">Description</h5>
                                    <p class="text-muted mb-2">
                                        {{$tour->description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
