@extends('layouts.partner')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">{{$booth->name}}</h1>
                    <div class="div_cardheader_btn">
                        <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#"><i class="fas fa-globe"></i> Publish </button>
                        <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-edit-tour"><i class="fas fa-pen"></i> Edit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-5">
                <div class="card" style="height: 270px">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="font-size-15 font-weight-bold">General information: </h6>
                            <p class="text-muted"><i class="fas fa-building"></i> <a  class="ml-3"> <ins> {{$booth->owner->name != null ? $booth->owner->name : "N/A"}} </ins></a></p>
                            <p class="text-muted"><i class="fas fa-envelope"></i> <span class="ml-3"> {{$booth->owner->email != null ? $booth->owner->email : "N/A"}} </span></p>
                            <p class="text-muted"><i class="fas fa-phone-alt"></i> <span class="ml-3"> {{$booth->owner->contact != null ? $booth->owner->contact : "N/A"}}</span></p>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="text-muted discription_tour_text" style="max-height: 105px">
                                Paragraph development begins with the formulation of the controlling idea. This idea directs the paragraph’s development. Often, the controlling idea of a paragraph will appear in the form of a topic sentence. In some cases, you may need more than one
                                sentence to express a paragraph’s controlling idea.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="upload-box" style="display: block; max-height: 200px; height: 200px">
                        <div class="upload-text text-center">
                            <div class="upload-form border-dashed" style="height: 165px;">
                                <div class="m-4">
                                    <h4 style="font-weight: 900;">LOGO</h4>
                                    <button type="button" id="add_image_upload" class="btn btn-outline-primary"> <i class="fas fa-upload " style="margin-right: 8px; "></i>
                                        Upload Logo
                                    </button>
                                    <input type="file" id="" style="display: none" accept="video/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none; max-height: 200px; height: 200px; padding:1rem;">
                        <div class="upload-text text-center">
                            <div class="upload-form border-dashed" style="height: 165px;">
                                <div class="m-4">
                                    <img style="height: 100%;" src="https://lh3.googleusercontent.com/proxy/6tMLql0HIGOwuQ0M1OdfwR8kbq3u5T_CFZ10gRKhOyxk7y78OrchCy4PfmMlB3OUVknpMaiEFpslFne1ndzTlMJtkOFD8lHZ7ocnmxnQdUBcGjNAzLSxGQtyyP99qdNv" alt="">
                                </div>
                            </div>
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
                <div class="card mt-3" style="width: 100%; height: 105px; padding:12px 8px;">
                    <div id="container">
                        <div class="tour__bottom-bar-slider-outer" id="booth-track">
                            <div class="tour__bottom-bar-slider" style="width: 100%; position: relative;">
                                {{-- <i class="fas fa-angle-left" id="left-button-scroll"></i> --}}
                                <div id="slider-track" class="tour__bottom-bar-slider-track" style=" overflow-x: hidden; height: 100%; display: flex;">
                                    <div class="slide_track panorama-item panorama-slide-item" data-panorama-id="436" style="margin: 0 5px">
                                        <div style="width: 135px; height: 80px;">
                                            <img src="https://res.cloudinary.com/virtual-tour/image/upload/c_thumb,w_350,g_face/v1632648128/fkawozf7qkaif1vadqfy.jpg" onclick="onGoToPanorama(436)" data-panorama-id="436" class="slide_track__image panorama-thumbnail__image">
                                            <span class="span-booth-name">view 15-min</span>
                                        </div>
                                    </div>
                                    <div class="slide_track panorama-item panorama-slide-item" data-panorama-id="436" style="margin: 0 5px">
                                        <div style="width: 135px; height: 80px;">
                                            <img src="https://res.cloudinary.com/virtual-tour/image/upload/c_thumb,w_350,g_face/v1632648128/fkawozf7qkaif1vadqfy.jpg" onclick="onGoToPanorama(436)" data-panorama-id="436" class="slide_track__image panorama-thumbnail__image">
                                            <span class="span-booth-name">view 15-min</span>
                                        </div>
                                    </div>
                                    <div class="slide_track panorama-item panorama-slide-item" data-panorama-id="436" style="margin: 0 5px">
                                        <div style="width: 135px; height: 80px;">
                                            <img src="https://res.cloudinary.com/virtual-tour/image/upload/c_thumb,w_350,g_face/v1632648128/fkawozf7qkaif1vadqfy.jpg" onclick="onGoToPanorama(436)" data-panorama-id="436" class="slide_track__image panorama-thumbnail__image">
                                            <span class="span-booth-name">view 15-min</span>
                                        </div>
                                    </div>
                                    <div class="slide_track panorama-item panorama-slide-item" data-panorama-id="436" style="margin: 0 5px">
                                        <div style="width: 135px; height: 80px;">
                                            <img src="https://res.cloudinary.com/virtual-tour/image/upload/c_thumb,w_350,g_face/v1632648128/fkawozf7qkaif1vadqfy.jpg" onclick="onGoToPanorama(436)" data-panorama-id="436" class="slide_track__image panorama-thumbnail__image">
                                            <span class="span-booth-name">view 15-min</span>
                                        </div>
                                    </div>
                                    <div class="slide_track panorama-item panorama-slide-item" data-panorama-id="436" style="margin: 0 5px">
                                        <div style="width: 135px; height: 80px;">
                                            <img src="https://res.cloudinary.com/virtual-tour/image/upload/c_thumb,w_350,g_face/v1632648128/fkawozf7qkaif1vadqfy.jpg" onclick="onGoToPanorama(436)" data-panorama-id="436" class="slide_track__image panorama-thumbnail__image">
                                            <span class="span-booth-name">view 15-min</span>
                                        </div>
                                    </div>
                                    <div class="slide_track panorama-item panorama-slide-item" data-panorama-id="436" style="margin: 0 5px">
                                        <div style="width: 135px; height: 80px;">
                                            <img src="https://res.cloudinary.com/virtual-tour/image/upload/c_thumb,w_350,g_face/v1632648128/fkawozf7qkaif1vadqfy.jpg" onclick="onGoToPanorama(436)" data-panorama-id="436" class="slide_track__image panorama-thumbnail__image">
                                            <span class="span-booth-name">view 15-min</span>
                                        </div>
                                    </div>
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
                        <div class="border shadow-none mb-2 card total_bar_object" style="padding: 0.5rem">
                            <a class="text-body" href="#">
                                <div class="body">
                                    <h4>1024 MB <i class="fa fa-server float-right"></i></h4>
                                    <p class="mb-0">Storage <small class="text-muted float-right">of 1024MB</small></p>
                                    <div class="progress progress-striped" style="width: 100%; padding: 0; height: 20px;background: #bbbbbb77;">
                                        <div class="progress-bar progress-bar-warning" data-transitiongoal="43" aria-valuenow="43" style="width: 43%;">43%</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card border shadow-none mb-2">
                            <a class="text-body" href="/administrator/tours/{{$tour->id}}/objects/models">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center me-2">
                                            <div class="avatar-title rounded bg-transparent text-models font-size-20"><i class="fab fa-unity"></i></div>
                                        </div>
                                        <div class="overflow-hidden me-auto">
                                            <h5 class="font-size-13 text-truncate mb-1">All</h5>
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
                                            <h5 class="font-size-13 text-truncate mb-1">Audios</h5>
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
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card" style="width: 100%; height: 647px;padding: 0.25rem;">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="overflow-hidden">
                                <h5 class="font-size-15 font-weight-bold text-primary">Objects</h5>
                            </div>
                        </div>
                        <div class="row" style="height: 570px; overflow-y: scroll;">
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                <div class="card">
                                    <div class="file">
                                        <a href="javascript:void(0);">
                                            <div class="image">
                                                <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg" alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
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
@endsection
