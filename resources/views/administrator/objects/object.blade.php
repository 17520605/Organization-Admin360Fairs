@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">{{$object->name}}</h1>
                </div>
            </div>
        </div>
        @if ($object->type == 'image')
        {{-- IMAGE --}}
        <div class="row mb-3 image-wrapper" >
            <div class="col-md-4">
                <div class="card" style="height: 100%">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="font-size-15 font-weight-bold">General </h6>
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-muted mb-2"> Name:  </p>
                                    <p class="text-muted mb-2"> Source: </p>
                                    <p class="text-muted mb-2"> Dimensions: </p>
                                    <p class="text-muted mb-2"> Format: </p>
                                    <p class="text-muted mb-2"> size: </p>
                                    <p class="text-muted mb-2"> Update at: </p>
                                </div>
                                <div class="col-8">
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->name != null ? $object->name : 'N/A'}}</span> </p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->source != null ? $object->source : 'N/A'}}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ ($object->width != null && $object->width != 0) ? strval($object->width).'px' : 'N/A'}} x {{ ($object->height != null && $object->height != 0) ? strval($object->height).'px' : 'N/A'}}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->format != null ? $object->format : 'N/A'}}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->source != null ? strval(number_format(floatval($object->size) / 1048576, 1)).' MB' : 'N/A' }}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->updated_at != null ? $object->updated_at : 'N/A'}} </span></p>
                                </div>
                            </div>
                            <p class="font-size-15 font-weight-bold mt-3">Description : </p>
                            @if ($object->description != null)
                                <div class="text-muted discription_tour_text" style="max-height: 105px "> {{$object->description}} </div>
                            @else
                                <div class="text-muted" style="width: 100%; text-align: center ;">No description</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 view_booth_panoles">
                <div class="card" style="width: 100% ; padding:20px;">
                    <div style="width: 100%;">
                        <img src="{{$object->url}}" alt="" style="width: 100%">
                    </div>
                    <div class="bg-config-overview">
                        
                    </div>
                </div>
            </div>
        </div>
        @elseif ($object->type == 'video')
        {{-- VIDEO --}}
        <div class="row mb-3 video-wrapper" >
            <div class="col-md-4">
                <div class="card" style="max-height: 350px">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="font-size-15 font-weight-bold">General </h6>
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-muted mb-2"> Name:  </p>
                                    <p class="text-muted mb-2"> Source: </p>
                                    <p class="text-muted mb-2"> Duration: </p>
                                    <p class="text-muted mb-2"> Format: </p>
                                    <p class="text-muted mb-2"> size: </p>
                                    <p class="text-muted mb-2"> Update at: </p>
                                </div>
                                <div class="col-8">
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->name != null ? $object->name : 'N/A'}}</span> </p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->source != null ? $object->source : 'N/A'}}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->duration != null ? $object->duration : 'N/A'  }}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->format != null ? $object->format : 'N/A'}}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->source != null ? strval(number_format(floatval($object->size) / 1048576, 1)).' MB' : 'N/A' }}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->updated_at != null ? $object->updated_at : 'N/A'}} </span></p>
                                </div>
                            </div>
                            <p class="font-size-15 font-weight-bold mt-3">Description : </p>
                            @if ($object->description != null)
                                <div class="text-muted discription_tour_text" style="max-height: 105px "> {{$object->description}} </div>
                            @else
                                <div class="text-muted" style="width: 100%; text-align: center ;">No description</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 view_booth_panoles">
                <div class="card" style="width: 100% ; padding:20px;">
                    <div style="width: 100%;">
                        <video src="{{$object->url}}" alt="" controls style="width: 100%">
                    </div>
                    <div class="bg-config-overview">
                        
                    </div>
                </div>
            </div>
        </div>
        @elseif ($object->type == 'audio')
        {{-- AUDIO --}}
        <div class="row mb-3 audio-wrapper" >
            <div class="col-md-4">
                <div class="card" style="max-height: 350px">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="font-size-15 font-weight-bold">General </h6>
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-muted mb-2"> Name:  </p>
                                    <p class="text-muted mb-2"> Source: </p>
                                    <p class="text-muted mb-2"> Duration: </p>
                                    <p class="text-muted mb-2"> Format: </p>
                                    <p class="text-muted mb-2"> size: </p>
                                    <p class="text-muted mb-2"> Update at: </p>
                                </div>
                                <div class="col-8">
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->name != null ? $object->name : 'N/A'}}</span> </p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->source != null ? $object->source : 'N/A'}}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->duration != null ? $object->duration : 'N/A'  }}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->format != null ? $object->format : 'N/A'}}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->source != null ? strval(number_format(floatval($object->size) / 1048576, 1)).' MB' : 'N/A' }}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->updated_at != null ? $object->updated_at : 'N/A'}} </span></p>
                                </div>
                            </div>
                            <p class="font-size-15 font-weight-bold mt-3">Description : </p>
                            @if ($object->description != null)
                                <div class="text-muted discription_tour_text" style="max-height: 105px "> {{$object->description}} </div>
                            @else
                                <div class="text-muted" style="width: 100%; text-align: center ;">No description</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 view_booth_panoles">
                <div class="card" style="width: 100% ; padding:20px;">
                    <div style="width: 100%;">
                        <audio src="{{$object->url}}" alt="" controls style="width: 100%">
                    </div>
                    <div class="bg-config-overview">
                        
                    </div>
                </div>
            </div>
        </div>
        @elseif ($object->type == 'model')
        {{-- MODEL --}}
        <div class="row mb-3 model-wrapper" >
            <div class="col-md-4">
                <div class="card" style="max-height: 350px">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="font-size-15 font-weight-bold">General </h6>
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-muted mb-2"> Name:  </p>
                                    <p class="text-muted mb-2"> Source: </p>
                                    <p class="text-muted mb-2"> Duration: </p>
                                    <p class="text-muted mb-2"> Format: </p>
                                    <p class="text-muted mb-2"> size: </p>
                                    <p class="text-muted mb-2"> Update at: </p>
                                </div>
                                <div class="col-8">
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->name != null ? $object->name : 'N/A'}}</span> </p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->source != null ? $object->source : 'N/A'}}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->duration != null ? $object->duration : 'N/A'  }}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->format != null ? $object->format : 'N/A'}}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->source != null ? strval(number_format(floatval($object->size) / 1048576, 1)).' MB' : 'N/A' }}</span></p>
                                    <p class="text-muted mb-2"><span class="ml-2 font-weight-bold">{{ $object->updated_at != null ? $object->updated_at : 'N/A'}} </span></p>
                                </div>
                            </div>
                            <p class="font-size-15 font-weight-bold mt-3">Description : </p>
                            @if ($object->description != null)
                                <div class="text-muted discription_tour_text" style="max-height: 105px "> {{$object->description}} </div>
                            @else
                                <div class="text-muted" style="width: 100%; text-align: center ;">No description</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 view_booth_panoles">
                <div class="card" style="width: 100% ; height: 100%; padding:20px;">
                    <div style="width: 100%; height: 100%;">
                        <model-viewer style="width: 100%; height: 100%;" src="{{$object->url}}" shadow-intensity="1" camera-controls></model-viewer>
                    </div>
                    <div class="bg-config-overview">
                        
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4" style="max-height: 500px;">
                    <div class="card-header">
                        <span class="h5 font-weight-bold text-primary" style="margin: 0px">Views</span>
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
                                        <th style="width: 20%;">Email</th>
                                        <th style="width: 15%;">Contact</th>
                                        <th style="width: 180px;">Visit at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $number = 1;
                                    @endphp
                                    @if (count($views) == 0)
                                        <tr><td colspan="5"><center><span class="text-muted">No views</span></center></td></tr>
                                    @else
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
                                    @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body tag-wrapper tag-chart-wrapper" style="display: none; height: 100%; width:100%;">
                        <div id="view-chart-container" style="height: 100%; width:100%;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4" style="max-height: 500px;">
                    <div class="card-header">
                        <span class="h5 font-weight-bold text-primary" style="margin: 0px">Interest</span>
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
                                    @if (count($views) == 0)
                                        <tr><td colspan="6"><center><span  class="text-muted">No the interest</span></center></td></tr>
                                    @else
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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body" style="display: none; height: 100%; width:100%;">
                        <div id="interest-chart-container" style="height: 100%; width:100%;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Choose Object for Booths</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="border-radius:0 ;">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <div class="modal-body" style="flex: 0 1 0%;">
                            <nav class="nav_profile">
                                <a href="javascript:void(0)" class="active" id="switch-local-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline"><i class="fas fa-file-image"></i> Images</div>
                                </a>
                                <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline"><i class="fas fa-file-video"></i> Videos</div>
                                </a>
                                <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline"><i class="fas fa-file-audio"></i> Audios</div>
                                </a>
                                <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline"><i class="fas fa-file-prescription"></i> Modes</div>
                                </a>
                            </nav>
                            <div class="step-1">
                                <div class="row" style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                    <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file" style="border-radius:0 ;">
                                                <label class="image-checkbox">
                                                    <img class="img-responsive" src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" style="width: 100%;">
                                                    <input name="image[]" value="" type="checkbox">
                                                    <i class="fa fa-check hidden"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-2" style="display: none;">
                                <div class="row" style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                    <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file" style="border-radius:0 ;">
                                                <label class="image-checkbox">
                                                    <img class="img-responsive" src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" style="width: 100%;">
                                                    <input name="image[]" value="" type="checkbox">
                                                    <i class="fa fa-check hidden"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-3" style="display: none;">
                                <div class="row" style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                    <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file" style="border-radius:0 ;">
                                                <label class="image-checkbox">
                                                    <img class="img-responsive" src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" style="width: 100%;">
                                                    <input name="image[]" value="" type="checkbox">
                                                    <i class="fa fa-check hidden"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-4" style="display: none;">
                                <div class="row" style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                    <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file" style="border-radius:0 ;">
                                                <label class="image-checkbox">
                                                    <img class="img-responsive" src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" style="width: 100%;">
                                                    <input name="image[]" value="" type="checkbox">
                                                    <i class="fa fa-check hidden"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-df1" type="button" data-dismiss="modal">Save Change</button>
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
        ];


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
                        text: 'Date time'
                    },
                }
            };

            var chart = new ApexCharts(document.querySelector("#view-chart-container"), options);
            chart.render();
        }

    </script>
    <script>
        $(document).ready(function() {

            initViewChart();

            // $('.table').DataTable({
            //     "searching": false
            // });

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
@endsection
