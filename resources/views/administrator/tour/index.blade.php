@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">{{$tour->name}}</h1>
                    <div class="div_cardheader_btn">
                        <button class="mb-0 btn float-right active btn-icon-loader" style="padding: 5px 28px 5px 40px;"><span class="icon-loader-form" style="margin-left: -30px;" ></span><i class="fas fa-globe"></i> Publish </button>
                        <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-edit-tour"><i class="fas fa-pen"></i> Edit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-header mb-3 webinar-tab" style="width: 100%; height: 40px; mb-2 ">
            <span class="btn-tab-2 tab-header-btn btn btn-primary float-left"><i class="fas fa-eye"></i></span>
            <span class="btn-tab-1 tab-header-btn btn btn-primary float-left active" ><i class="fas fa-stream"></i></span>
            <span class="btn-tab-3 tab-header-btn btn btn-primary float-left"><i class="far fa-dot-circle"></i></span>
        </div>
        <div class="div-tab-1">
            <div class="row" style="margin-bottom: 1.5rem;">
                <div class="col-md-5" style="height: 70vh;">
                    <div class="card">
                        <div class="card-body" style="color: #555; font-size: 14px;">
                            {{-- <div class="d-flex process-overview">
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
                            </div> --}}
                            <h6 class="font-size-15 font-weight-bold">General information: </h6>
                            <div class="d-flex">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-building mr-3"></i></span> <span> {{$profile->name != null ? $profile->name : "N/A" }} </span></p>
                                    <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-phone-alt mr-3"></i></span> <span> {{$profile->contact != null ? $profile->contact : "N/A" }} </span></p>
                                    <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-map-marker-alt mr-3"></i></span> <span>{{$tour->location != null ? $tour->location : "N/A" }}</span></p>
                                </div>
                            </div>
                            <h6 class="font-size-15 font-weight-bold">Description: </h6>
                            <div class="text-muted discription_tour_text" style="height: 210px">
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
                                                        <span class="span-booth-name" style="font-weight: 600">{{$panorama->name  != null ? $panorama->name : 'N/A'}}</span>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Zones</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
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
                    <div class="card mb-4">
                        <div class="card-header">
                            <span class="h6 font-weight-bold text-primary" style="margin: 0px">Views & Likes</span>
                            <div class="div_cardheader_btn">
                                <span class="mb-0 btn float-right"><i class="fas fa-thumbs-up"></i> <span id="views__like-count"></span> </span>
                                <span class="mb-0 btn float-right"><i class="fas fa-eye"></i> <span id="views__view-count"></span> </span>
                                <span class="mb-0 btn float-right"><i class="fas fa-user-friends"></i> <span id="views__visitor-count"></span> </span>
                            </div>
                        </div> 
                        <div class="card-body" style="height: 100%; width:100%;">
                            <div id="view-chart-container" style="height: 100%; width:100%;"></div>
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
                                            <th style="width: 10%;">Datetime</th>
                                            <th>Comment</th>
                                            <th style="width: 5%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $number = 1;
                                        @endphp
                                        @foreach ($comments as $comment)
                                            @if ($comment->isHidden == false)
                                                <tr data-comment-id="{{$comment->id}}">
                                                    <td style="text-align: center">{{$number++}}</td>
                                                    <td> <span>{{$comment->visitor->name}}</span></td>
                                                    <td> <span>{{$comment->updated_at}}</span></td>
                                                    <td> <span class="span_comment_height">{{$comment->text}}</span></td>
                                                    <td class="actions btn-action-icon"><i class="fas fa-trash-alt delete" data-comment-id="{{$comment->id}}" onclick="hideComment(event)"></i></td>
                                                </tr>
                                            @else 
                                                <tr data-comment-id="{{$comment->id}}">
                                                    <td style="text-align: center">{{$number++}}</td>
                                                    <td> <span style="opacity: 0.3"> {{$comment->visitor->name}}</span></td>
                                                    <td> <span style="opacity: 0.3"> {{$comment->created_at}}</span> </td>
                                                    <td><span class="span_comment_height" style="opacity: 0.3">{{$comment->text}}</span></td>
                                                    <td class="actions btn-action-icon"><i class="fas fa-eye view" data-comment-id="{{$comment->id}}" onclick="showComment(event)"></i></td>
                                                </tr>   
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                                        @foreach ($hotspots as $hotspot)
                                        <tr>
                                            <td style="text-align: center">
                                                @if ($hotspot->type == 'image')
                                                   <span><i class="fas fa-image font-size-16 text-success"></i> <span style="display: none">1</span> </span> 
                                                @elseif($hotspot->type == 'video')
                                                    <span><i class="far fa-play-circle font-size-16 text-danger"></i> <span style="display: none">2</span> </span> 
                                                @elseif($hotspot->type == 'audio')
                                                    <span><i class="fas fa-music font-size-16 text-info"></i><span style="display: none">3</span></span> 
                                                @elseif($hotspot->type == 'model')
                                                    <span><i class="fab fa-unity font-size-16 text-models"></i><span style="display: none">4</span></span> 
                                                @else 
                                                    <span><i class="fab fa-question-circle font-size-16 text-primary"></i><span style="display: none">5</span></span>
                                                @endif
                                            </td>    
                                            <td><span>{{$hotspot->text}}</span></td>
                                            <td><span>{{$hotspot->viewCount}}</span></td>
                                            <td><span>{{$hotspot->likeCount}}</span></td>
                                            <td><span>{{$hotspot->commentCount}}</span></td>
                                            <td class="actions"> <button class="btn-visit-now" onclick="openPopupObjectDetail({{$hotspot->asset->id}})">View Detail</button> </td>
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
                                <input class="form-control" name="end" value="{{ Carbon\Carbon::parse($tour->endTime)->format('Y-m-d\TH:i')}}" type="datetime-local" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-12">
                                <label class="small mb-1" for="">Banner Tour</label>
                                <div class="card" style="width: 100%">
                                    <div class="upload-box" style="display: {{$tour->image == null ? 'block' : 'none'}}; width: 100%">
                                        <div class="upload-text text-center" style="width: 100%">
                                            <div class="upload-form border-dashed" style="height: 100%;">
                                                <div class="m-4"> 
                                                    <input type="hidden"name="image" value="">
                                                    <input type="file"  hidden id="popup-edit-tour__file-input">
                                                    <button type="button" class="btn btn-primary" id="popup-edit-tour__upload-img-btn"><i class="fas fa-upload"></i> Upload Banner</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-box" style="display: {{$tour->image == null ? 'none' : 'block'}};width: 100%; padding:1rem;">
                                        <div class="upload-text text-center">
                                            <img id="popup-edit-tour__preview-img" src="{{$tour->image}}" style="height: 100%;height: 400px; width:100%" alt="">
                                        </div>
                                        <div class="m-4" style="display: flex;justify-content: center;align-items: center;position: absolute;width: 90%;height: 400px;top: 0;">
                                            <button type="button" class="btn btn-danger" id="popup-edit-tour__remove-btn">Remove</button>
                                        </div>
                                    </div>
                                </div>
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
                        <button id="popup-edit-tour__save-btn" type="submit" class="btn btn-primary btn-block btn-icon-loader">  <span class="icon-loader-form"></span> Update Edit Tour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- POPUP OBJECT DETAIL --}}
    <div class="modal fade" id="popup-object-detail" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xls" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light"> Details <span id="popup-object-detail__name-text" class="text-primary font-weight-bold"></span></h5>
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

