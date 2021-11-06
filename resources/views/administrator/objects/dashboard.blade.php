@extends('layouts.master')

@section('content')
     <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="container-fluid manager_object">
            <div class="row">
                <div class="col-md-12" style="padding: 0;">
                    <div class="card p-3">
                        <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">File Manager</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="filemanager-sidebar col-md-3 card" style="padding: 0">
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="font-size-15 mb-4">Storage</h5>
                            <p class="text-muted mt-4">48.02 GB (76%) of 64 GB used</p>
                        </div>
                        <div class="mt-4">
                            <div class="border shadow-none mb-2 card total_bar_object" style="padding: 0.5rem; ">
                                <a class="text-body" href="#">
                                    <div class="body">
                                        <h4>1TB <i class="fa fa-server float-right"></i></h4>
                                        <p class="mb-0">Storage <small class="text-muted float-right">of 1Tb</small></p>
                                        <div class="progress progress-striped" style="width: 100%; padding: 0; height: 20px;background: #bbbbbb77;">
                                            <div class="progress-bar progress-bar-warning" data-transitiongoal="43" aria-valuenow="43" style="width: 43%;">43%</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="border shadow-none mb-2 card">
                                <a class="text-body" href="/administrator/tours/{{$tour->id}}/objects/images">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-success font-size-20"><i class="fas fa-image"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Images</h5>
                                                <p class="text-muted text-truncate mb-0">176 Files</p>
                                            </div>
                                            <div class="ml-2">
                                                <p class="text-muted">6 GB</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                    <div class="progress-bar bg-success" data-transitiongoal="18" aria-valuenow="18" style="width: 28%;"></div>
                                </div>
                            </div>
                            <div class="card border shadow-none mb-2">
                                <a class="text-body" href="/administrator/tours/{{$tour->id}}/objects/videos">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-danger font-size-20"><i class="far fa-play-circle"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Video</h5>
                                                <p class="text-muted text-truncate mb-0">45 Files</p>
                                            </div>
                                            <div class="ml-2">
                                                <p class="text-muted">4.1 GB</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                    <div class="progress-bar bg-danger" data-transitiongoal="18" aria-valuenow="18" style="width: 18%;"></div>
                                </div>
                            </div>
                            <div class="card border shadow-none mb-2">
                                <a class="text-body" href="/administrator/tours/{{$tour->id}}/objects/audios">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-info font-size-20"><i class="fas fa-music"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Music</h5>
                                                <p class="text-muted text-truncate mb-0">21 Files</p>
                                            </div>
                                            <div class="ml-2">
                                                <p class="text-muted">3.2 GB</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                    <div class="progress-bar bg-info" data-transitiongoal="18" aria-valuenow="18" style="width: 18%;"></div>
                                </div>
                            </div>
                            <div class="card border shadow-none mb-2">
                                <a class="text-body" href="/administrator/tours/{{$tour->id}}/objects/models">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-models font-size-20"><i class="fab fa-unity"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Model</h5>
                                                <p class="text-muted text-truncate mb-0">21 Files</p>
                                            </div>
                                            <div class="ml-2">
                                                <p class="text-muted">2 GB</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                    <div class="progress-bar bg-model1" data-transitiongoal="18" aria-valuenow="18" style="width: 18%;"></div>
                                </div>
                            </div>
                            <div class="card border shadow-none mb-2">
                                <a class="text-body" href="#">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-primary font-size-20"><i class="fas fa-file-alt"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Documents</h5>
                                                <p class="text-muted text-truncate mb-0">21 Files</p>
                                            </div>
                                            <div class="ml-2">
                                                <p class="text-muted">2 GB</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                    <div class="progress-bar bg-primary" data-transitiongoal="18" aria-valuenow="18" style="width: 18%;"></div>
                                </div>
                            </div>
                            <div class="card border shadow-none">
                                <a class="text-body" href="#">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-warning font-size-20"><i class="fas fa-folder"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-size-13 text-truncate mb-1">Others</h5>
                                                <p class="text-muted text-truncate mb-0">20 Files</p>
                                            </div>
                                            <div class="ml-2">
                                                <p class="text-muted ">1.4 GB</p>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                                <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                    <div class="progress-bar bg-warning" data-transitiongoal="18" aria-valuenow="18" style="width: 5%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" style="padding: 0;padding-left: 1rem;">
                    <div class="d-md-flex">
                        <div class="w-100">
                            <div class="card" style="">
                                <div id='myDiv'>
                                    <!-- Plotly chart will be drawn inside this DIV -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="padding-left: 0.5rem; padding-right: 0.5rem;">
                        <div class="mt-4">
                            <div class="d-flex flex-wrap">
                                <h1 class="h6 font-weight-bold text-primary" style="margin: 0px"><i class="fab fa-cloudscale"></i> Recent  File</h1>
                            </div>
                            <hr class="mt-3" />
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="width: 25%;">Name</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Size</th>
                                            <th scope="col" style="width:25%">Date modified</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($objects as $object)
                                        <tr>
                                            <td style="width: 5%; text-align: center">
                                                @if ($object->type == 'image')
                                                    <i class="fas fa-image font-size-16 text-success"></i>
                                                @elseif($object->type == 'video')
                                                    <i class="far fa-play-circle font-size-16 text-danger"></i>
                                                @elseif($object->type == 'audio')
                                                    <i class="fas fa-music font-size-16 text-info"></i>
                                                @elseif($object->type == 'model')
                                                    <i class="fab fa-unity font-size-16 text-models"></i>
                                                @else 
                                                    @if ($object->format == 'pdf')
                                                        <i class="fas fa-file-pdf font-size-16 text-danger"></i>
                                                    @elseif ($object->format == 'doc' || $object->format == 'docx')
                                                        <i class="fas fa-file-word font-size-16 text-primary" ></i>
                                                    @elseif ($object->format == 'xlsx' || $object->format == 'xlsm' || $object->format == 'csv')
                                                        <i class="fas fa-file-csv font-size-16 text-success"></i>
                                                    @elseif ($object->format == 'txt' || $object->format == 'html' || $object->format == 'php')
                                                        <i class="fas fa-file-alt font-size-16 text-primary"></i>
                                                    @else
                                                        <i class="fas fa-file font-size-16 text-warning"></i>
                                                    @endif
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                @if ($object->type == 'image')
                                                    <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                @elseif($object->type == 'video')
                                                    <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                @elseif($object->type == 'audio')
                                                    <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                @elseif($object->type == 'model')
                                                    <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                @else 
                                                    <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                @endif
                                            </td>
                                            <td>{{$object->format != null ? $object->format : 'N/A'}}</td>
                                            <td>{{$object->size != null ? strval(number_format(floatval($object->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                            <td>{{$object->updated_at}}</td>
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
    </div>
    <script src='https://cdn.plot.ly/plotly-latest.min.js'></script>
    <script>
        var trace1 = {
            x: [1, 2, 3, 4, 5, 6, 7],
            y: [40, 50, 60, 20, -10, 20],
            name: 'yaxis data',
            type: 'scatter'
        };

        var trace2 = {
            x: [1, 2, 3, 4, 5, 6, 7],
            y: [10, 30, 50, 30, 60, 10],
            name: 'yaxis2 data',
            type: 'scatter'
        };

        var trace3 = {
            x: [1, 2, 3, 4, 5, 6, 7],
            y: [40, 10, 30, 30, 50, 70],
            name: 'yaxis2 data',
            type: 'scatter'
        };
        var trace4 = {
            x: [1, 2, 3, 4, 5, 6, 7],
            y: [4, 30, 15, 50, 6, 50],
            name: 'yaxis2 data',
            type: 'scatter'
        };
        var data = [trace1, trace2, trace3, trace4];

        var layout = {
            title: 'Chart Object File Upload',
            font: {
                size: 14
            },
            yaxis: {
                title: 'GB'
            },
            yaxis2: {
                title: 'yaxis2 title',
                titlefont: {
                    color: 'rgb(148, 103, 189)'
                },
                tickfont: {
                    color: 'rgb(148, 103, 189)'
                },
                overlaying: 'y',
                side: 'right'
            }
        };

        var config = {
            responsive: true
        }


        Plotly.newPlot('myDiv', data, layout, config);
    </script>
@endsection
