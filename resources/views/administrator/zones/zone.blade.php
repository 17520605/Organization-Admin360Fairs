
    @extends('layouts.master')

    @section('content')
        <div class="container-fluid" style="margin-bottom: 3rem;">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card p-3">
                        <h1 class="h4 text-gray-800" style="margin: 0px">{{ $zone->name }}</h1>
                        <a href="" class="btn btn-df" style="width: 180px; position: absolute ;top: 0.75rem; right: 1rem;"><i class="fas fa-cog"></i> Config Zone</a>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 1.5rem;">
                <div class="col-md-5">
                    <div class="card" style="height: 400px;">
                        <div class="card-body" style="color: #555; font-size: 14px;">
                            <div class="d-flex mb-2">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-15">New admin Design</h5>
                                    <p class="text-muted">It will be as simple as Occidental</p>
                                </div>
                            </div>
                            <h5 class="font-size-15 mt-4">Project Details :</h5>
                            <p class="text-muted">
                                To an English person, it will seem like simplified English, as a skeptical Cambridge friend
                                of mine told me what Occidental is. The European languages are members of the same family.
                                Their separate existence is a myth. For science, music, sport, etc,
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card" style="width: 100%; height: 400px;padding: 20px;">
                        <div id="viewer-container" style="width: 100%; height: 100%;"></div>
                        <div class="bg-config-overview">
                            <a href="https://360fairs.com/" target="_blank" class="btn-config-overview">
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
                            <h6 class="font-weight-bold text-primary float-left">Booths</h6>
                            <button class="btn float-right btn-df" data-toggle="modal" data-target="#popup-add-booth-to-zone"><i class="fas fa-plus"></i> Add Booth </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background: #eef2f7;">
                                            <th style="text-align: center ; width: 5%;">#</th>
                                            <th>Name</th>
                                            <th style="width: 25%;">Owner</th>
                                            <th style="width: 100px;"> Panoramas</th>
                                            <th style="width: 100px;">Objects</th>
                                            <th style="width: 135px;">Visit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $number = 1;
                                        @endphp
                                        @if (count($booths) == 0)
                                            <tr>
                                                <td colspan="8">
                                                    <center> <span>No booths in this zone</span></center> 
                                                </td>
                                            </tr>
                                        @else
                                            @php
                                                $order = 1;
                                            @endphp
                                            @foreach ($booths as $booth)
                                            <tr>
                                                <td>{{$order++}}</td>
                                                <td>{{ $booth->name }}</td>
                                                <td>
                                                    <a href="https://github.com/">Nguyen Ngoc Khai</a>
                                                </td>
                                                <td>3</td>
                                                <td>3</td>
                                                <td>  
                                                    <a href="/administrator/tours/{{$tour->id}}/booths/{{$booth->id}}" class="btn-visit-now btn-page-loader" >Visit now <i class="fas fa-chevron-right"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="popup-add-booth-to-zone" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="fw-light">Choose Booths for Zone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex flex-column" style="flex-grow: 1;">
                            <form action="/administrator/tours/{{$tour->id}}/zones/{{$zone->id}}/save-add-booths" method="POST">
                                @csrf
                                <input type="hidden" name="zoneId" value="{{$zone->id}}">
                                <div class="mb-3">
                                    <a class="link link-primary">List Booths</a>
                                </div>
                                <div class="mb-3 p-3 border booths-wrapper">
                                    @if (count($freeBooths) == 0)
                                    <center> <span m-3>No booths</span></center> 
                                    @endif
                                    @foreach ($freeBooths as $freeBooth)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="boothIds[]" value="{{$freeBooth->id}}" >
                                            <label class="form-check-label">
                                                {{$freeBooth->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-block btn-primary btn-icon-loader" type="submit"><span class="icon-loader-form"></span> Save Change</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function init() {
                var container = document.getElementById('viewer-container');
                var viewer = new PANOLENS.Viewer({
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

            function switchTag (tagName) {  
                $('.objects-wrapper').hide();     
                $('#'+tagName+'-wrapper').show();
            }

        </script>
        <script>
            $(document).ready(function() {
                init();
            });
        </script>

    @endsection
