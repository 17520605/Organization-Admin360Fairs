@extends('layouts.partner')

@section('content')
<div class="row  mb-3" >
    <div class="col-md-4">
        <div class="card">
            <div class="card-body" style="color: #555; font-size: 14px;">
                <div class="border shadow-none mb-2 card total_bar_object" style="padding: 0.5rem">
                    <a class="text-body">
                        <div class="body">
                                                        <h4 style="color: #555">Used :1.8 MB  <i class="fa fa-server float-right"></i></h4>
                            <p class="mb-0">Storage <small class="text-muted float-right">of 10MB</small></p>
                            <div class="progress progress-striped" style="width: 100%; padding: 0; height: 20px;background: #bbbbbb77;">
                                                                    <div class="progress-bar progress-bar-success" style="border-radius: 5px; width: 17.5%;">17.5%</div>
                                                            </div>
                        </div>
                    </a>
                </div>
                <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('all')">
                                        <a class="text-body btn-item-object-hover">
                        <div class="p-2">
                            <div class="d-flex">
                                <div class="avatar-xs-icon align-self-center me-2">
                                    <div class="avatar-title rounded bg-transparent text-warning font-size-20"><i class="fas fa-th-list"></i></div>
                                </div>
                                <div class="overflow-hidden me-auto">
                                    <h5 class="font-black-555 text-truncate mb-1">All</h5>
                                    <p class="text-muted text-truncate mb-0">5 Files</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                        <div class="progress-bar bg-warning" data-transitiongoal="17.5" aria-valuenow="17.5" style="width: 17.5%;"></div>
                    </div>
                </div>
                <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('images')">
                                        <a class="text-body btn-item-object-hover">
                        <div class="p-2">
                            <div class="d-flex">
                                <div class="avatar-xs-icon align-self-center me-2">
                                    <div class="avatar-title rounded bg-transparent text-success font-size-20"><i class="fas fa-image"></i></div>
                                </div>
                                <div class="overflow-hidden me-auto">
                                    <h5 class="font-black-555 text-truncate mb-1">Images</h5>
                                    <p class="text-muted text-truncate mb-0">2 Files</p>
                                </div>
                                <div class="ml-2">
                                    <p class="text-muted">1.8 MB</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                        <div class="progress-bar bg-success" data-transitiongoal="102.8" aria-valuenow="102.8" style="width: 102.8%;"></div>
                    </div>
                </div>
                <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('videos')">
                                        <a class="text-body btn-item-object-hover">
                        <div class="p-2">
                            <div class="d-flex">
                                <div class="avatar-xs-icon align-self-center me-2">
                                    <div class="avatar-title rounded bg-transparent text-danger font-size-20"><i class="far fa-play-circle"></i></div>
                                </div>
                                <div class="overflow-hidden me-auto">
                                    <h5 class="font-black-555 text-truncate mb-1">Video</h5>
                                    <p class="text-muted text-truncate mb-0">1 Files</p>
                                </div>
                                <div class="ml-2">
                                    <p class="text-muted">0.0 MB</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                        <div class="progress-bar bg-danger" data-transitiongoal="0.0" aria-valuenow="0.0" style="width: 0.0%;"></div>
                    </div>
                </div>
                <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('audios')">
                                        <a class="text-body btn-item-object-hover">
                        <div class="p-2">
                            <div class="d-flex">
                                <div class="avatar-xs-icon align-self-center me-2">
                                    <div class="avatar-title rounded bg-transparent text-info font-size-20"><i class="fas fa-music"></i></div>
                                </div>
                                <div class="overflow-hidden me-auto">
                                    <h5 class="font-black-555 text-truncate mb-1">Audios</h5>
                                    <p class="text-muted text-truncate mb-0">1 Files</p>
                                </div>
                                <div class="ml-2">
                                    <p class="text-muted">0.0 MB</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                        <div class="progress-bar bg-info" data-transitiongoal="0.0" aria-valuenow="0.0" style="width: 0.0%;"></div>
                    </div>
                </div>
                <div class="card border shadow-none mb-2 btn-set-active-object-type" onclick="switchObjectTypeTag('models')">
                                        <a class="text-body btn-item-object-hover">
                        <div class="p-2">
                            <div class="d-flex">
                                <div class="avatar-xs-icon align-self-center me-2">
                                    <div class="avatar-title rounded bg-transparent text-models font-size-20"><i class="fab fa-unity"></i></div>
                                </div>
                                <div class="overflow-hidden me-auto">
                                    <h5 class="font-black-555  text-truncate mb-1">Model</h5>
                                    <p class="text-muted text-truncate mb-0">1 Files</p>
                                </div>
                                <div class="ml-2">
                                    <p class="text-muted">0.0 MB</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0" style="height: 5px; margin: 0; border-radius: 0px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                        <div class="progress-bar bg-model1" data-transitiongoal="0.0" aria-valuenow="0.0" style="width: 0.0%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card objects-card all-card" style="width: 100%; padding: 0.25rem;">
            <div class="card-header d-flex">
                <div class="overflow-hidden">
                    <h5 class="font-size-15 font-weight-bold text-primary">All</h5>
                    <div class="div_cardheader_btn">
                        <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-add-new-object"><i class="fas fa-plus"></i> Add New </button>
                    </div>
                </div>
            </div>
            <div class="card-body" style="color: #555; font-size: 14px;">
                <div class="row" style="height: 430px;">
                    @foreach ($assets as $asset)
                        @if ($asset->type == 'image')
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
                            <div class="card object-file-booth">
                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                    <a href="javascript:void(0);">
                                        <div class="image">
                                            @if ($asset->url != null || $asset->url !='')
                                                <img src="{{$asset->url}}" alt="img" class="img-fluid">
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
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
                            @if ($asset->source == 'local')
                            <div class="card object-file-booth">
                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                    <a href="javascript:void(0);">
                                        <div class="image">
                                            <img src="" alt="img" class="img-fluid">
                                        </div>
                                        <div class="file-name">
                                            <p class="m-b-5 text-muted">{{$asset->name}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endif
                            @if ($asset->source == 'link')
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
                                            <p class="m-b-5 text-muted">{{$asset->name}}</p>
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
                                    <a href="javascript:void(0);">
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
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
                            <div class="card object-file-booth">
                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                    <a href="javascript:void(0);">
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
        <div class="card objects-card images-card" style="width: 100%;padding: 0.25rem; display: none">
            <div class="card-header d-flex">
                <div class="overflow-hidden">
                    <h5 class="font-size-15 font-weight-bold text-primary">Images</h5>
                    <div class="div_cardheader_btn">
                        <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-add-new-object"><i class="fas fa-plus"></i> Add New </button>
                    </div>
                </div>
            </div>
            <div class="card-body" style="color: #555; font-size: 14px;">
                <div class="row" style="height: 430px;">
                    @php
                        $images = $assets->where('type', 'image')->all();
                    @endphp
                    @foreach ($images as $image)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
                        <div class="card object-file-booth">
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
        <div class="card objects-card videos-card" style="width: 100%;padding: 0.25rem; display: none">
            <div class="card-header d-flex">
                <div class="overflow-hidden">
                    <h5 class="font-size-15 font-weight-bold text-primary">Videos</h5>
                    <div class="div_cardheader_btn">
                        <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-add-new-object"><i class="fas fa-plus"></i> Add New </button>
                    </div>
                </div>
            </div>
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
        <div class="card objects-card audios-card" style="width: 100%; padding: 0.25rem; display: none">
            <div class="card-header d-flex">
                <div class="overflow-hidden">
                    <h5 class="font-size-15 font-weight-bold text-primary">Audios</h5>
                    <div class="div_cardheader_btn">
                        <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-add-new-object"><i class="fas fa-plus"></i> Add New </button>
                    </div>
                </div>
            </div>
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
        <div class="card objects-card models-card" style="width: 100%;padding: 0.25rem; display: none">
            <div class="card-header d-flex">
                <div class="overflow-hidden">
                    <h5 class="font-size-15 font-weight-bold text-primary">Models</h5>
                </div>
                <div class="div_cardheader_btn">
                    <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-add-new-object"><i class="fas fa-plus"></i> Add New </button>
                </div>
            </div>
            <div class="card-body" style="color: #555; font-size: 14px;">
                <div class="row" style="height: 430px;">
                    @php
                        $models = $assets->where('type', 'model')->all();
                    @endphp
                    @foreach ($models as $model)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-sm-12" style="padding: 5px;">
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
                        <form class="form-step1 object__upload-box needs-validation" action="/partner/booths/{{$booth->id}}/booths/save-create" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <input type="hidden" name="boothId" value="{{$booth->id}}">
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
                                <button type="submit" id="popup-add-new-object__local-save-btn" class="btn btn-primary btn-block btn-icon-loader"><span class="icon-loader-form"></span> Save Upload</button>
                            </div>
                        </form>
                        <form class="form-step2 object__upload-box needs-validation" action="/partner/booths/{{$booth->id}}/objects/save-create" method="POST"  style="display: none" novalidate>
                            @csrf
                            <input type="hidden" name="boothId" value="{{$booth->id}}">
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
                                <button type="submit" id="popup-add-new-object__link-save-btn" class="btn btn-primary btn-block btn-icon-loader"><span class="icon-loader-form"></span> Save Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     function switchObjectTypeTag(type) {  
        $('.objects-card').hide();
        $('.' + type + '-card').show();
    }
</script>
{{-- POPUP ADD NEW OBJECT --}}
<script>
    function closePopupCreateObject() { 
        $('popup-create-object__local-type-select').val('image');
        $('popup-create-object__link-type-select').val('image');
        $('#popup-create-object').find('img').attr('src', null);
        $('#popup-create-object').find('input').not('input[name="_token"]').not('input[name="source"]').val(null);
        $('#popup-create-object').find('textarea').val(null);
        $('#popup-create-object').find(".form_upload").show();
        $('#popup-create-object').find(".form_preview").hide();
        $('#popup-create-object').find(".preview-wrapper").hide();
        $('#popup-create-object').find('.nav_profile > a').removeClass('active');
        $(this).addClass('active');
        $('#popup-create-object').find('.form-step1').show();
        $('#popup-create-object').find('.form-step2').hide();
    }

    $(document).ready(function () {
        $('#popup-add-new-object__local-type-select').click(function (e) { 
            let type = $(this).val(); 
            $('#popup-add-new-object__local-file-hidden-input').attr('accept', type + '/*');
        });

        $('#popup-add-new-object__local-upload-btn').click(function (e) {  
            $('#popup-add-new-object__local-file-hidden-input').trigger('click');
        });

        $('#popup-add-new-object').on('hidden.bs.modal', function () {  
            closePopupCreateObject();
        });

        $('#switch-local-btn').click(function (e) { 
            closePopupCreateObject();
            $('#popup-add-new-object').find('.nav_profile > a').removeClass('active');
            $(this).addClass('active');
            $('#popup-add-new-object').find('.form-step1').show();
            $('#popup-add-new-object').find('.form-step2').hide();
        });

        $('#switch-link-btn').click(function (e) { 
            closePopupCreateObject();
            $('#popup-add-new-object').find('.nav_profile > a').removeClass('active');
            $(this).addClass('active');
            $('#popup-add-new-object').find('.form-step2').show();
            $('#popup-add-new-object').find('.form-step1').hide();          
        });

        $('#popup-add-new-object__local-file-hidden-input').change(function () { 
            let type = $('#popup-add-new-object__local-type-select').val();
            let file = this.files[0];
            if(file != null){
                if(type=='image')
                {
                    $('#popup-add-new-object__local-preview-img').show();
                    $('#popup-add-new-object__local-preview-img').attr('src', URL.createObjectURL(this.files[0]));
                }
                else if(type=='video')
                {
                    $('#opup-create-object__local-preview-video').show();
                    $('#popup-add-new-object__local-preview-video').attr('src', URL.createObjectURL(this.files[0]));
                }
                else if(type=='audio')
                {
                    $('#popup-add-new-object__local-preview-audio').show();
                    $('#popup-add-new-object__local-preview-audio').attr('src', URL.createObjectURL(this.files[0]));
                }
                else if(type=='model')
                {
                    $('#popup-add-new-object__local-preview-model').show();
                    $('#popup-add-new-object__local-preview-model').attr('src', URL.createObjectURL(this.files[0]));
                }
            
                $('#popup-add-new-object').find(".form_upload").hide();
                $('#popup-add-new-object').find(".form_preview").show();
                $('#popup-add-new-object__local-name-input').val(file.name.replace(/\.[^/.]+$/, ""));
            }
        });

        $('#popup-add-new-object__local-remove-btn').click(function (e) { 
            $('#popup-add-new-object__local-preview-img').attr('src', null);
            $('#popup-add-new-object__local-preview-video').attr('src', null);
            $('#popup-add-new-object__local-preview-audio').attr('src', null);
            $('#popup-add-new-object').find(".form_upload").show();
            $('#popup-add-new-object').find(".form_preview").hide();
            $('#popup-add-new-object__local-file-hidden-input').val(null);
            $('#popup-add-new-object').find('input[name="url"]').val(null);
        });

        $('#popup-add-new-object__link-url-input').change( async function () { 
            let type = $('#popup-add-new-object__link-type-input').val();
            let url = $(this).val();
            let ext = url.split(/[#?]/)[0].split('.').pop().trim();
            let correct = false;
            if( url.startsWith("https://youtu.be/")){
                $('#popup-add-new-object__link-preview-video-ytb').show();
                if(type =='video')
                {
                    let link_ytb= url.replace("https://youtu.be/", "https://www.youtube.com/embed/");
                    $('#popup-add-new-object__link-preview-video-ytb').attr('src', link_ytb);
                    $('#popup-add-new-object').find('input[name="url"]').val(link_ytb);
                    $('#popup-add-new-object__source-hidden-input').val('youtube');
                    $('#popup-add-new-object').find(".form_upload").hide();
                    $('#popup-add-new-object').find(".form_preview").show();
                    $('#popup-add-new-object__link-remove-btn').show();
                    $('#popup-add-new-object__link-save-btn').prop('disabled', false);
                }
                else{
                    alert("LINK KHONG DUNG");
                    $('#popup-add-new-object__link-save-btn').prop('disabled', true);
                    return;
                }
            }
            else {
                if(ext == null || ext == ""){
                    alert("LINK KHONG DUNG");
                    $('#popup-add-new-object__link-save-btn').prop('disabled', true);
                    return;
                };

                $('#popup-add-new-object__link-preview-video-ytb').hide();
                if(url != null && url != ""){
                    let blob = await fetch(url).then(function(response) {
                        if (response.ok)  correct = true;
                        return response.blob();
                    });
                    if(correct){
                        if(type=='image' && blob.type.split("/")[0] == 'image')
                        {   
                            $('#popup-add-new-object__link-preview-img').show();
                            $('#popup-add-new-object__link-preview-img').attr('src', url );
                        }
                        else if(type=='video' && blob.type.split("/")[0] == 'video')
                        {
                            $('#popup-add-new-object__link-preview-video').show();
                            $('#popup-add-new-object__link-preview-video').attr('src', url);
                        }
                        else if(type=='audio' && blob.type.split("/")[0] == 'audio')
                        {
                            $('#popup-add-new-object__link-preview-audio').show();
                            $('#popup-add-new-object__link-preview-audio').attr('src', url);
                        }
                        else if(type=='model' && blob.type.split("/")[0] == 'model')
                        {
                            $('#popup-add-new-object__link-preview-model').show();
                            $('#popup-add-new-object__link-preview-model').attr('src', url);
                        }
                        else{
                            alert("SAI FORMAT FILE");
                            $('#popup-add-new-object__link-save-btn').prop('disabled', true);
                            return;
                        }
                    }
                    else{
                        alert("LINK KHONG DUNG");
                        $('#popup-add-new-object__link-save-btn').prop('disabled', true);
                        return;
                    }
                    $('#popup-add-new-object').find(".form_upload").hide();
                    $('#popup-add-new-object').find(".form_preview").show();
                    $('#popup-add-new-object__link-remove-btn').show();
                    $('#popup-add-new-object__link-save-btn').prop('disabled', false);
                }
            }
        });

        $('#popup-add-new-object__link-type-input').click(function (e) { 
            let type = $(this).val();
            switch (type) {
                case 'image':
                    $('#popup-add-new-object__link-url-input').attr('placeholder', 'e.g. https://www.image.com/myImage.png');
                    break;
                case 'video':
                    $('#popup-add-new-object__link-url-input').attr('placeholder', 'e.g. https://www.video.com/myVideo.mp4 or https://youtu.be/tqAtreRlWwc');
                    break;
                case 'audio':
                    $('#popup-add-new-object__link-url-input').attr('placeholder', 'e.g. https://www.audio.com/myAudio.mp3');
                    break;
                case 'model':
                    $('#popup-add-new-object__link-url-input').attr('placeholder', 'e.g. https://www.model.com/myModel.glb');
                    break;
                default:
                    break;
            }
        });

        $('#popup-add-new-object__link-remove-btn').click(function (e) { 
            $('#popup-add-new-object__link-preview-img').attr('src', null);
            $('#popup-add-new-object__link-preview-video').attr('src', null);
            $('#popup-add-new-object__link-preview-audio').attr('src', null);
            $('#popup-add-new-object').find(".form_upload").show();
            $('#popup-add-new-object').find(".form_preview").hide();
            $('#popup-add-new-object__link-remove-btn').hide();
            $('#popup-add-new-object__link-file-hidden-input').val(null);
            $('#popup-add-new-object').find('input[name="url"]').val(null);

        });
    });
</script>
@endsection
