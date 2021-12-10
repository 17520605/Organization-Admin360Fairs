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
        <div class="tab-header mb-3 webinar-tab" style="width: 100%; height: 40px; mb-2 ">
            <span class="btn-tab-1 tab-header-btn btn btn-primary float-left active" ><i class="fas fa-stream"></i></span>
            <span class="btn-tab-2 tab-header-btn btn btn-primary float-left"><i class="far fa-dot-circle"></i></span>
        </div>
        <div class="div-tab-1">
            <div class="row" style="margin-bottom: 1.5rem;">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body" style="color: #555; font-size: 14px;">
                            <div class="d-flex mb-2">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-15">New admin Design</h5>
                                    <p class="text-muted">It will be as simple as Occidental</p>
                                </div>
                            </div>
                            <h5 class="font-size-15 mt-4">Project Details :</h5>
                            <p class="text-muted" style="height: 145px">
                                To an English person, it will seem like simplified English, as a skeptical Cambridge friend
                                of mine told me what Occidental is. The European languages are members of the same family.
                                Their separate existence is a myth. For science, music, sport, etc,
                            </p>
                        </div>
                    </div>
                    <div class="card mt-3" style="width: 100%; height: 105px; padding:8px;">
                        <div id="container">
                            <div class="tour__bottom-bar-slider-outer" id="booth-track">
                                <div class="tour__bottom-bar-slider" style="width: 100%; position: relative;">
                                    {{-- <i class="fas fa-angle-left" id="left-button-scroll"></i> --}}
                                    <div id="slider-track" class="tour__bottom-bar-slider-track" style="height: 100%; display: flex;">
                                        <div style="width: 3%;line-height: 85px;text-align: left"><i class="fas fa-chevron-circle-left icon_scroll_track_img" style="color:#dc3545;opacity: 0.6;" onclick="scroll_left_i();"></i></div>
                                        <div style="width: 94%; overflow-x: hidden;display: flex;" id="container_track_img">
                                            @if (count($panoramas) == 0)
                                                 <div style="width: 100%; text-align: center;line-height: 83px;font-weight: 600"><span>No panoramas</span></div>
                                            @endif
                                            @foreach ($panoramas as $panorama)
                                            <div class="slide_track panorama-item panorama-slide-item" data-panorama-id="{{$panorama->id}}" style="margin: 0 5px">
                                                <div style="width: 135px; height: 90px;">
                                                    <img src="{{$panorama->imageUrl}}" onclick="onGoToPanorama(this)" class="slide_track__image panorama-thumbnail__image">
                                                    <span class="span-booth-name" style="font-weight: 600">{{$panorama->name}}</span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div style="width: 3%;line-height: 85px;text-align: right"><i class="fas fa-chevron-circle-right icon_scroll_track_img" onclick="scroll_right_i();"></i></div>
                                    </div>
                                    {{-- <i class="fas fa-angle-right" id="right-button-scroll"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 view_booth_panoles">
                    <div class="card" style="width: 100% ;height: 450px; padding:20px;">
                        <div id="viewer-container" style="width: 100%; height: 100%;">
                        </div>
                        <div class="bg-config-overview">
                            <a href="https://360fairs.com/" class="btn-config-overview ">
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
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background: #eef2f7;">
                                            <th style="text-align: center ; width: 5%;">#</th>
                                            <th>Name</th>
                                            <th style="width: 25%;">Owner</th>
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
                                                <td> <a href="/administrator/tours/{{$tour->id}}/booths/{{$booth->id}}">{{ $booth->name }}</a></td>
                                                <td>
                                                    <a>{{$booth->owner != null ? $booth->owner->name : 'N/A'}}</a>
                                                </td>
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
        <div class="div-tab-2" style="display: none">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <span class="h6 font-weight-bold text-primary" style="margin: 0px">Objects</span>
                            <div class="div_cardheader_btn">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="comment-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background: #eef2f7;">
                                            <th style="text-align: center; width: 5%;">#</th>
                                            <th style="width: 50%;">Name</th>
                                            <th >Views</th>
                                            <th >Likes</th>
                                            <th>Comments</th>
                                            <th style="width: 10%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($objects as $object)
                                        <tr>
                                            <td style="text-align: center">
                                                @if ($object->type == 'image')
                                                   <span><i class="fas fa-image font-size-16 text-success"></i> <span style="display: none">1</span> </span> 
                                                @elseif($object->type == 'video')
                                                    <span><i class="far fa-play-circle font-size-16 text-danger"></i> <span style="display: none">2</span> </span> 
                                                @elseif($object->type == 'audio')
                                                    <span><i class="fas fa-music font-size-16 text-info"></i><span style="display: none">3</span></span> 
                                                @elseif($object->type == 'model')
                                                    <span><i class="fab fa-unity font-size-16 text-models"></i><span style="display: none">4</span></span> 
                                                @else 
                                                    <span><i class="fab fa-question-circle font-size-16 text-primary"></i><span style="display: none">5</span></span>
                                                @endif
                                            </td>    
                                            <td><span>{{$object->name}}</span></td>
                                            <td><span>{{$object->viewCount}}</span></td>
                                            <td><span> {{$object->likeCount}}</span></td>
                                            <td><span>{{$object->commentCount}}</span></td>
                                            <td class="actions"> <button class="btn-visit-now" onclick="openPopupObjectDetail({{$object->id}})">View Detail</button> </td>
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
        var container, viewer ;
        
        function initViewer() {
            container = document.getElementById('viewer-container');
            viewer = new PANOLENS.Viewer({
                container: container,
                autoRotate: true,
                autoRotateSpeed: 1.0,
            });
            viewer.OrbitControls.noZoom = true;
            @if ($scene != null && $scene->defaultPanoramaId != null)
                let imagePanorama = new PANOLENS.ImagePanorama("{{$panoramas->where('id', $scene->defaultPanoramaId)->first()->imageUrl}}");
                viewer.add(imagePanorama);
            @endif
        };
        function switchTag (tagName) {  
            $('.objects-wrapper').hide();     
            $('#'+tagName+'-wrapper').show();
        };
        function onGoToPanorama(target) {  
            debugger;
            let imageUrl = $(target).attr('src');
            viewer.destroy();
            container.innerHTML = "";
            viewer = new PANOLENS.Viewer({
                container: container,
                autoRotate: true,
                autoRotateSpeed: 1.0,
            });
            viewer.OrbitControls.noZoom = true;
            let imagePanorama = new PANOLENS.ImagePanorama(imageUrl);
            viewer.add(imagePanorama);
        }
    
    </script>
    <script>
        $(document).ready(function() {
            initViewer();
        });
        
        $('.btn-tab-1').click(function(){
            $('.div-tab-1').show();
            $('.div-tab-2').hide();
            $('.btn-tab-1').addClass('active');
            $('.btn-tab-2').removeClass('active');
        });
        $('.btn-tab-2').click(function(){
            $('.div-tab-2').show();
            $('.div-tab-1').hide();
            $('.btn-tab-2').addClass('active');
            $('.btn-tab-1').removeClass('active');
        });

    </script>

@endsection