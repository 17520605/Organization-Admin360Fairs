@extends('layouts.master')

@section('content')
     <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="container-fluid manager_object">
            <div class="row">
                <div class="col-md-12" style="padding: 0;">
                    <div class="card p-3">
                        <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Files Manager</h1>
                        <div class="div_cardheader_btn">
                            <button class="mb-0 btn float-right active" onclick="openPopupUploadAssets()"><i class="fas fa-plus"></i> Upload Assets </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="filemanager-sidebar col-md-3 card" style="padding: 0">
                    @php
                        $storageLimit = floatval(1000);
                        $totalSize = floatval($types->sum('size'))/(1048576);
                        $totalPercent = ($storageLimit != 0) ? (number_format($totalSize * 100 / $storageLimit, 1)) : 0;
                    @endphp
                    <div class="text-center mt-3">
                        <h5 class="font-size-15">Storage</h5>
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
                    <div class="card" style="padding-left: 1rem; padding-right: 1rem;">
                        <div class="mt-4">
                            <div class="d-flex flex-wrap">
                                <h1 class="h6 font-weight-bold text-primary" style="margin: 0px"><i class="fab fa-cloudscale"></i> Recent  File</h1>
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
                                <div class="card assets-wrapper all" style="width: 100%; padding: 0.25rem;">
                                    <div class="card-body" style="color: #555; font-size: 14px;">
                                        <div class="row" style="height: 430px;">
                                            @foreach ($assets as $asset)
                                                @if ($asset->type == 'image')
                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
                                                    <div class="card object-file-booth">
                                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                            <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
                                                                <div class="image">
                                                                    @if ($asset->url != null || $asset->url !='')
                                                                        <img src="{{$asset->miniUrl()}}" alt="img" class="img-fluid">
                                                                    @else
                                                                        <img src="https://res.cloudinary.com/virtual-tour/image/upload/v1634815623/error-404_ghj2tk.png" alt="img" class="img-fluid">
                                                                    @endif
                                                                </div>
                                                                <div class="file-name">
                                                                    <p class="m-b-5 text-muted">{{$asset->name != null ? $asset->name : 'unname'}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($asset->type == 'video')
                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
                                                    @if ($asset->source == 'local')
                                                    <div class="card object-file-booth">
                                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                            <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
                                                                <div class="image">
                                                                    <img src="" alt="img" class="img-fluid">
                                                                </div>
                                                                <div class="file-name">
                                                                    <p class="m-b-5 text-muted">{{$asset->name != null ? $asset->name : 'unname'}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if ($asset->source == 'link')
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
                                                                    <p class="m-b-5 text-muted">{{$asset->name != null ? $asset->name : 'unname'}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                @endif
                                                @if ($asset->type == 'audio')
                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
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
                                                                    <p class="m-b-5 text-muted">{{$asset->name != null ? $asset->name : 'unname'}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($asset->type == 'model')
                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
                                                    <div class="card object-file-booth">
                                                        <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                            <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
                                                                <div class="image">
                                                                    <model-viewer style="width: 100%; height: 120px;" src="{{$asset->url}}" ar-status="not-presenting"></model-viewer>
                                                                </div>
                                                                <div class="file-name">
                                                                    <p class="m-b-5 text-muted">{{$asset->name != null ? $asset->name : 'unname'}}</p>
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
                                        <div class="row" style="height: 430px;">
                                            @php
                                                $images = $assets->where('type', 'image')->all();
                                            @endphp
                                            @foreach ($images as $image)
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
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
                                <div class="card assets-wrapper video" style="width: 100%;padding: 0.25rem; display: none">
                                    <div class="card-body" style="color: #555; font-size: 14px;">
                                        <div class="row" style="height: 430px;">
                                            @php
                                                $videos = $assets->where('type', 'video')->all();
                                            @endphp
                                            @foreach ($videos as $video)
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12">
                                                @if ($video->source == 'local')
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
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
                                                        <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
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
                                        <div class="row" style="height: 430px;">
                                            @php
                                                $audios = $assets->where('type', 'audio')->all();
                                            @endphp
                                            @foreach ($audios as $audio)
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12">
                                                @if ($audio->source == 'local')
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
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
                                                        <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
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
                                        <div class="row" style="height: 430px;">
                                            @php
                                                $models = $assets->where('type', 'model')->all();
                                            @endphp
                                            @foreach ($models as $model)
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
                                                <div class="card object-file-booth">
                                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                        <a href="javascript:void(0);" onclick="openPopupAssetDetail({{$asset->id}})">
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
                                                <p class="text-muted mb-2"> Source: </p>
                                                <p class="text-muted mb-2"> Format: </p>
                                                <p class="text-muted mb-2"> size: </p>
                                                <p class="text-muted mb-2"> Updated at: </p>
                                            </div>
                                            <div class="col-8">
                                                <p class="text-muted mb-2"><span id="popup-asset-detail__name-text" class="ml-2 font-weight-bold"></span> </p>
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
                            <div class="card" style="width: 100% ; padding:20px;">
                                <div class="preview-wrapper" style="width: 100%;">
                                    <img src="" alt="" style="width: 100%; display: none">
                                    <iframe src="" style="display: none" width="100%" height="400px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <video src="" alt="" controls style="width: 100%;display: none" controls>
                                    <audio src="" alt="" controls style="width: 100%;display: none">
                                    <model-viewer src="" style="width: 100%; height: 100%; display: none" shadow-intensity="1" camera-controls></model-viewer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP UPLOAD ASSETS --}}
    <div class="modal fade" id="popup-upload-assets" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Upload multiple assets</h5>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <div class="input-wrapper form_upload">
                        <input id="popup-upload-assets__file-hidden-input" type="file" name="file" hidden multiple accept="image/*,video/*,audio/*,.glb">
                        <button type="button" id="popup-upload-assets__upload-btn" onclick="$('#popup-upload-assets__file-hidden-input').trigger('click')" class="btn"><i class="fas fa-upload" style="font-size: 50px;"></i></button>
                        <p>Drop your file here or Click to browse</p>
                        <div class="invalid-feedback">
                            Please choose a file.
                        </div>
                    </div>
                    <div class="progress-wrapper">
                        <div class="progress">
                            <div class="progress-value progress-bar progress-bar-striped progress-animations" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="result"></div>
                        <div class="errors">
                            <span>Errors: </span>
                            <ul>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="popup-upload-assets__OK-btn" class="btn btn-primary btn-block" data-dismiss="modal" aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP ADD NEW OBJECT --}}
    <div class="modal fade" id="popup-add-new-object" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Object</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <div class="modal-body" style="flex: 0 1 0%;">
                            <nav class="nav_profile">
                                <a href="javascript:void(0)" class="active" id="switch-local-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline">Upload Local</div>
                                </a>
                                <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                    <div class="d-block d-sm-inline">Upload Link</div>
                                </a>
                            </nav>
                        </div>
                        <div>
                            <form class="form-step1 object__upload-box needs-validation" action="/administrator/tours/{{$tour->id}}/objects/save-create" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input id="popup-add-new-object__source-hidden-input" class="form-control" type="hidden" name="source" value="local">
                                <div class="mb-3">
                                    <label class="small mb-1" for="">Type</label>
                                    <select class="form-control" id="popup-add-new-object__local-type-select" name="type">
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                        <option value="audio">Audio</option>
                                        <option value="model">Model</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="form_upload">
                                        <input  id="popup-add-new-object__local-file-hidden-input" type="file" name="file" hidden required>
                                        <button type="button" id="popup-add-new-object__local-upload-btn" class="btn"><i class="fas fa-upload" style="font-size: 50px;"></i></button>
                                        <p>Drop your file here or Click to browse</p>
                                        <div class="invalid-feedback">
                                            Please choose a file.
                                        </div>
                                    </div>
                                    <div class="form_preview" style="display: none;">
                                        <img id="popup-add-new-object__local-preview-img" class="preview-wrapper" src="" style="border-radius: 5px; display: none" >
                                        <video id="popup-add-new-object__local-preview-video" class="preview-wrapper"  controls src="" style="border-radius: 5px; display: none" ></video>
                                        <audio id="popup-add-new-object__local-preview-audio" class="preview-wrapper"  controls src="" style="border-radius: 5px; display: none"></audio>
                                        <model-viewer id="popup-add-new-object__local-preview-model" class="preview-wrapper"   src="" ar ar-modes="webxr scene-viewer quick-look" environment-image="neutral" auto-rotate camera-controls style="border-radius: 5px; display: none"></model-viewer>
                                        <div id="popup-add-new-object__local-preview-document" class="preview-wrapper"  style="border-radius: 5px; display: none ;color: #2B5796; text-align: center; font-size: 150px;" ><i class="fas fa-file-alt"></i></div>
                                        <div class="remove_item_object">
                                            <div id="popup-add-new-object__local-remove-btn" class="btn_remove ">Remove</div>
                                        </div>
                                    </div>
                                    
                                    
                                </div> 
                                <div class="mb-3">
                                    <label class="small mb-1" for="">Name</label>
                                    <input class="form-control" id="popup-add-new-object__local-name-input" type="text" name="name" placeholder="Enter Name File" required>
                                    <div class="invalid-feedback">
                                        Please enter object's name.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="">Description</label>
                                    <textarea class="form-control" id="popup-add-new-object__local-description-input" name="description" rows="4" placeholder="Write a short description"></textarea>
                                </div>
                                
                                <div class="modal-footer"  style="padding: 0.85rem 0px;">
                                    <button type="submit" id="popup-add-new-object__local-save-btn" class="btn btn-primary btn-block">Save Upload</button>
                                </div>
                            </form>
                            <form class="form-step2 object__upload-box needs-validation" action="/administrator/tours/{{$tour->id}}/objects/save-create" method="POST"  style="display: none" novalidate>
                                @csrf
                                <input type="hidden" name="source" value="link">
                                <div class="mb-3">
                                    <label class="small mb-1" for="">Type</label>
                                    <select class="form-control" id="popup-add-new-object__link-type-input" name="type">
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                        <option value="audio">Audio</option>
                                        <option value="model">Model</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="form_upload">
                                        <input id="popup-add-new-object__link-url-input" class="form-control" name="url" type="text" placeholder="e.g. https://www.image.com/watch?v=9bZkp7q19f0" required>
                                        <div class="invalid-feedback" style="text-align: left;">
                                            Please enter url link of object.
                                        </div>
                                    </div>
                                    <div class="form_preview" style="display: none;">
                                        <img id="popup-add-new-object__link-preview-img" class="preview-wrapper" src="" style="border-radius: 5px; display: none" >
                                        <video id="popup-add-new-object__link-preview-video" class="preview-wrapper" controls src="" style="border-radius: 5px; display: none" ></video> 
                                        <iframe id="popup-add-new-object__link-preview-video-ytb" class="preview-wrapper" style="display: none" width="100%" height="400px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <audio id="popup-add-new-object__link-preview-audio" class="preview-wrapper" controls src="" style="border-radius: 5px; display: none"></audio>
                                        <model-viewer id="popup-add-new-object__link-preview-model" class="preview-wrapper" src="" ar ar-modes="webxr scene-viewer quick-look" environment-image="neutral" auto-rotate camera-controls style="border-radius: 5px; display: none"></model-viewer>
                                        <div id="popup-add-new-object__link-preview-document" class="preview-wrapper" style="border-radius: 5px; display: none ;color: #2B5796; text-align: center; font-size: 150px;" ><i class="fas fa-file-alt"></i></div>
                                        <div class="remove_item_object">
                                            <div id="popup-add-new-object__link-remove-btn" class="btn_remove ">Remove</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="">Name</label>
                                    <input class="form-control form-control-user" name="name" id="popup-add-new-object__link-name-input" type="text" placeholder="Enter object's name" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please enter object's name.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="">Description</label>
                                    <textarea class="form-control" name="description" id="popup-add-new-object__link-description-input" rows="4" placeholder="Write a description"></textarea>
                                </div>
                                <div class="modal-footer" style="padding: 0.85rem 0px;">
                                    <button type="submit" id="popup-add-new-object__link-save-btn" class="btn btn-primary btn-block btn-icon-loader"> <span class="icon-loader-form"></span>  Save Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-bottom')
    <script>
        var assets = {!! json_encode($assets) !!}

        $('.datatable').DataTable();
        $('#popup-asset-detail').on('hidden.bs.modal', function () {  
            closePopupAssetDetail();
        })

        $('#popup-upload-assets__file-hidden-input').change(async function () {  
            let files = $(this).prop('files');
            let count = files.length;
            let success = 0;
            let complete = 0;

            $('#popup-upload-assets').find('.errors').find('ul').empty();
            $('#popup-upload-assets').find('.input-wrapper').hide();
            $('#popup-upload-assets').find('.progress-wrapper').show();

            for (let i = 0; i < files.length; i++) {
                $('#popup-upload-assets').attr('data-uploading', 1);
                const file = files[i];
                let type;
                if(file.type.includes('/')){
                    type = file.type.split('/')[0];
                }
                else if(file.name.split('.').pop() == 'glb'){
                    type = 'model';
                }
               
                try {
                    await ajaxCreateAsset(type, 'local', file, null)
                    .done(function () { 
                        success++; 
                    })
                    .fail(function (xhd, status) {  
                        let li = $(`<li> <span>`+ file.name +`</span><span> upload failed !</span></li>`);
                        $('#popup-upload-assets').find('.errors').find('ul').append(li);
                        $('#popup-upload-assets').find('.errors').show();
                    })
                    .always(function () {  
                        complete++;
                        $('#popup-upload-assets').find('.progress-value').attr('style', 'width: '+(complete * 100/count)+'% !important');
                    })
                } catch (error) {
                    
                } 
            };

            $('#popup-upload-assets').find('.result').show();
            $('#popup-upload-assets').find('.result').text(success + "/" + count + ' files uploaded successfull.');
            $('#popup-upload-assets__OK-btn').show();
        });

        $('.tab-btn').click(function (e) { 
            $('.tab-btn').removeClass('active');
            $(this).addClass('active');
            $('.tab-body').hide();
            let tab = $(this).attr('data-tab');
            $('.tab-body[data-tab="'+tab+'"]').show();
        });

        function ajaxCreateAsset(type, source , file, url){
            let data = new FormData();
            if(type) data.append('type', type);
            if(source) data.append('source', source);
            if(file) data.append('file', file);
            if(url) data.append('url', url);
          
            let ajax = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "/administrator/tours/{{$tour->id}}/objects/save-create-asset",
                data: data,
                processData: false,
                contentType: false,
                dataType: 'json'
            });
            return ajax;
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

        function openPopupUploadAssets() {  
            $('#popup-upload-assets').find('.result').hide();
            $('#popup-upload-assets__OK-btn').hide();
            $('#popup-upload-assets').find('.input-wrapper').show();
            $('#popup-upload-assets').find('.progress-wrapper').hide();
            $('#popup-upload-assets').find('.progress-value').attr('style', 'width: 0% !important');
            $('#popup-upload-assets').find('.errors').hide();
            $('#popup-upload-assets__file-hidden-input').val("");
            $('#popup-upload-assets').modal('show');
        }

        function switchObjectTypeTag(type) {
            $('.assets-wrapper').hide();
            $('.assets-wrapper.' + type).show();
        }

        function convertToMinimizeImageUrl(url){
            if(url != null && url != ""){
                if(url.includes('res.cloudinary.com/virtual-tour/image/upload/')){
                    miniUrl = url.replace('upload/', 'upload/c_thumb,w_350,g_face/');
                    return miniUrl;
                }
            }
            return url;
        }

    </script>
@endsection

