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
                                                    <img src="{{$panorama->asset->miniUrl()}}" onclick="onGoToPanorama({{$panorama->id}})" class="slide_track__image panorama-thumbnail__image">
                                                    <span class="span-booth-name" style="font-weight: 600">{{$panorama->name != null ? $panorama->name : ($panorama->asset->name != null ? $panorama->asset->name : 'unnamed')}}</span>
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
                            <a href="{{env('TOOL_URL')}}/login?token={{$user->accessToken}}&url=/editor/{{$tour->id}}?z={{$zone->id}}" class="btn-config-overview ">
                                <i class="fas fa-cog"></i>
                                <span>Go to VR Studio</span>
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
                                            <td><span>{{$object->text != null ? $object->text : 'unnamed'}}</span></td>
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
    </div>
    {{-- POPUP ADD BOOTH TO ZONE--}}
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
    {{-- POPUP OBJECT DETAIL --}}
    <div class="modal fade" id="popup-object-detail" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xls" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light"> <span id="popup-object-detail__name-text" class="text-primary font-weight-bold"></span></h5>
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
        var viewer ;
        var container = document.getElementById('viewer-container');
        var assetViewChart = null;
        var panoramas = {!! json_encode($panoramas) !!};
        
        function initViewer() {
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

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        
        function switchTag (tagName) {  
            $('.objects-wrapper').hide();     
            $('#'+tagName+'-wrapper').show();
        };

        function onGoToPanorama(panoramaId) {  
            let panorama;
            for (const p of panoramas) {
                if(p.id == panoramaId){
                    panorama = p;
                }
            }
            viewer.remove(viewer.panorama);
            let imagePanorama = new PANOLENS.ImagePanorama(panorama.asset.url);
            viewer.add(imagePanorama);
            viewer.setPanorama(imagePanorama);
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
    </script>
    <script>
        $(document).ready(function() {
            initViewer();
        });

        $('#popup-object-detail').on("hidden.bs.modal", function () {
            closePopupObjectDetail();
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