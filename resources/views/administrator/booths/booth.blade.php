@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">{{$booth->name}}</h1>
                    @if ($profile->id == $booth->ownerId || $booth->ownerId === null)
                        <div class="div_cardheader_btn">
                            <button class="mb-0 btn float-right active" onclick="window.open('/partner/booths/{{$booth->id}}')">Go to Management </button>
                        </div>
                    @else 
                        @if ($booth->isWaitingApproval == true && $booth->isConfirmed === null)
                            <div class="div_cardheader_btn">
                                <button class="mb-0 btn float-right active"  data-toggle="modal" data-target="#popup-approve-booth">Approve</button>
                                <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-reject-booth"> Reject</button>
                            </div>
                        @elseif($booth->isConfirmed == true && $booth->isWaitingApproval == false)
                            <div class="div_cardheader_btn">
                                <button class="mb-0 btn float-right active"  data-toggle="modal" data-target="#popup-reedit-booth">Request Re-Edit</button>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-1">
                    <h6 class="mt-2" style="font-size:18px ;text-align: center"> 
                        @if($booth->isConfirmed === null && $booth->isWaitingApproval == false)
                            <span class="badge bg-info" style="font-size:18px ;text-align: center">Editting</span>
                        @elseif($booth->isConfirmed == true && $booth->isWaitingApproval == false)
                            <span class="badge bg-success" style="font-size:18px ;text-align: center">Approved</span>
                        @elseif($booth->isConfirmed == false && $booth->isWaitingApproval == false)
                            <span class="badge bg-danger" style="font-size:18px ;text-align: center">Rejected</span>
                        @elseif($booth->isWaitingApproval == true)
                            <span class="badge bg-warning" style="font-size:18px ;text-align: center">Waiting for approval</span>
                        @endif
                    </h6>
                </div>
            </div>
        </div>
        @if ($profile->id == $booth->ownerId || $booth->ownerId === null)
        <div class="tab-header mb-3 webinar-tab" style="width: 100%; height: 40px; mb-2 ">
            <span class="btn-tab-1 tab-header-btn btn btn-primary float-left active" ><i class="fas fa-stream"></i></span>
            <span class="btn-tab-2 tab-header-btn btn btn-primary float-left"><i class="fas fa-eye"></i></span>
            <span class="btn-tab-3 tab-header-btn btn btn-primary float-left"><i class="far fa-dot-circle"></i></span>
        </div>
        @endif
        <div class="div-tab-1">
            <div class="row mb-3">
                <div class="col-md-5">
                    <div class="card" style="height: 62%">
                        <div class="card-body" style="color: #555; font-size: 14px;">
                            <div class="flex-grow-1 overflow-hidden">
                                <h6 class="font-size-15 font-weight-bold">General information : </h6>
                                <p class="text-muted mb-2"><i class="fas fa-building"></i> <a  class="ml-2 font-weight-bold"  style="cursor: pointer;"> <ins style="text-decoration: none"> {{ $booth->owner != null ? ($booth->owner->name != null ? $booth->owner->name : "N/A") : "N/A"}} </ins></a></p>
                                <p class="text-muted mb-2"><i class="fas fa-envelope"></i> <span class="ml-2"> {{ $booth->owner != null ? ($booth->owner->email != null ? $booth->owner->email : "N/A") : "N/A"}} </span></p>
                                <p class="text-muted mb-2"><i class="fas fa-phone-alt"></i> <span class="ml-2"> {{ $booth->owner != null ? ($booth->owner->contact != null ? $booth->owner->contact : "N/A") : "N/A"}}</span></p>
                                <p class="font-size-15 font-weight-bold">Description : </p>
                                @if ($booth->description != null)
                                    <div class="text-muted discription_tour_text" style="height: 165px ">{{$booth->description}} </div>
                                @else
                                    <div class="text-muted" style="width: 100%; text-align: center ;">No description</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="upload-box" style="display: {{$booth->logo == null ? 'block' : 'none'}}; max-height: 200px; height: 38%">
                            <div class="upload-text text-center">
                                <div class="upload-text text-center">
                                    <div class="upload-form border-dashed" style="height: 165px;line-height: 150px ;font-size: 40px;font-weight: 900;pointer-events: none">
                                    NO LOGO
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="preview-box" style="display: {{$booth->logo == null ? 'none' : 'block'}}; max-height: 200px; height: 200px; padding:1rem;">
                            <div class="upload-text text-center">
                                <img id="preview-logo-img" src="{{$booth->logo}}" style="height: 165px; width:100%"  alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 view_booth_panoles">
                    <div class="card" style="width: 100% ;height: 450px; padding:20px;">
                        <div id="viewer-container" style="width: 100%; height: 100%;">
                        </div>
                        <div class="bg-config-overview">
                            <a href="{{env('TOOL_URL')}}/login?token={{$user->accessToken}}&url=/editor/{{$tour->id}}?b={{$booth->id}}" class="btn-config-overview ">
                                <i class="fas fa-cog"></i>
                                <span>View</span>
                            </a>
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
                                                        <img src="{{$panorama->asset->url}}" onclick="onGoToPanorama(this)" class="slide_track__image panorama-thumbnail__image">
                                                        <span class="span-booth-name" style="font-weight: 600">{{$panorama->name  != null ? $panorama->name : 'unnamed'}}</span>
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
            </div>
            <div class="row  mb-3" >
                <div class="filemanager-sidebar col-md-3 card" style="padding: 0">
                    @php
                        $storageLimit = floatval(1000);
                        $totalSize = floatval($types->sum('size'))/(1048576);
                        $totalPercent = ($storageLimit != 0) ? (number_format($totalSize * 100 / $storageLimit, 1)) : 0;
                    @endphp
                    <div class="text-center mt-3">
                        <h3 class="font-weight-bold text-primary">Storage</h3>
                        <p class="text-muted mt-4">{{number_format($totalSize, 1)}} MB ({{number_format($totalPercent, 1)}}%) of {{$storageLimit}} MB</p>
                    </div>
                    <div class="card">
                        <div class="card-body" style="color: #555; font-size: 14px;">
                            <div class="border shadow-none mb-2 card total_bar_object" style="padding: 0.5rem" >
                                <a class="text-body">
                                    <div class="body">
                                        <h4 style="color: #555">Used :{{ number_format($totalSize, 1)}} MB  <i class="fa fa-server float-right"></i></h4>
                                        <p class="mb-0">Storage <small class="text-muted float-right">of {{ $storageLimit}}MB</small></p>
                                        <div class="progress progress-striped" style="width: 100%; padding: 0; height: 20px;background: #bbbbbb77;">
                                            @if ($totalPercent < 10)
                                                <div class="progress-bar progress-bar-success" style="border-radius: 5px; width: {{$totalPercent}}%;"></div>
                                            @elseif ($totalPercent < 40)
                                                <div class="progress-bar progress-bar-success" style="border-radius: 5px; width: {{$totalPercent}}%;">{{$totalPercent}}%</div>
                                            @elseif ($totalPercent > 40)
                                                <div class="progress-bar progress-bar-warning" style="border-radius: 5px; width: {{$totalPercent}}%;">{{$totalPercent}}%</div>
                                            @elseif ($totalPercent > 80)
                                                <div class="progress-bar progress-bar-danger" style="border-radius: 5px; width: {{$totalPercent}}%;">{{$totalPercent}}%</div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('all')">
                                @php
                                    $totalCount =($types->sum('count'));
                                    $totalSize = floatval($types->sum('size'))/(1048576);
                                    $totalPercent = number_format($totalSize * 100 / $storageLimit, 1);
                                @endphp
                                <a class="text-body btn-item-object-hover">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs-icon align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-warning font-size-20"><i class="fas fa-th-list"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-black-555 text-truncate mb-1">All</h5>
                                                <p class="text-muted text-truncate mb-0">{{$totalCount}} Files</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                                    <div class="progress-bar bg-warning" data-transitiongoal="{{$totalPercent}}" aria-valuenow="{{$totalPercent}}" style="width: {{$totalPercent}}%;"></div>
                                </div>
                            </div>
                            <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('image')">
                                @php
                                    $imageCount = ($types->where('type', 'image')->first() != null) ? ($types->where('type', 'image')->first()->count) : 0;
                                    $imageSize =  ($types->where('type', 'image')->first() != null) ? (number_format(floatval($types->where('type', 'image')->first()->size) / 1048576 , 1)) : 0;
                                    $imagePercent = ($totalSize != 0) ? (number_format($imageSize * 100 / $totalSize, 1)) : 0;
                                @endphp
                                <a class="text-body btn-item-object-hover">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs-icon align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-success font-size-20"><i class="fas fa-image"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-black-555 text-truncate mb-1">Images</h5>
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
                            <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('video')">
                                @php
                                    $videoCount = ($types->where('type', 'video')->first() != null) ? ($types->where('type', 'video')->first()->count) : 0;
                                    $videoSize =  ($types->where('type', 'video')->first() != null) ? (number_format(floatval($types->where('type', 'video')->first()->size) / 1048576 , 1)) : 0;
                                    $videoPercent = ($totalSize != 0) ? (number_format($videoSize * 100 / $totalSize, 1)) : 0;
                                @endphp
                                <a class="text-body btn-item-object-hover">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs-icon align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-danger font-size-20"><i class="far fa-play-circle"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-black-555 text-truncate mb-1">Video</h5>
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
                            <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('audio')">
                                @php
                                    $audioCount = ($types->where('type', 'audio')->first() != null) ? ($types->where('type', 'audio')->first()->count) : 0;
                                    $audioSize =  ($types->where('type', 'audio')->first() != null) ? (number_format(floatval($types->where('type', 'audio')->first()->size) / 1048576 , 1)) : 0;
                                    $audioPercent = ($totalSize != 0) ? (number_format($audioSize * 100 / $totalSize, 1)) : 0;
                                @endphp
                                <a class="text-body btn-item-object-hover">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs-icon align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-info font-size-20"><i class="fas fa-music"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-black-555 text-truncate mb-1">Audios</h5>
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
                            <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('model')">
                                @php
                                    $modelCount = ($types->where('type', 'model')->first() != null) ? ($types->where('type', 'model')->first()->count) : 0;
                                    $modelSize =  ($types->where('type', 'model')->first() != null) ? (number_format(floatval($types->where('type', 'model')->first()->size) / 1048576 , 1)) : 0;
                                    $modelPercent = ($totalSize != 0) ? (number_format($modelSize * 100 / $totalSize, 1)) : 0;
                                @endphp
                                <a class="text-body btn-item-object-hover">
                                    <div class="p-2">
                                        <div class="d-flex">
                                            <div class="avatar-xs-icon align-self-center me-2">
                                                <div class="avatar-title rounded bg-transparent text-models font-size-20"><i class="fab fa-unity"></i></div>
                                            </div>
                                            <div class="overflow-hidden me-auto">
                                                <h5 class="font-black-555  text-truncate mb-1">Model</h5>
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
                <div class="col-md-9" style="padding: 0;padding-left: 1rem;">
                    <div class="card" style="padding-left: 1rem; padding-right: 1rem; height: 100%;">
                        <div class="mt-4 mb-4">
                            <div class="d-flex flex-wrap">
                                <h1 class="h6 font-weight-bold text-primary" style="margin: 0px"><i class="fab fa-cloudscale"></i> Recent File</h1>
                                <div class="div_cardheader_btn">
                                    <span class="mb-0 btn float-right tab-btn" data-tab="card"><i class="far fa-clone"></i></span>
                                    <span class="mb-0 btn float-right tab-btn" data-tab="table"><i class="fas fa-list-ul"></i> </span>
                                </div>
                            </div>
                            <hr class="mt-3"/>
                            <div class="tab-body" data-tab="table">
                                <div class="assets-wrapper all">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" style="width: 50%;">Name</th>
                                                    <th scope="col" style="width: 10%;">Source</th>
                                                    <th scope="col" style="width: 10%;">Size</th>
                                                    <th scope="col" style="width: 25%">Uploaded at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($assets as $asset)
                                                <tr>
                                                    <td style="width: 5%; text-align: center">
                                                        @if ($asset->type == 'image')
                                                           <span><i class="fas fa-image font-size-16 text-success"></i> <span style="display: none">1</span> </span> 
                                                        @elseif($asset->type == 'video')
                                                            <span><i class="far fa-play-circle font-size-16 text-danger"></i> <span style="display: none">2</span> </span> 
                                                        @elseif($asset->type == 'audio')
                                                            <span><i class="fas fa-music font-size-16 text-info"></i><span style="display: none">3</span></span> 
                                                        @elseif($asset->type == 'model')
                                                            <span><i class="fab fa-unity font-size-16 text-models"></i><span style="display: none">4</span></span> 
                                                        @else 
                                                           
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="text-primary" href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">{{$asset->name != null ? $asset->name : 'unname'}}</a>
                                                    </td>
                                                    <td>{{$asset->source != null ? $asset->source : 'N/A'}}</td>
                                                    <td>{{$asset->size != null ? strval(number_format(floatval($asset->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                    <td>{{$asset->updated_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="assets-wrapper image" style="display: none">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" style="width: 50%;">Name</th>
                                                    <th scope="col" style="width: 10%;">Source</th>
                                                    <th scope="col" style="width: 10%;">Size</th>
                                                    <th scope="col" style="width: 25%">Uploaded at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $images = $assets->where('type', 'image');
                                                @endphp
                                                @foreach ($assets as $asset)
                                                <tr>
                                                    <td style="width: 5%; text-align: center">
                                                        <span><i class="fas fa-image font-size-16 text-success"></i> <span style="display: none">1</span> </span> 
                                                    </td>
                                                    <td>
                                                        <a class="text-primary" href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">{{$asset->name != null ? $asset->name : 'unname'}}</a>
                                                    </td>
                                                    <td>{{$asset->source != null ? $asset->source : 'N/A'}}</td>
                                                    <td>{{$asset->size != null ? strval(number_format(floatval($asset->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                    <td>{{$asset->updated_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="assets-wrapper video" style="display: none">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" style="width: 50%;">Name</th>
                                                    <th scope="col" style="width: 10%;">Source</th>
                                                    <th scope="col" style="width: 10%;">Size</th>
                                                    <th scope="col" style="width: 25%">Uploaded at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $videos = $assets->where('type', 'video');
                                                @endphp
                                                @foreach ($videos as $asset)
                                                <tr>
                                                    <td style="width: 5%; text-align: center">
                                                        <span><i class="far fa-play-circle font-size-16 text-danger"></i> <span style="display: none">2</span> </span> 
                                                    </td>
                                                    <td>
                                                        <a class="text-primary" href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">{{$asset->name != null ? $asset->name : 'unname'}}</a>
                                                    </td>
                                                    <td>{{$asset->source != null ? $asset->source : 'N/A'}}</td>
                                                    <td>{{$asset->size != null ? strval(number_format(floatval($asset->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                    <td>{{$asset->updated_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="assets-wrapper audio" style="display: none">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" style="width: 50%;">Name</th>
                                                    <th scope="col" style="width: 10%;">Source</th>
                                                    <th scope="col" style="width: 10%;">Size</th>
                                                    <th scope="col" style="width: 25%">Uploaded at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $audios = $assets->where('type', 'audio');
                                                @endphp
                                                @foreach ($audios as $asset)
                                                <tr>
                                                    <td style="width: 5%; text-align: center">
                                                        <span><i class="fas fa-music font-size-16 text-info"></i><span style="display: none">3</span></span> 
                                                    </td>
                                                    <td>
                                                        <a class="text-primary" href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">{{$asset->name != null ? $asset->name : 'unname'}}</a>
                                                    </td>
                                                    <td>{{$asset->source != null ? $asset->source : 'N/A'}}</td>
                                                    <td>{{$asset->size != null ? strval(number_format(floatval($asset->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                    <td>{{$asset->updated_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="assets-wrapper model" style="display: none">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col" style="width: 50%;">Name</th>
                                                    <th scope="col" style="width: 10%;">Source</th>
                                                    <th scope="col" style="width: 10%;">Size</th>
                                                    <th scope="col" style="width: 25%">Uploaded at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $models = $assets->where('type', 'model');
                                                @endphp
                                                @foreach ($models as $asset)
                                                <tr>
                                                    <td style="width: 5%; text-align: center">
                                                        <span><i class="fab fa-unity font-size-16 text-models"></i><span style="display: none">4</span></span> 
                                                    </td>
                                                    <td>
                                                        <a class="text-primary" href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">{{$asset->name != null ? $asset->name : 'unname'}}</a>
                                                    </td>
                                                    <td>{{$asset->source != null ? $asset->source : 'N/A'}}</td>
                                                    <td>{{$asset->size != null ? strval(number_format(floatval($asset->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                    <td>{{$asset->updated_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-body" data-tab="card" style="display: none">
                                <div class="card assets-wrapper all" style="width: 100%; height: 100%; padding: 0.25rem;">
                                    <div class="card-body" style="color: #555; font-size: 14px;">
                                        <div class="row" style="max-height: 450px; overflow-y: scroll;">
                                            @foreach ($assets as $asset)
                                                @if ($asset->type == 'image')
                                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                                    <div class="card object-file-booth">
                                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                            <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
                                                                <div class="image">
                                                                    @if ($asset->url != null || $asset->url !='')
                                                                        <img src="{{$asset->miniUrl()}}" alt="img" width="100%" class="img-fluid">
                                                                    @else
                                                                        <img src="https://res.cloudinary.com/virtual-tour/image/upload/v1634815623/error-404_ghj2tk.png" alt="img" class="img-fluid">
                                                                    @endif
                                                                </div>
                                                                <div class="file-name">
                                                                    <p class="m-b-5 text-muted">{{$asset->name}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($asset->type == 'video')
                                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                                    @if ($asset->source == 'youtube')
                                                    <div class="card object-file-booth">
                                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                            <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
                                                                <div class="image">
                                                                    <img class="repair-yt-url" src="{{$asset->url}}" style="background-color: black; width: 100%; height:100%;">
                                                                </div>
                                                                <div class="file-name">
                                                                    <p class="m-b-5 text-muted">{{$asset->name}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="card object-file-booth">
                                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                            <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
                                                                <div class="image">
                                                                    <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                                    <div class="image">
                                                                        <video src="{{$asset->url}}#t=1">
                                                                    </div>
                                                                </div>
                                                                <div class="file-name">
                                                                    <p class="m-b-5 text-muted">{{$asset->name}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                @endif
                                                @if ($asset->type == 'audio')
                                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                                    <div class="card object-file-booth">
                                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                            <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
                                                                <div class="image">
                                                                    <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                                    <div class="icon">
                                                                        <i class="fab fa-soundcloud"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="file-name">
                                                                    <p class="m-b-5 text-muted">{{$asset->name}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($asset->type == 'model')
                                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                                    <div class="card object-file-booth">
                                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                            <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
                                                                <div class="image">
                                                                    <model-viewer style="width: 100%; height: 120px;" src="{{$asset->url}}" ar-status="not-presenting"></model-viewer>
                                                                </div>
                                                                <div class="file-name">
                                                                    <p class="m-b-5 text-muted">{{$asset->name}}</p>
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
                                <div class="card assets-wrapper image" style="width: 100%;padding: 0.25rem; display: none">
                                    <div class="card-body" style="color: #555; font-size: 14px;">
                                        <div class="d-flex">
                                            <div class="overflow-hidden">
                                                <h5 class="font-size-15 font-weight-bold text-primary">Images</h5>
                                            </div>
                                        </div>
                                        <div class="row" style="max-height: 450px; overflow-y: scroll;">
                                            @php
                                                $images = $assets->where('type', 'image')->all();
                                            @endphp
                                            @foreach ($images as $image)
                                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);">
                                                            <div class="image">
                                                                <img src="{{$image->url}}" width="100%" alt="img" class="img-fluid">
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
                                <div class="card assets-wrapper video" style="width: 100%;padding: 0.25rem; display: none">
                                    <div class="card-body" style="color: #555; font-size: 14px;">
                                        <div class="d-flex">
                                            <div class="overflow-hidden">
                                                <h5 class="font-size-15 font-weight-bold text-primary">Videos</h5>
                                            </div>
                                        </div>
                                        <div class="row" style="max-height: 450px; overflow-y: scroll;">
                                            @php
                                                $videos = $assets->where('type', 'video')->all();
                                            @endphp
                                            @foreach ($videos as $video)
                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                @if ($video->source == 'local')
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);">
                                                            <div class="image">
                                                                <div class="icon">
                                                                    <i class="fas fa-film"></i>
                                                                </div>
                                                            </div>
                                                            <div class="file-name">
                                                                <p class="m-b-5 text-muted">{{$video->name}}</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($video->source == 'link')
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);">
                                                            <div class="image">
                                                            <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                                <div class="icon">
                                                                    <i class="fas fa-film"></i>
                                                                </div>
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
                                <div class="card assets-wrapper audio" style="width: 100%; padding: 0.25rem; display: none">
                                    <div class="card-body" style="color: #555; font-size: 14px;">
                                        <div class="d-flex">
                                            <div class="overflow-hidden">
                                                <h5 class="font-size-15 font-weight-bold text-primary">Audios</h5>
                                            </div>
                                        </div>
                                        <div class="row" style="max-height: 450px; overflow-y: scroll;">
                                            @php
                                                $audios = $assets->where('type', 'audio')->all();
                                            @endphp
                                            @foreach ($audios as $audio)
                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                @if ($audio->source == 'local')
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);">
                                                            <div class="image">
                                                                <div class="icon">
                                                                    <i class="fas fa-volume-up"></i>
                                                                </div>
                                                            </div>
                                                            <div class="file-name">
                                                                <p class="m-b-5 text-muted">{{$audio->name}}</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($audio->source == 'link')
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);">
                                                            <div class="image">
                                                            <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                                <div class="icon">
                                                                    <i class="fab fa-soundcloud"></i>
                                                                </div>
                                                            </div>
                                                            <div class="file-name">
                                                                <p class="m-b-5 text-muted">{{$audio->name}}</p>
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
                                <div class="card assets-wrapper model" style="width: 100%;padding: 0.25rem; display: none">
                                    <div class="card-body" style="color: #555; font-size: 14px;">
                                        <div class="d-flex">
                                            <div class="overflow-hidden">
                                                <h5 class="font-size-15 font-weight-bold text-primary">Models</h5>
                                            </div>
                                        </div>
                                        <div class="row" style="max-height: 500px; overflow-y: scroll;">
                                            @php
                                                $models = $assets->where('type', 'model')->all();
                                            @endphp
                                            @foreach ($models as $model)
                                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);">
                                                            <div class="image">
                                                                <model-viewer style="width: 100%;height: 120px;" src="{{$model->url}}" ar-status="not-presenting"></model-viewer>
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
                </div>
            </div>
        </div>
        @if ($profile->id == $booth->ownerId || $booth->ownerId === null)
        <div class="div-tab-2" style="display: none">
            <div class="row mb-3 tags-area">
                <div class="col-md-12">
                    <div class="card mb-4" style="max-height: 500px;">
                        <div class="card-header">
                            <span class="h5 font-weight-bold text-primary" style="margin: 0px">Views</span>
                            <div class="div_cardheader_btn">
                                <span class="mb-0 btn float-right"><i class="fas fa-eye"></i> {{ count($views)}} </span>
                            </div>
                        </div>
                        <div class="card-body" style="height: 100%; width:100%;">
                            <div id="view-chart-container" style="height: 100%; width:100%;">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <span class="h6 font-weight-bold text-primary" style="margin: 0px">Comments</span>
                            <div class="div_cardheader_btn">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="comment-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background: #eef2f7;">
                                            <th style="text-align: center; width: 5%;">#</th>
                                            <th style="width: 20%;">Name</th>
                                            <th style="width: 170px;">Datetime</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $number = 1;
                                        @endphp
                                        @foreach ($comments as $comment)
                                        <tr data-comment-id="{{$comment->id}}">
                                            <td style="text-align: center">{{$number++}}</td>
                                            <td>{{$comment->visitor->name}}</td>
                                            <td>{{$comment->updated_at}}</td>
                                            <td>{{$comment->text}}</td>
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
        <div class="div-tab-3" style="display: none">
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
                                            <th style="width: 40%;">Name</th>
                                            <th >Views</th>
                                            <th >Likes</th>
                                            <th>Comments</th>
                                            <th>Actions</th>
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
                                            <td><span>{{$object->text}}</span></td>
                                            <td><span>{{$object->viewCount}}</span></td>
                                            <td><span>{{$object->likeCount}}</span></td>
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
        @endif
    </div>

    {{-- POPUP APPROVE BOOTH --}}
    <div class="modal fade" id="popup-approve-booth" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Confirm Approve</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <span>Are you sure to approve this webinar ?</span>
                    <span class="error text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="approveBooth()">Approve</button>
                </div>
            </div>
        </div>
    </div>

    {{-- POPUP REEDIT BOOTH --}}
    <div class="modal fade" id="popup-reedit-booth" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Confirm Send Request Re-Edit</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <span>Are you sure to approve this webinar ?</span>
                    <span class="error text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="reeditBooth()">Send Request</button>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP ASSET  DETAIL --}}
    <div class="modal fade" id="popup-asset-detail" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Asset Detail </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <div class="row mb-3" >
                        <div class="col-md-4">
                            <div class="card" style="min-height:450px ; height: 100% ;">
                                <div class="card-body" style="color: #555; font-size: 14px;">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="font-size-15 font-weight-bold">General </h6>
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="text-muted mb-2"> Name:  </p>
                                                <p class="text-muted mb-2"> Type: </p>
                                                <p class="text-muted mb-2"> Source: </p>
                                                <p class="text-muted mb-2"> Format: </p>
                                                <p class="text-muted mb-2"> size: </p>
                                                <p class="text-muted mb-2"> Updated at: </p>
                                            </div>
                                            <div class="col-8">
                                                <p class="text-muted mb-2"><span id="popup-asset-detail__name-text" class="ml-2 font-weight-bold"></span> </p>
                                                <p class="text-muted mb-2"><span id="popup-asset-detail__type-text" class="ml-2 font-weight-bold"></span></p>
                                                <p class="text-muted mb-2"><span id="popup-asset-detail__source-text" class="ml-2 font-weight-bold"></span></p>
                                                <p class="text-muted mb-2"><span id="popup-asset-detail__format-text" class="ml-2 font-weight-bold"></span></p>
                                                <p class="text-muted mb-2"><span id="popup-asset-detail__size-text" class="ml-2 font-weight-bold"></span></p>
                                                <p class="text-muted mb-2"><span id="popup-asset-detail__uploadedat-text" class="ml-2 font-weight-bold"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 view_booth_panoles">
                            <div class="card" style="width: 100% ; height: 300px; padding:20px;">
                                <div class="preview-wrapper" style="width: 100%; height: 100%;">
                                    <img src="" alt="" style="width: 100%; display: none">
                                    <iframe src="" style="display: none" width="100%" height="400px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <video src="" alt="" controls style="width: 100%;display: none" controls></video>
                                    <audio src="" alt="" controls style="width: 100%;display: none"></audio>
                                    <model-viewer src="" style="width: 100%; height: 100%; display: none" shadow-intensity="1" camera-controls></model-viewer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP REJECT BOOTH --}}
    <div class="modal fade" id="popup-reject-booth" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Confirm Reject</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <span>Are you sure to reject this webinar ?</span>
                    <span class="error text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="rejectBooth()">Reject</button>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP OBJECT DETAIL --}}
    <div class="modal fade" id="popup-object-detail" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xls" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light"><span id="popup-object-detail__name-text" class="text-primary font-weight-bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">
                            <div id="popup-object-detail__preview-wrapper" style="width: 100%; height: 300px; border-radius: 5px;">
                                <img src="" alt="" style="width: 100%; height: 300px; display: none; border-radius: 5px;">
                                <iframe src="" style="display: none; width=100%; height: 300px ; border-radius: 5px;" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <video src="" alt="" controls style=" width=100%; height: 300px; display: none; border-radius: 5px;" controls></video>
                                <audio src="" alt="" controls style=" width=100%; height: 300px;display: none; border-radius: 5px;"></audio>
                                <model-viewer src="" style=" width=100%; 300px; display: none" shadow-intensity="1" camera-controls></model-viewer>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <span class="h6 font-weight-bold text-primary" style="margin: 0px">Views & Likes</span>
                                    <div class="div_cardheader_btn">
                                        <span class="mb-0 btn float-right"><i class="fas fa-thumbs-up"></i> <span id="popup-object-detail__like-count"></span> </span>
                                        <span class="mb-0 btn float-right"><i class="fas fa-eye"></i> <span id="popup-object-detail__view-count"></span> </span>
                                        <span class="mb-0 btn float-right"><i class="fas fa-user-friends"></i> <span id="popup-object-detail__visitor-count"></span> </span>
                                    </div>
                                </div> 
                                <div class="card-body" style="height: 250px; width:100%;">
                                    <div id="popup-object-detail__chart-wrapper" style="margin-top: -30px; width: 100%; height: 100%;">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="popup-object-detail__comments-table" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="background: #eef2f7;">
                                            <th style="text-align: center; width: 5%;">#</th>
                                            <th style="width: 20%;">Name</th>
                                            <th style="width: 170px;">Datetime</th>
                                            <th>Comment</th>
                                            <th style="width: 50px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="popup-object-detail__cover" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;border-radius: 5px;z-index: 10000;min-height: 70vh">
                    <div class="pop-loader-wrapper">
                        <div class="loader">
                            <div class="m-t-30"><img src="{{ asset('admin-master/asset/images/logo-shortcut.svg')}}" width="48" height="48" alt="Lucid"></div>
                            <p>
                                </p><div class="waviy">
                                    <span style="--i:1">P</span>
                                    <span style="--i:2">l</span>
                                    <span style="--i:3">e</span>
                                    <span style="--i:4">a</span>
                                    <span style="--i:5">s</span>
                                    <span style="--i:6">e</span>
                                    <span style="--i:7"></span>
                                    <span style="--i:8">w</span>
                                    <span style="--i:9">a</span>
                                    <span style="--i:10">i</span>
                                    <span style="--i:11">t</span>
                                    <span style="--i:12">.</span>
                                    <span style="--i:13">.</span>
                                    <span style="--i:14">.</span>
                                </div>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var viewer;
        var container = document.getElementById('viewer-container');
        var assetViewChart = null;
        var views = {!! json_encode($views) !!};
        var assets = {!! json_encode($assets) !!}

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

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
                let imagePanorama = new PANOLENS.ImagePanorama("{{$panoramas->where('id', $scene->defaultPanoramaId)->first()->asset->url}}");
                viewer.add(imagePanorama);
            @endif
        }

        function initViewChart() { 
            
            let dataView = [];
            let dataVisitor = [];
            let countView = 0;
            let visitorIds = [];

            views.forEach(view => {
                countView ++;
                dataView.push({
                    x: new Date(view.created_at).getTime(),
                    y: countView
                });

                if(!visitorIds.includes(view.visitorId)){
                    visitorIds.push(view.visitorId);
                }

                dataVisitor.push({
                    x: new Date(view.created_at).getTime(),
                    y: visitorIds.length
                });
            });

            var options = {
                series:[
                    {
                        name: 'view',
                        data: dataView
                    },
                    {
                        name: 'visitor',
                        data: dataVisitor
                    },
                ],
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
                    curve: 'straight'
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
                        text: 'count'
                    },
                },
                xaxis: {
                    type: 'datetime',
                    title: {
                        text: 'datetime'
                    },
                }
            };

            var chart = new ApexCharts(document.querySelector("#view-chart-container"), options);
            chart.render();
        }

        function openPopupAssetDetail(id){ 
            $('#popup-asset-detail').modal('show');
            let asset = null;
            assets.forEach(item => {
                if(item.id == id){
                    asset = item;
                }
            });
            
            $('#popup-asset-detail__name-text').text(asset.name);
            $('#popup-asset-detail__type-text').text(asset.type);
            $('#popup-asset-detail__source-text').text(asset.source);
            $('#popup-asset-detail__format-text').text(asset.format);
            $('#popup-asset-detail__size-text').text((asset.size / 1048576).toFixed(1) + " MB");
            $('#popup-asset-detail__uploadedat-text').text( new Date(asset.updated_at).toLocaleString());

            $('#popup-asset-detail').find(".preview-wrapper").children().hide();

            if(asset.type == "image"){
                let elm = $('#popup-asset-detail').find(".preview-wrapper").find('img');
                elm.show();
                elm.attr('src', asset.url);
            }  
            else
            if(asset.type == "video"){
                if(asset.source == 'youtube'){
                    let elm = $('#popup-asset-detail').find(".preview-wrapper").find('iframe');
                    elm.show();
                    let yt = K_URL.YouTube(asset.url);
                    elm.attr('src', yt.embedUrl + '?showinfo=0');
                }
                else
                {
                    let elm = $('#popup-asset-detail').find(".preview-wrapper").find('video');
                    elm.show();
                    elm.attr('src', asset.url + '#t=1');
                }    
            }
            else
            if(asset.type == "audio"){
                let elm = $('#popup-asset-detail').find(".preview-wrapper").find('audio');
                elm.show();
                elm.attr('src', asset.url);
            } 
            else
            if(asset.type == "model"){
                let elm = $('#popup-asset-detail').find(".preview-wrapper").find('model-viewer');
                elm.show();
                elm.attr('src', asset.url);
            }  
        }

        function closePopupAssetDetail(){ 
            $('#popup-asset-detail').modal('hide');
            $('#popup-asset-detail').find(".preview-wrapper").children().attr("src", "");
        }

        async function openPopupObjectDetail(assetId){
            $('#popup-object-detail').modal('show');
            $('#popup-object-detail__cover').show();
            $('#popup-object-detail__chart-wrapper').empty();
            $("#popup-object-detail__preview-wrapper").children().hide();
            $('#popup-object-detail__comments-table').find('tbody').empty();

            sleep(500);

            let res = await $.ajax({
                type: "get",
                url: "/administrator/tours/{{$tour->id}}/assets/"+ assetId +"/get-infor",
                dataType: 'json',
            });

            if(res != null){

                let asset = res.asset;
                let views = res.views;
                let likes = res.likes;
                let comments = res.comments;

                $('#popup-object-detail__name-text').text(asset.text || 'unnamed');

                // show object
                if(asset.type == "image"){
                    let elm = $("#popup-object-detail__preview-wrapper").find('img');
                    elm.show();
                    elm.attr('src', asset.url);
                }  
                else
                if(asset.type == "video"){
                    if(asset.source == 'youtube'){
                        let elm = $("#popup-object-detail__preview-wrapper").find('iframe');
                        elm.show();
                        let yt = K_URL.YouTube(asset.url);
                        elm.attr('src', yt.embedUrl + '?showinfo=0');
                    }
                    else
                    {
                        let elm = $("#popup-object-detail__preview-wrapper").find('video');
                        elm.show();
                        elm.attr('src', asset.url + '#t=1');
                    }    
                }
                else
                if(asset.type == "audio"){
                    let elm = $("#popup-object-detail__preview-wrapper").find('audio');
                    elm.show();
                    elm.attr('src', asset.url);
                } 
                else
                if(asset.type == "model"){
                    let elm = $("#popup-object-detail__preview-wrapper").find('model-viewer');
                    elm.show();
                    elm.attr('src', asset.url);
                }  

                // draw chart
                let dataView = [];
                let dataLike = [];
                let dataVisiter = [];
                let countView = 0;
                let countLike = 0;
                let visiterIds = [];
                views.forEach(view => {
                    countView ++;
                    dataView.push({
                        x: new Date(view.created_at).getTime(),
                        y: countView
                    });

                    if(!visiterIds.includes(view.visitorId)){
                        visiterIds.push(view.visitorId);
                    }

                    dataVisiter.push({
                        x: new Date(view.created_at).getTime(),
                        y: visiterIds.length
                    });
                });
                likes.forEach(like => {
                    countLike ++;
                    dataLike.push({
                        x: new Date(like.created_at).getTime(),
                        y: countLike
                    });
                });
                
                $('#popup-object-detail__view-count').text(countView);
                $('#popup-object-detail__visitor-count').text(visiterIds.length);
                $('#popup-object-detail__like-count').text(countLike);
                var options = {
                    series:[
                        {
                            name: 'view',
                            data: dataView
                        },
                        {
                            name: 'like',
                            data: dataLike
                        },
                        {
                            name: 'visiter',
                            data: dataVisiter
                        },
                    ],
                    chart: {
                        id: 'view-chart',
                        height: 250,
                        type: 'line',
                        zoom: {
                            type: 'x',
                            enabled: true,
                        },
                        toolbar: {
                            show: false,
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
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
                            text: 'count'
                        },
                    },
                    xaxis: {
                        type: 'datetime',
                    }
                };
                if(assetViewChart != null){
                    assetViewChart.destroy();
                }
                assetViewChart = new ApexCharts(document.querySelector("#popup-object-detail__chart-wrapper"), options);
                assetViewChart.render();

                // table
                comments.forEach(comment => {
                    let number = 1;
                    let tr;
                    if(comment.isHidden){
                        tr = $(`
                            <tr data-comment-id="`+ comment.id +`">
                                <td style="text-align: center"> <span>`+ number++ +`</span></td>
                                <td> <span style="opacity: 0.3">`+ comment.visitor.name +`</span></td>
                                <td> <span style="opacity: 0.3">`+ new Date(comment.updated_at).toLocaleString()+` </span></td>
                                <td> <span style="opacity: 0.3">`+ comment.text +`</span></td>
                                <td class="actions btn-action-icon"><i class="fas fa-eye view" data-comment-id="`+comment.id+`" onclick="showComment(event)"></i></td>
                            </tr>
                        `);
                    }
                    else{
                        tr = $(`
                        <tr data-comment-id="`+ comment.id +`">
                                <td style="text-align: center"> <span>`+ number++ +`</span></td>
                                <td> <span>`+ comment.visitor.name +`</span></td>
                                <td> <span> `+ new Date(comment.updated_at).toLocaleString()+` </span></td>
                                <td> <span>`+ comment.text +`</span></td>
                                <td class="actions btn-action-icon"><i class="fas fa-trash-alt delete" data-comment-id="`+comment.id+`" onclick="hideComment(event)"></i></td>
                            </tr>
                        `);
                    }

                    $('#popup-object-detail__comments-table').find('tbody').append(tr);
                });
                $('#popup-object-detail__comments-table').DataTable({
                    "order": [[ 2, "desc" ]]
                });

                $('#popup-object-detail__cover').hide();
            }
        }

        function closePopupObjectDetail(){
            $('#popup-object-detail__comments-table').dataTable().fnDestroy();
        }

        function approveBooth() {  
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/booths/save-approve",
                type: 'post',
                dataType: 'json',
                data:{
                    boothId: '{{$booth->id}}'
                },
                success: function (res) { 
                    if(res.success == true){
                        location.reload()
                    }
                    else{
                        $('#popup-approve-booth').find(".error").text(res.error);
                        $('#popup-approve-booth').find(".error").show();
                    }
                }
            });
        }

        function reeditBooth() {  
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/booths/save-reedit",
                type: 'post',
                dataType: 'json',
                data:{
                    boothId: '{{$booth->id}}'
                },
                success: function (res) { 
                    if(res.success == true){
                        location.reload()
                    }
                    else{
                        $('#popup-reedit-booth').find(".error").text(res.error);
                        $('#popup-reedit-booth').find(".error").show();
                    }
                }
            });
        }

        function rejectBooth() {  
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/booths/save-reject",
                type: 'post',
                dataType: 'json',
                data:{
                    boothId: '{{$booth->id}}'
                },
                success: function (res) { 
                    if(res.success == true){
                        location.reload()
                    }
                    else{
                        $('#popup-reject-booth').find(".error").text(res.error);
                        $('#popup-reject-booth').find(".error").show();
                    }
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {

            initViewer();

            let elms = $('.repair-yt-url');
            $.each(elms, function (i, elm) { 
                let yt = K_URL.YouTube($(this).attr('src'));
                if(yt){
                    $(this).attr('src', "https://img.youtube.com/vi/"+ yt.id +"/mqdefault.jpg");
                }
            });

            $('#comment-table').DataTable();

            $('.datatable').DataTable({
                "order": [[ 4, "desc" ]]
            });

            $('#popup-object-detail').on("hidden.bs.modal", function () {
                closePopupObjectDetail();
            });

            $('.btn-tab-1').click(function(){
                $('.div-tab-1').show();
                $('.div-tab-2').hide();
                $('.div-tab-3').hide();
                $('.btn-tab-1').addClass('active');
                $('.btn-tab-2').removeClass('active');
                $('.btn-tab-3').removeClass('active');
            });
            $('.btn-tab-2').click(function(){
                $('.div-tab-2').show();
                $('.div-tab-1').hide();
                $('.div-tab-3').hide();
                $('.btn-tab-2').addClass('active');
                $('.btn-tab-1').removeClass('active');
                $('.btn-tab-3').removeClass('active');
                initViewChart();
            });

            $('.btn-tab-3').click(function(){
                $('.div-tab-3').show();
                $('.div-tab-1').hide();
                $('.div-tab-2').hide();
                $('.btn-tab-1').removeClass('active');
                $('.btn-tab-2').removeClass('active');
                $('.btn-tab-3').addClass('active');
            });
        });
    </script>
@endsection
