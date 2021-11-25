@extends('layouts.partner')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">{{$booth->name}}</h1>
                    <div class="div_cardheader_btn">
                        @if ($booth->isConfirmed === NULL)
                            <button class="mb-0 btn float-right active" ><i class="fas fa-globe"></i> Publish </button>
                        @elseif ($booth->isConfirmed === 0)
                            <button class="mb-0 btn float-right active" style="opacity: 0.6 !important;" disabled><i class="fas fa-globe"></i> Publish</button>
                        @endif
                        <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-edit-booth"><i class="fas fa-pen"></i> Edit</button>
                    </div>
                </div>
            </div>
        </div>
        @if ($booth->isConfirmed === 0)
           <div class="mb-3 text-danger" style="width: 100%; text-align: center ;font-weight: 500">Sorry for the problem, please edit the content accordingly and resubmit the request to the organizers </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-5">
                <div class="card" style="height: 270px">
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="flex-grow-1 overflow-hidden">
                            <h6 class="font-size-15 font-weight-bold">General information : </h6>
                            <p class="text-muted mb-2"><i class="fas fa-building"></i> <a  class="ml-2 font-weight-bold" > <ins style="text-decoration: none"> {{ $booth->owner != null ? ($booth->owner->name != null ? $booth->owner->name : "N/A") : "N/A"}} </ins></a></p>
                            <p class="text-muted mb-2"><i class="fas fa-envelope"></i> <span class="ml-2"> {{ $booth->owner != null ? ($booth->owner->email != null ? $booth->owner->email : "N/A") : "N/A"}} </span></p>
                            <p class="text-muted mb-2"><i class="fas fa-phone-alt"></i> <span class="ml-2"> {{ $booth->owner != null ? ($booth->owner->contact != null ? $booth->owner->contact : "N/A") : "N/A"}}</span></p>
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
                            <div class="upload-form border-dashed" style="height: 165px;line-height: 150px ;font-size: 40px;font-weight: 900;pointer-events: none">
                              NO LOGO
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
        <div class="row mb-3 tags-area">
            <div class="col-md-12">
                <div class="card mb-4" style="max-height: 500px;">
                    <div class="card-header">
                        <span class="h5 font-weight-bold text-primary" style="margin: 0px">Views</span>
                        <div class="div_cardheader_btn">
                            <span class="mb-0 btn float-right"><i class="fas fa-eye"></i> {{ count($views)}} </span>
                            <span class="mb-0 btn float-right tootbar-chart-btn"><i class="fas fa-chart-line"></i></span>
                            <span class="mb-0 btn float-right tootbar-table-btn"><i class="fas fa-list-ul"></i> </span>
                        </div>
                    </div>
                    <div class="card-body tag-wrapper tag-table-wrapper">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="views-table" width="100%" cellspacing="0">
                                <thead>
                                    <tr style="background: #eef2f7;">
                                        <th style="text-align: center;width: 5%;">#</th>
                                        <th >Name</th>
                                        <th style="width: 20%;">Email</th>
                                        <th style="width: 15%;">Contact</th>
                                        <th style="width: 180px;">Visit at</th>
                                    </tr>
                                </thead>
                                <tbody>
                        @php
                            $number = 1;
                        @endphp
                                    @foreach ($views as $view)
                                    <tr class="zone-1">
                                        <td style="text-align: center">{{$number++}}</td>
                                        @if ($view->visitor != null)
                                        <td>{{$view->visitor->name}}</td>
                                        <td>{{$view->visitor->email}}</td>
                                        <td>{{$view->visitor->contact}}</td>
                                        @else
                                        <td>Anonymous</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        @endif
                                        <td>{{$view->visitAt}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body tag-wrapper tag-chart-wrapper" style="display: none; height: 100%; width:100%;">
                        <div id="view-chart-container" style="height: 100%; width:100%;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1.5rem;">
            <div class="col-md-12">
                <div class="card mb-4" style="max-height: 500px;">
                    <div class="card-header">
                        <span class="h5 font-weight-bold text-primary" style="margin: 0px">Interest</span>
                        <div class="div_cardheader_btn">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="interest-table" width="100%" cellspacing="0">
                                <thead>
                                    <tr style="background: #eef2f7;">
                                        <th style="text-align: center;width: 5%;">#</th>
                                        <th style="width: 20%;">Name</th>
                                        <th style="width: 20%;">Email</th>
                                        <th style="width: 12%;">Contact</th>
                                        <th style="width: 170px;">Interest at</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                        @php
                            $number = 1;
                        @endphp
                                    @foreach ($interests as $interest)
                                    <tr class="zone-1">
                                        <td style="text-align: center">{{$number++}}</td>
                                        <td>{{$interest->visitor->name}}</td>
                                        <td>{{$interest->visitor->email}}</td>
                                        <td>{{$interest->visitor->contact}}</td>
                                        <td>{{$interest->datetime}}</td>
                                        <td>{{$interest->message}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body" style="display: none; height: 100%; width:100%;">
                        <div id="interest-chart-container" style="height: 100%; width:100%;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP EDIT BOOTH --}}
    <div class="modal fade" id="popup-edit-booth" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Edit Information</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="border-radius:0 ;">
                    <form id="popup-edit-booth__form" class="p-3" action="/partner/tours/{{$tour->id}}/booths/save-edit" method="post">
                        @csrf
                        <input type="hidden" name="boothId" value="{{$booth->id}}">
                        <input type="hidden" name="logo" value="{{$booth->logo}}">
                        <div class="row mb-3">
                            <label class="small mb-1" for="">Name</label>
                            <input class="form-control" type="text" name="name" value="{{$booth->name}}" placeholder="Enter Booth Name">
                        </div>
                        <div class="row mb-3">
                            <label class="small mb-1" for="">Description</label>
                            <textarea class="form-control" type="text" name="description" placeholder="Enter Description">{{$booth->description}}</textarea>
                        </div>
                        <div class="row mb-3">
                            <label class="small mb-1" for="">Logo</label>
                            <div class="card" style="height: 300px; width: 100%">
                                <div class="upload-box" style="display: {{$booth->logo == null ? 'block' : 'none'}}; height: 300px; width: 100%">
                                    <div class="upload-text text-center" style="height: 300px; width: 100%">
                                        <div class="upload-form border-dashed" style="height: 100%;">
                                            <div class="m-4"> 
                                                <input type="file" hidden id="popup-edit-booth__file-input">
                                                <button type="button" id="popup-edit-booth__upload-logo-btn">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-box" style="display: {{$booth->logo == null ? 'none' : 'block'}}; height: 300px; width: 100%; padding:1rem;">
                                    <div class="upload-text text-center">
                                        <img id="popup-edit-booth__preview-logo-img" src="{{$booth->logo}}" style="height: 100%; width:100%" alt="">
                                    </div>
                                    <div class="m-4">
                                        <button type="button" id="popup-edit-booth__remove-btn">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="popup-edit-booth__save-btn" class="btn btn-primary btn-block btn-icon-loader" form="popup-edit-booth__form" type="submit"><span class="icon-loader-form"></span> Save Change</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <script>
        var viewer;
        var container = document.getElementById('viewer-container');
        var views = [
            @for($i = 0; $i < count($views); $i++)
                @if ($views[$i]->visitor != null)
                {   
                    id: '{{$views[$i]->id}}' ,
                    name: '{{$views[$i]->visitor->name}}',
                    email: '{{$views[$i]->visitor->email}}',
                    contact: '{{$views[$i]->visitor->contact}}',
                    visitAt: '{{$views[$i]->visitAt}}'
                }
                @else
                {   
                    id: '{{$views[$i]->id}}',
                    name: 'Anonymous',
                    email: 'N/A',
                    contact: 'N/A',
                    visitAt: '{{$views[$i]->visitAt}}'
                }
                @endif
                @if ($i < count($views) - 1 ) , @endif
            @endfor
        ]

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

        function initViewChart() { 
            
            let data = [];
            let count = 0;
            views.forEach(view => {
                count ++;
                data.push({
                    x: new Date(view.visitAt).getTime(),
                    y: count
                })
            });

            var options = {
                series:[{
                    name: 'view',
                    data: data
                }],
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
                    curve: 'smooth'
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
                        text: 'View count'
                    },
                },
                xaxis: {
                    type: 'datetime',
                    title: {
                        text: 'Datetime'
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
            initViewChart();

            // $('.table').DataTable({
            //     "searching": false
            // });

            $('.tootbar-chart-btn').click(function (e) { 
                $(this).parents('.tags-area').find('.tag-wrapper').hide();
                $(this).parents('.tags-area').find('.tag-chart-wrapper').show();
            });

            $('.tootbar-table-btn').click(function (e) { 
                $(this).parents('.tags-area').find('.tag-wrapper').hide();
                $(this).parents('.tags-area').find('.tag-table-wrapper').show();
            });

            $('#popup-edit-booth__upload-logo-btn').click(function () { $('#popup-edit-booth__file-input').trigger('click')});

            $('#popup-edit-booth__file-input').change(function () {  
                let file = this.files[0];
                $('#popup-edit-booth__save-btn').prop('disabled', true);
                if(file != null){
                    $('#popup-edit-booth__preview-logo-img').attr('src', URL.createObjectURL(file));
                    $('#popup-edit-booth').find('.upload-box').hide();
                    $('#popup-edit-booth').find('.preview-box').show();

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
                                $('#popup-edit-booth').find('input[type="hidden"][name="logo"]').val(res.url);
                                $('#popup-edit-booth__save-btn').prop('disabled', false);
                            }
                        }
                    });
                }
            })

            $('#popup-edit-booth__remove-btn').click(function(){
                $('#popup-edit-booth').find('.upload-box').show();
                $('#popup-edit-booth').find('.preview-box').hide();
                $('#popup-edit-booth').find('input[type="hidden"][name="logo"]').val(null);
            });
        });
    </script>

@endsection