<script>
    $('#popup-edit-tour__upload-img-btn').click(function () { $('#popup-edit-tour__file-input').trigger('click')});

    $('#popup-edit-tour__file-input').change(function () {  
        let file = this.files[0];
        $('#popup-edit-tour__save-btn').prop('disabled', true);
        if(file != null){
            $('#popup-edit-tour__preview-img').attr('src', URL.createObjectURL(file));
            $('#popup-edit-tour').find('.upload-box').hide();
            $('#popup-edit-tour').find('.preview-box').show();

            let data = new FormData();
            data.append('file', file);
            let ajax = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{env('APP_URL')}}/storage/upload",
                method: 'post',
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                success: function (res) { 
                    if (res != null) {
                        $('#popup-edit-tour').find('input[type="hidden"][name="image"]').val(res.url);
                        $('#popup-edit-tour__save-btn').prop('disabled', false);
                    }
                }
            });
        }
    })

    $('#popup-edit-tour__remove-btn').click(function(){
        $('#popup-edit-tour').find('.upload-box').show();
        $('#popup-edit-tour').find('.preview-box').hide();
        $('#popup-edit-tour').find('input[type="hidden"][name="image"]').val(null);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var viewer;
    var container = document.getElementById('viewer-container');
    var assetViewChart = null;
    var views = {!! json_encode($views) !!};
    var likes = {!! json_encode($likes) !!};

</script>
<script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
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

    function hideComment(e) {
        let commentId = $(e.currentTarget).attr("data-comment-id");
        let row = $(e.currentTarget).parents('tr');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/administrator/tours/{{$tour->id}}/comments/hide-comment",
            data: {
                commentId : commentId
            },
            success: function (res) {  
                if(res == true || res == '1'){
                    row.find('td').not('.actions').find('span').css('opacity', 0.3);
                    row.find('.actions').html('<i class="fas fa-eye view" data-comment-id="'+ commentId +'" onclick="showComment(event)"></i>');
                }
            }
        });
    }

    function showComment(e) {
        let commentId = $(e.currentTarget).attr("data-comment-id");
        let row = $(e.currentTarget).parents('tr');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/administrator/tours/{{$tour->id}}/comments/show-comment",
            data: {
                commentId : commentId
            },
            success: function (res) {  
                if(res == true || res == '1'){
                    row.find('td').not('.actions').find('span').css('opacity', 1);
                    row.find('.actions').html('<i class="fas fa-trash-alt delete" data-comment-id="'+ commentId +'" onclick="hideComment(event)"></i>');
                }
            }
        });
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

            $('#popup-object-detail__name-text').text(asset.name || 'unnamed');

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

    function convertToMinimizeImageUrl(url){
        if(url != null && url != ""){
            if(url.includes('res.cloudinary.com/virtual-tour/image/upload/')){
                miniUrl = url.replace('upload/', 'upload/c_thumb,w_350,g_face/');
                return miniUrl;
            }
        }
        return url;
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

    function initViewChart() {      
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

        $('#views__view-count').text(countView);
        $('#views__visitor-count').text(visiterIds.length);
        $('#views__like-count').text(countLike);

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
</script>
<script>
    $(document).ready(function() {
        initViewer();
        $('#comment-table').DataTable();
        $('#interest-table').DataTable();
    });
</script>

<script>
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
</script>

@endsection
