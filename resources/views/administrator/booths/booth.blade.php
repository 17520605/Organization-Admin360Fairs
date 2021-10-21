@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">{{$booth->name}}</h1>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-5">
                <div class="card" style="height: 270px">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="font-size-15 font-weight-bold">General information : </h6>
                            <p class="text-muted mb-2"><i class="fas fa-building"></i> <a  class="ml-2 font-weight-bold" > <ins style="text-decoration: none"> {{$booth->owner->name != null ? $booth->owner->name : "N/A"}} </ins></a></p>
                            <p class="text-muted mb-2"><i class="fas fa-envelope"></i> <span class="ml-2"> {{$booth->owner->email != null ? $booth->owner->email : "N/A"}} </span></p>
                            <p class="text-muted mb-2"><i class="fas fa-phone-alt"></i> <span class="ml-2"> {{$booth->owner->contact != null ? $booth->owner->contact : "N/A"}}</span></p>
                            <p class="font-size-15 font-weight-bold">Description : </p>
                            @if ($booth->description != null)
                                <div class="text-muted discription_tour_text" style="max-height: 105px ">{{$booth->description}} </div>
                            @else
                                <div class="text-muted" style="width: 100%; text-align: center ;">No description</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="upload-box" style="display: {{$booth->logo == null ? 'block' : 'none'}}; max-height: 200px; height: 200px">
                        <div class="upload-text text-center">
                            <div class="upload-form border-dashed" style="height: 165px;">
                                <div class="m-4"> No Logo
                                    {{-- <button type="button" id="upload-logo-btn" class="btn btn-outline-primary"> <i class="fas fa-upload " style="margin-right: 8px; "></i>
                                        Upload Logo
                                    </button>
                                    <input type="file" id="upload-logo-file-input" style="display: none" accept="image/*"> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="preview-box" style="display: {{$booth->logo == null ? 'none' : 'block'}}; max-height: 200px; height: 200px; padding:1rem;">
                        <div class="upload-text text-center">
                            <img id="preview-logo-img" src="{{$booth->logo}}" style="height: 100%; width:100%"  alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 view_booth_panoles">
                <div class="card" style="width: 100% ;height: 75%; padding:20px;">
                    <div id="viewer-container" style="width: 100%; height: 100%;">
                    </div>
                    <div class="bg-config-overview">
                        <a href="https://360fairs.com/" class="btn-config-overview ">
                            <i class="fas fa-cog"></i>
                            <span>Config</span>
                        </a>
                    </div>
                </div>
                <div class="card mt-3" style="width: 100%; height: 105px; padding:8px;">
                    <div id="container">
                        <div class="tour__bottom-bar-slider-outer" id="booth-track">
                            <div class="tour__bottom-bar-slider" style="width: 100%; position: relative;">
                                {{-- <i class="fas fa-angle-left" id="left-button-scroll"></i> --}}
                                <div id="slider-track" class="tour__bottom-bar-slider-track" style=" overflow-x: hidden; height: 100%; display: flex;">
                                    @foreach ($panoramas as $panorama)
                                    <div class="slide_track panorama-item panorama-slide-item" data-panorama-id="{{$panorama->id}}" style="margin: 0 5px">
                                        <div style="width: 135px; height: 90px;">
                                            <img src="{{$panorama->imageUrl}}" onclick="onGoToPanorama(this)" class="slide_track__image panorama-thumbnail__image">
                                            <span class="span-booth-name" style="font-weight: 600">{{$panorama->name}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                {{-- <i class="fas fa-angle-right" id="right-button-scroll"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1.5rem;">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="border shadow-none mb-2 card total_bar_object" style="padding: 0.5rem" >
                            <a class="text-body">
                                <div class="body">
                                    @php
                                        $storageLimit = floatval($booth->storageLimit);
                                        $totalSize = floatval($types->sum('size'))/(1048576);
                                        $totalPercent = ($totalSize != 0) ? (number_format($audioSize * 100 / $totalSize, 1)) : 0;
                                    @endphp
                                    <h4>{{ number_format($totalSize, 1)}} MB used <i class="fa fa-server float-right"></i></h4>
                                    <p class="mb-0">Storage <small class="text-muted float-right">of {{ $storageLimit}}MB</small></p>
                                    <div class="progress progress-striped" style="width: 100%; padding: 0; height: 20px;background: #bbbbbb77;">
                                        <div class="progress-bar progress-bar-warning" style="border-radius: 5px;" data-transitiongoal="{{$totalPercent}}" aria-valuenow="{{$totalPercent}}" style="width: {{$totalPercent}}%;">{{$totalPercent}}%</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="border shadow-none mb-2 card" onclick="switchObjectTypeTag('all')">
                            @php
                                $totalSize = floatval($types->sum('size'))/(1048576);
                                $totalPercent = number_format($totalSize * 100 / $storageLimit, 1);
                            @endphp
                            <a class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center me-2">
                                            <div class="avatar-title rounded bg-transparent text-warning font-size-20"><i class="fas fa-th-list"></i></div>
                                        </div>
                                        <div class="overflow-hidden me-auto">
                                            <h5 class="font-size-13 text-truncate mb-1">All</h5>
                                            <p class="text-muted text-truncate mb-0">All Files</p>
                                        </div>
                                        <div class="ml-2">
                                            <p class="text-muted">{{ $totalSize }} MB</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                <div class="progress-bar bg-warning" data-transitiongoal="{{$totalPercent}}" aria-valuenow="{{$totalPercent}}" style="width: {{$totalPercent}}%;"></div>
                            </div>
                        </div>
                        <div class="border shadow-none mb-2 card" onclick="switchObjectTypeTag('images')">
                            @php
                                $imageCount = ($types->where('type', 'image')->first() != null) ? ($types->where('type', 'image')->first()->count) : 0;
                                $imageSize =  ($types->where('type', 'image')->first() != null) ? (number_format(floatval($types->where('type', 'image')->first()->size) / 1048576 , 1)) : 0;
                                $imagePercent = ($totalSize != 0) ? (number_format($audioSize * 100 / $totalSize, 1)) : 0;
                            @endphp
                            <a class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center me-2">
                                            <div class="avatar-title rounded bg-transparent text-success font-size-20"><i class="fas fa-image"></i></div>
                                        </div>
                                        <div class="overflow-hidden me-auto">
                                            <h5 class="font-size-13 text-truncate mb-1">Images</h5>
                                            <p class="text-muted text-truncate mb-0">{{$imageCount}} Files</p>
                                        </div>
                                        <div class="ml-2">
                                            <p class="text-muted">{{ $imageSize }} MB</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                <div class="progress-bar bg-success" data-transitiongoal="{{$imagePercent}}" aria-valuenow="{{$imagePercent}}" style="width: {{$imagePercent}}%;"></div>
                            </div>
                        </div>
                        <div class="card border shadow-none mb-2" onclick="switchObjectTypeTag('videos')">
                            @php
                                $videoCount = ($types->where('type', 'video')->first() != null) ? ($types->where('type', 'video')->first()->count) : 0;
                                $videoSize =  ($types->where('type', 'video')->first() != null) ? (number_format(floatval($types->where('type', 'video')->first()->size) / 1048576 , 1)) : 0;
                                $videoPercent = ($totalSize != 0) ? (number_format($audioSize * 100 / $totalSize, 1)) : 0;
                            @endphp
                            <a class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center me-2">
                                            <div class="avatar-title rounded bg-transparent text-danger font-size-20"><i class="far fa-play-circle"></i></div>
                                        </div>
                                        <div class="overflow-hidden me-auto">
                                            <h5 class="font-size-13 text-truncate mb-1">Video</h5>
                                            <p class="text-muted text-truncate mb-0">{{$videoCount}} Files</p>
                                        </div>
                                        <div class="ml-2">
                                            <p class="text-muted">{{$videoSize}} MB</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                <div class="progress-bar bg-danger" data-transitiongoal="{{$videoPercent}}" aria-valuenow="{{$videoPercent}}" style="width: {{$videoPercent}}%;"></div>
                            </div>
                        </div>
                        <div class="card border shadow-none mb-2" onclick="switchObjectTypeTag('audios')">
                            @php
                                $audioCount = ($types->where('type', 'audio')->first() != null) ? ($types->where('type', 'audio')->first()->count) : 0;
                                $audioSize =  ($types->where('type', 'audio')->first() != null) ? (number_format(floatval($types->where('type', 'audio')->first()->size) / 1048576 , 1)) : 0;
                                $audioPercent = ($totalSize != 0) ? (number_format($audioSize * 100 / $totalSize, 1)) : 0;
                            @endphp
                            <a class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center me-2">
                                            <div class="avatar-title rounded bg-transparent text-info font-size-20"><i class="fas fa-music"></i></div>
                                        </div>
                                        <div class="overflow-hidden me-auto">
                                            <h5 class="font-size-13 text-truncate mb-1">Audios</h5>
                                            <p class="text-muted text-truncate mb-0">{{$audioCount}} Files</p>
                                        </div>
                                        <div class="ml-2">
                                            <p class="text-muted">{{ $audioSize }} MB</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                <div class="progress-bar bg-info" data-transitiongoal="{{$audioPercent}}" aria-valuenow="{{ $audioPercent }}" style="width: {{$audioPercent}}%;"></div>
                            </div>
                        </div>
                        <div class="card border shadow-none mb-2" onclick="switchObjectTypeTag('models')">
                            @php
                                $modelCount = ($types->where('type', 'model')->first() != null) ? ($types->where('type', 'model')->first()->count) : 0;
                                $modelSize =  ($types->where('type', 'model')->first() != null) ? (number_format(floatval($types->where('type', 'model')->first()->size) / 1048576 , 1)) : 0;
                                $modelPercent = ($totalSize != 0) ? (number_format($audioSize * 100 / $totalSize, 1)) : 0;
                            @endphp
                            <a class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center me-2">
                                            <div class="avatar-title rounded bg-transparent text-models font-size-20"><i class="fab fa-unity"></i></div>
                                        </div>
                                        <div class="overflow-hidden me-auto">
                                            <h5 class="font-size-13 text-truncate mb-1">Model</h5>
                                            <p class="text-muted text-truncate mb-0">{{$modelCount}} Files</p>
                                        </div>
                                        <div class="ml-2">
                                            <p class="text-muted">{{$modelSize}} MB</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                <div class="progress-bar bg-model1" data-transitiongoal="{{$modelPercent}}" aria-valuenow="{{$modelPercent}}" style="width: {{$modelPercent}}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card objects-card all-card" style="width: 100%; height: 647px;padding: 0.25rem;">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="overflow-hidden">
                                <h5 class="font-size-15 font-weight-bold text-primary">Objects</h5>
                            </div>
                        </div>
                        <div class="row" style="height: 570px; overflow-y: scroll;">
                            @foreach ($objects as $object)
                                @if ($object->type == 'image')
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="{{$object->url}}" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($object->type == 'video')
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    @if ($object->source == 'local')
                                    <div class="card">
                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($object->source == 'link')
                                    <div class="card">
                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif
                                @if ($object->type == 'audio')
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="" alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($object->type == 'model')
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <model-viewer style="width: 100%;" src="{{$object->url}}" ar-status="not-presenting"></model-viewer>
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card objects-card images-card" style="width: 100%; height: 647px;padding: 0.25rem; display: none">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="overflow-hidden">
                                <h5 class="font-size-15 font-weight-bold text-primary">Images</h5>
                            </div>
                        </div>
                        <div class="row" style="height: 570px; overflow-y: scroll;">
                            @php
                                $images = $objects->where('type', 'image')->all();
                            @endphp
                            @foreach ($images as $image)
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="{{$image->url}}" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">{{$image->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card objects-card videos-card" style="width: 100%; height: 647px;padding: 0.25rem; display: none">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="overflow-hidden">
                                <h5 class="font-size-15 font-weight-bold text-primary">Videos</h5>
                            </div>
                        </div>
                        <div class="row" style="height: 570px; overflow-y: scroll;">
                            @php
                                $videos = $objects->where('type', 'video')->all();
                            @endphp
                            @foreach ($videos as $video)
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                @if ($video->source == 'local')
                                <div class="card">
                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">{{$video->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @if ($video->source == 'link')
                                <div class="card">
                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">{{$video->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card objects-card audios-card" style="width: 100%; height: 647px;padding: 0.25rem; display: none">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="overflow-hidden">
                                <h5 class="font-size-15 font-weight-bold text-primary">Audios</h5>
                            </div>
                        </div>
                        <div class="row" style="height: 570px; overflow-y: scroll;">
                            @php
                                $audios = $objects->where('type', 'audio')->all();
                            @endphp
                            @foreach ($audios as $audio)
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">{{$audio->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card objects-card models-card" style="width: 100%; height: 647px;padding: 0.25rem; display: none">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="overflow-hidden">
                                <h5 class="font-size-15 font-weight-bold text-primary">Models</h5>
                            </div>
                        </div>
                        <div class="row" style="height: 570px; overflow-y: scroll;">
                            @php
                                $models = $objects->where('type', 'model')->all();
                            @endphp
                            @foreach ($models as $model)
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <model-viewer style="width: 100%;" src="{{$model->url}}" ar-status="not-presenting"></model-viewer>
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">{{$model->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
    <script>
        var viewer;
        var container = document.getElementById('viewer-container');

        function switchObjectTypeTag(type) {  
            $('.objects-card').hide();
            $('.' + type + '-card').show();
        }

        function onGoToPanorama(target) {  
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

        function initViewer() {
            let container = document.getElementById('viewer-container');
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
        }

    </script>
    <script>
        $(document).ready(function() {
            initViewer();

            // $('#upload-logo-btn').click(function () { $('#upload-logo-file-input').trigger('click')});

            // $('#upload-logo-file-input').change(function () {  
            //     let file = this.files[0];
            //     if(file != null){
            //         $('#preview-logo-img').attr('src', URL.createObjectURL(file));
            //         $('.upload-box').hide();
            //         $('.preview-box').show();

            //         let data = new FormData();
            //         data.append('file', file);
            //         let ajax = $.ajax({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             url: "{{env('APP_URL')}}/storage/upload",
            //             method: 'post',
            //             processData: false,
            //             contentType: false,
            //             data: data,
            //             dataType: 'json',
            //             success: function (url) { 
            //                 if (url != null) {
            //                     let ajax = $.ajax({
            //                         headers: {
            //                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                         },
            //                         url: "/administrator/tours/{{$tour->id}}/booths/{{$booth->id}}/change-logo",
            //                         method: 'post',
            //                         data: {
            //                             logo: url
            //                         },
            //                         dataType: 'json',
            //                         success: function (res) { 
            //                             if (res != null) {
            //                                 alert("upload done");
            //                             }
            //                         }
            //                     });
            //                 }
            //             }
            //         });
            //     }
            // })
        });
    </script>
@endsection
