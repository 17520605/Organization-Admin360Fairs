@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">{{$tour->name}}</h1>
                    <div class="div_cardheader_btn">
                        <button class="mb-0 btn float-right active btn-icon-loader"><span class="icon-loader-form"></span> <i class="fas fa-globe"></i> Publish </button>
                        <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-edit-tour"><i class="fas fa-pen"></i> Edit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-header mb-3 webinar-tab" style="width: 100%; height: 40px; mb-2 ">
            <span class="btn-tab-1 tab-header-btn btn btn-primary float-left active" ><i class="fas fa-stream"></i></span>
            <span class="btn-tab-2 tab-header-btn btn btn-primary float-left"><i class="fab fa-accusoft"></i></span>
        </div>
        <div class="div-tab-1">
            <div class="row" style="margin-bottom: 1.5rem;">
                <div class="col-md-5" style="height: 60vh;">
                    <div class="card" style="height: 48vh;">
                        <div class="card-body" style="color: #555; font-size: 14px;">
                            <div class="d-flex process-overview">
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="row" style="margin-bottom: 0.5rem">
                                        <div class="col-lg-2">
                                            <span style="color: #555;font-weight: 600 ;" >Zones : </span> 
                                        </div>
                                        <div class="col-lg-9">
                                            <span>
                                                <div id="progress-striped progress-xs" class="progress progress-striped mb-0">
                                                    <div class="progress-bar progress-bar-warning" data-transitiongoal="43" aria-valuenow="43" style="width: 43%;">43%</div>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 1rem">
                                        <div class="col-lg-2">
                                            <span style="color: #555;font-weight: 600 ;" >Booths :</span> 
                                        </div>
                                        <div class="col-lg-9">
                                            <span>
                                                <div id="progress-striped progress-xs" class="progress progress-striped mb-0">
                                                    <div class="progress-bar progress-bar-warning" data-transitiongoal="43" aria-valuenow="43" style="width: 43%;">43%</div>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="font-size-15 font-weight-bold">General information: </h6>
                            <div class="d-flex">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-building mr-3"></i></span> <span> {{$profile->name != null ? $profile->name : "N/A" }} </span></p>
                                    <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-map-marker-alt mr-3"></i></span> <span>{{$tour->location != null ? $tour->location : "N/A" }}</span></p>
                                </div>
                            </div>
                            <h6 class="font-size-15 font-weight-bold">Description: </h6>
                            <div class="text-muted discription_tour_text" style="max-height: 10rem">
                                {{$tour->description != null ? $tour->description : 'N/A'}}
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2vh; height: 10vh;">
                        <div class="row">
                            <div class="col-5" style="margin-left: 20px;margin-top: 10px;">
                                <span style="font-size:12px">Start at</span>
                                <h6 style="font-size:15px"><i class="fas fa-calendar-alt mr-3" style="color: #4348dfb0;"></i><span>{{$tour->endTime != null ? Carbon\Carbon::parse($tour->startTime)->format('M-d  h:m') : 'N/A'}}</span></h6>
                            </div>
                            <div class="col-5" style="margin-left: 20px;margin-top: 10px;">
                                <span style="font-size:12px">End at</span>
                                <h6 style="font-size:15px"><i class="fas fa-calendar-alt mr-3" style="color: #4348dfb0;"></i><span>{{$tour->endTime != null ? Carbon\Carbon::parse($tour->endTime)->format('M-d  h:m') : 'N/A'}}</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7" style="position: relative; height: 60vh;">
                    <div class="card" style="width: 100%; height: 100%; padding:20px;">
                        <div id="viewer-container" style="width: 100%; height: 100%;">
                        </div>
                        <div class="bg-config-overview">
                            <a href="https://360fairs.com/" class="btn-config-overview btn-page-loader">
                                <i class="fas fa-cog"></i>
                                <span>Config</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Zones</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background: #eef2f7;">
                                            <th style="width: 5%;text-align: center">#</th>
                                            <th style="width: 20%">Name</th>
                                            <th style="width: 15%">Number of Booths</th>
                                            <th>List Booths</th>
                                            <th style="width: 135px;">Visit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $number = 1;
                                        @endphp
                                        @foreach ($zones as $zone)
                                        <tr>
                                            <td style="text-align: center">{{$number++}}</td>
                                            <td><a class="btn-page-loader" href="/administrator/tours/{{$tour->id}}/zones/{{$zone->id}}">{{$zone->name}}</a></td>
                                            <td>{{ count($zone->booths)}} </td>
                                            <td>
                                                @foreach ($zone->booths as $booth)
                                                    <a class="btn-page-loader" href="/administrator/tours/{{$tour->id}}/booths/{{$booth->id}}">{{$booth->name}}</a> , 
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="/administrator/tours/{{$tour->id}}/zones/{{$zone->id}}" class="btn-visit-now btn-page-loader" >Visit now <i class="fas fa-chevron-right"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="div-tab-2" style="display: none">
            <div class="row tags-area">
                <div class="col-md-12">
                    <div class="card mb-4" style="max-height: 500px;">
                        <div class="card-header">
                            <span class="h6 font-weight-bold text-primary" style="margin: 0px">Views</span>
                            <div class="div_cardheader_btn">
                                <span class="mb-0 btn float-right"><i class="fas fa-eye"></i> {{ count($views)}} </span>
                                <span class="mb-0 btn float-right tootbar-chart-btn"><i class="fas fa-chart-line"></i></span>
                                <span class="mb-0 btn float-right tootbar-table-btn"><i class="fas fa-list-ul"></i> </span>
                            </div>
                        </div>
                        <div class="card-body tag-wrapper tag-table-wrapper">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="views-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background: #eef2f7;">
                                            <th style="text-align: center;width: 5%;">#</th>
                                            <th >Name</th>
                                            <th style="width: 25%;">Email</th>
                                            <th style="width: 20%;">Contact</th>
                                            <th style="width: 180px;">Visit at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $number = 1;
                                        @endphp
                                        @foreach ($views as $view)
                                        <tr class="zone-1">
                                            <td style="text-align: center">{{$number++}}</td>
                                            @if ($view->visitor != null)
                                            <td>{{$view->visitor->name}}</td>
                                            <td>{{$view->visitor->email}}</td>
                                            <td>{{$view->visitor->contact}}</td>
                                            @else
                                            <td>Anonymous</td>
                                            <td>N/A</td>
                                            <td>N/A</td>
                                            @endif
                                            <td>{{$view->visitAt}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body tag-wrapper tag-chart-wrapper" style="display: none; height: 100%; width:100%;">
                            <div id="view-chart-container" style="height: 100%; width:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4" style="max-height: 500px;">
                        <div class="card-header">
                            <span class="h6 font-weight-bold text-primary" style="margin: 0px">Interest</span>
                            <div class="div_cardheader_btn">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="interest-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background: #eef2f7;">
                                            <th style="text-align: center;width: 5%;">#</th>
                                            <th style="width: 20%;">Name</th>
                                            <th style="width: 20%;">Email</th>
                                            <th style="width: 12%;">Contact</th>
                                            <th style="width: 170px;">Interest at</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $number = 1;
                                        @endphp
                                        @foreach ($interests as $interest)
                                        <tr class="zone-1">
                                            <td style="text-align: center">{{$number++}}</td>
                                            <td>{{$interest->visitor->name}}</td>
                                            <td>{{$interest->visitor->email}}</td>
                                            <td>{{$interest->visitor->contact}}</td>
                                            <td>{{$interest->datetime}}</td>
                                            <td>{{$interest->message}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body" style="display: none; height: 100%; width:100%;">
                            <div id="interest-chart-container" style="height: 100%; width:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- POPUP EDIT TOUR --}}
    <div class="modal fade" id="popup-edit-tour" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light"> Edit Tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="/administrator/tours/{{$tour->id}}/tour/save-edit" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small mb-1">Tour Name</label>
                        <input class="form-control" name="name" type="text" value="{{$tour->name}}" placeholder="Enter tour name" />
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Start at</label>
                            <input class="form-control" name="start" value="{{ Carbon\Carbon::parse($tour->startTime)->format('Y-m-d\TH:i')}}" type="datetime-local" />
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">End at</label>
                            <input class="form-control" name="end" value="{{ Carbon\Carbon::parse($tour->startTime)->format('Y-m-d\TH:i')}}" type="datetime-local" />
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                            <label class="small mb-1">Location</label>
                            <input class="form-control" name="location" value="{{$tour->location}}" type="text" placeholder="Enter your location" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1">Tour Description</label>
                        <textarea name="description" placeholder="Enter your tour description" class="form-control" rows="6"> {{$tour->description}} </textarea>
                    </div>
                    <!-- Form Group (create account submit)-->
                    <button type="submit" class="btn btn-primary btn-block btn-icon-loader">  <span class="icon-loader-form"></span> Update Edit Tour</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var viewer;
    var container = document.getElementById('viewer-container');
    var views = [
        @for($i = 0; $i < count($views); $i++)
            @if ($views[$i]->visitor != null)
            {   
                id: '{{$views[$i]->id}}' ,
                name: '{{$views[$i]->visitor->name}}',
                email: '{{$views[$i]->visitor->email}}',
                contact: '{{$views[$i]->visitor->contact}}',
                visitAt: '{{$views[$i]->visitAt}}'
            }
            @else
            {   
                id: '{{$views[$i]->id}}',
                name: 'Anonymous',
                email: 'N/A',
                contact: 'N/A',
                visitAt: '{{$views[$i]->visitAt}}'
            }
            @endif
            @if ($i < count($views) - 1 ) , @endif
        @endfor
    ]

</script>
<script>
    function init() {
        viewer = new PANOLENS.Viewer({
            container: container,
            autoRotate: true,
            autoRotateSpeed: 1.0,
        });
        viewer.OrbitControls.noZoom = true;

        @if ($overview != null)
            let imagePanorama = new PANOLENS.ImagePanorama('{{ $overview->imageUrl }}');
            viewer.add(imagePanorama);
        @endif
    }

    function initViewChart() {      
        let data = [];
        let count = 0;
        views.forEach(view => {
            count ++;
            data.push({
                x: new Date(view.visitAt).getTime(),
                y: count
            })
        });

        var options = {
            series:[{
                name: 'view',
                data: data
            }],
            chart: {
                height: 400,
                type: 'line',
                zoom: {
                    type: 'x',
                    enabled: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                    return (val / 1).toFixed(0);
                    },
                },
                title: {
                    text: 'View count'
                },
            },
            xaxis: {
                type: 'datetime',
                title: {
                    text: 'Datetime'
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#view-chart-container"), options);
        chart.render();
    }
</script>
<script>
    $(document).ready(function() {
        init();
        initViewChart();

        $('.tootbar-chart-btn').click(function (e) { 
            $(this).parents('.tags-area').find('.tag-wrapper').hide();
            $(this).parents('.tags-area').find('.tag-chart-wrapper').show();
        });

        $('.tootbar-table-btn').click(function (e) { 
            $(this).parents('.tags-area').find('.tag-wrapper').hide();
            $(this).parents('.tags-area').find('.tag-table-wrapper').show();
        });
        
    });
</script>

<script>
    $('.btn-tab-1').click(function(){
        $('.div-tab-1').show();
        $('.div-tab-2').hide();
        $('.btn-tab-1').addClass('active');
        $('.btn-tab-2').removeClass('active');
    });
    $('.btn-tab-2').click(function(){
        $('.div-tab-2').show();
        $('.div-tab-1').hide();
        $('.btn-tab-1').removeClass('active');
        $('.btn-tab-2').addClass('active');
    });
</script>
@endsection
