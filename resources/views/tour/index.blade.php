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
                                    <img class=" mb-2" style="width: 100%;" src="https://gconnect.edu.vn/wp-content/uploads/2016/06/bg-slide-01.jpg" alt="">
                                    <div class="card-body">
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
