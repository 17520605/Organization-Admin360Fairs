@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 text-gray-800" style="margin: 0px">{{$tour->name}}</h1>
                    <a href="" class="btn btn-df" target="_blank" style="width: 180px; position: absolute ;top: 0.75rem; right: 1rem;"><i class="fas fa-cog"></i> Config Zone</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 1.5rem;">
            <div class="col-md-5">
                <div class="card" style="height: 60vh;">
                    <button class="btn btn-default" style="text-align: center;  font-size: 20px;  position: absolute; right: 0; border-radius: 50%;"><i class="fas fa-pencil-alt" data-toggle="modal" data-target="#popup-update-tour"></i></button>
                    <div class="card-body" style="color: #555; font-size: 14px;">
                        <div class="d-flex">
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="font-size-14 font-weight-bold">ZONES : (<a style="color: #4e73df">7 / 8</a>)</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="font-size-14 font-weight-bold">BOOTHS : (<a style="color: #4e73df">7 / 8</a>)</h6>
                                    </div>
                                </div>
                                <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-building"></i> Name organization :</span> <span>CTTNHH ABCD</span></p>
                                <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-envelope-square"></i> Email organization :</span> <span>ctytnhhabc@gmail.com</span></p>
                                <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-phone-square-alt"></i> Hotline organization :</span> <span>0909909999</span></p>
                                <p class="text-muted"><span style="color: #555;font-weight: 600"><i class="fas fa-map-marked"></i> Address organization :</span> <span>{{$tour->location}}</span></p>
                            </div>
                        </div>
                        <h6 class="font-size-15 font-weight-bold">Project Details :</h6>
                        <div class="text-muted discription_tour_text" style="">
                            {{$tour->description != null ? $tour->description : 'N/A'}}
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div style="padding-left: 1rem;padding-right: 1rem;">
                                <h6 class="font-size-15 font-weight-bold"><i class="fas fa-users"></i> Tour manager :</h6>
                                <a href="javascript:void(0);">
                                    <img src="http://admin.360fairs.com/admin-master/asset/images/undraw_profile.svg" style="width: 50px; height: 50px;margin-left: 5px;" class="rounded-circle img-thumbnail avatar-sm" alt="friend">
                                </a>
                            </div>
                        </div>
                        <div class="task-dates row">
                            <div class="col-6">
                                <div class="mt-4">
                                    <h6 class="font-size-14"><i class="fas fa-calendar-alt" style="color: #4348dfb0;"></i> Start Date : <span>{{$tour->endTime != null ? Carbon\Carbon::parse($tour->startTime)->format('Y-m-d') : 'N/A'}}</span></h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-4">
                                    <h6 class="font-size-14"><i class="fas fa-calendar-alt" style="color: #4348dfb0;"></i> Due Date : <span>{{$tour->endTime != null ? Carbon\Carbon::parse($tour->endTime)->format('Y-m-d') : 'N/A'}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-7">
                <div class="card" style="width: 100%; height: 60vh;padding: 0.25rem;">
                </div>
            </div>
        </div>
            <div class="row" style="margin-bottom: 1.5rem;">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-gray-600">Types :</h6>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" onclick="" >All</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->sum('count')}} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ number_format(floatval($types->sum('size'))/1048576, 1) }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                     <div style="width: 20%; height: 3px; background-color: rgb(0, 168, 0)"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" href="/apps-filemanager">Images</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'image')->first() != null ?$types->where('type', 'image')->first()->count : 0 }} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'image')->first() != null ? number_format(floatval($types->where('type', 'image')->first()->size)/1048576, 1) : 0 }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                    <div style="width: 40%; height: 3px; background-color: rgb(0, 168, 0)"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" href="/apps-filemanager">Videos</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'video')->first() != null ?$types->where('type', 'video')->first()->count : 0 }} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'video')->first() != null ? number_format(floatval($types->where('type', 'video')->first()->size)/1048576, 1) : 0 }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                     <div style="width: 50%; height: 3px; background-color: rgb(0, 168, 0)"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" href="/apps-filemanager">Audio</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'audio')->first() != null ?$types->where('type', 'audio')->first()->count : 0 }} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'audio')->first() != null ? number_format(floatval($types->where('type', 'audio')->first()->size)/1048576, 1) : 0 }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                    <div style="width: 20%; height: 3px; background-color: rgb(0, 168, 0)"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" href="/apps-filemanager">Models</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'model')->first() != null ?$types->where('type', 'model')->first()->count : 0 }} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'model')->first() != null ? number_format(floatval($types->where('type', 'model')->first()->size)/1048576, 1) : 0 }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                     <div style="width: 35%; height: 3px; background-color: rgb(0, 168, 0)"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card_object_zone" >
                        <div class="card-body" >
                            <div class="row">
                                <div class="col-12 title">
                                    <h6 class="text-gray-600 float-left"> Objects </h6>
                                    <button class="btn float-right"><i class="fas fa-plus"></i> Add </button>
                                </div>
                            </div>
                            <div id="all-wrapper" class="objects-wrapper row list_object">
                                @foreach ($objects as $object)
                                    @if ($object->type == 'image')
                                    <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file">
                                                <div class="image">
                                                    <img src="{{$object->url}}"
                                                        alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <a href="" class="m-b-5 text-muted">{{$object->name}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($object->type == 'video')
                                    <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                        <div class="card">
                                            <div class="file">
                                                <div class="icon">
                                                    <i class="fas fa-link text-info"></i>
                                                </div>
                                                <div class="file-name">
                                                    <p class="text-muted">{{$object->name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($object->type == 'audio')
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="file">
                                                <div class="icon">
                                                    <i class="fab fa-soundcloud" style="color: #f46c00"></i>
                                                </div>
                                                <div class="file-name">
                                                    <p class="text-muted">{{$object->name}}</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($object->type == 'model')
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="file">
                                                <div class="image">
                                                    <model-viewer src="{{$object->url}}" ar-status="not-presenting"></model-viewer>
                                                </div>
                                                <div class="file-name">
                                                    <p class="text-muted">{{$object->name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <div id="images-wrapper" class="objects-wrapper row" style="display: none; height: 320px; overflow-y: scroll;">
                                @php
                                    $images =  $objects->where('type', 'image');
                                @endphp
                                @foreach ($images as $image)
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <div class="image">
                                                <img src="{{$image->url}}"
                                                    alt="img" class="img-fluid">
                                            </div>
                                            <div class="file-name">
                                                <a href="" class="m-b-5 text-muted">{{$image->name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div id="videos-wrapper" class="objects-wrapper row" style="display: none; height: 320px; overflow-y: scroll;">
                                @php
                                    $videos =  $objects->where('type', 'video');
                                @endphp
                                @foreach ($videos as $video)
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <div class="icon">
                                                <i class="fas fa-link text-info"></i>
                                            </div>
                                            <div class="file-name">
                                                <p class="text-muted">VIDEO 1</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div id="audios-wrapper" class="objects-wrapper row" style="display: none; height: 320px; overflow-y: scroll;">
                                @php
                                    $audios =  $objects->where('type', 'audio');
                                @endphp
                                @foreach ($audios as $audio)
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="card">
                                        <div class="file">
                                            <div class="icon">
                                                <i class="fab fa-soundcloud"></i>
                                            </div>
                                            <div class="file-name">
                                                <p class="text-muted">{{$audio->name}}</p> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div id="models-wrapper" class="objects-wrapper row" style="display: none; height: 320px; overflow-y: scroll;">
                                @php
                                    $models =  $objects->where('type', 'model');
                                @endphp
                                @foreach ($models as $model)
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="card">
                                        <div class="file">
                                            <div class="image">
                                                <model-viewer src="{{$model->url}}" ar-status="not-presenting"></model-viewer>
                                            </div>
                                            <div class="file-name">
                                                <p class="text-muted">{{$model->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Images</th>
                                        <th>Price</th>
                                        <th>Link Products</th>
                                        <th>Code</th>
                                        <th>Tour</th>
                                        <th style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Brielle Williamson</td>
                                        <td><img class="products-tables" src="./../asset/images/apps-1.jpg" alt=""></td>
                                        <td>150$</td>
                                        <td>
                                            <a href="https://github.com/">https://github.com/</a>
                                        </td>
                                        <td>SALE123</td>
                                        <td>Booth-01</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="#"><i class="fa fa-pen"></i></a>
                                            <a class="btn btn-xs btn-danger" href="#"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Brielle Williamson</td>
                                        <td><img class="products-tables" src="./../asset/images/apps-1.jpg" alt=""></td>
                                        <td>150$</td>
                                        <td><a href="https://github.com/">https://github.com/</a></td>
                                        <td>SALE123</td>
                                        <td>Booth-01</td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="#"><i class="fa fa-pen"></i></a>
                                            <a class="btn btn-xs btn-danger" href="#"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup-update-tour" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light">Update Edit Tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="_token" value="JO619zmf6ICpBudeuzQcIFM2ahSpiqJxxA91JLfe" />
                    <div class="mb-3">
                        <label class="small mb-1">Tour Name</label>
                        <input class="form-control" name="name" type="text" placeholder="Enter email address" />
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Start time</label>
                            <input class="form-control" name="start_at" type="date" />
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">End time</label>
                            <input class="form-control" name="end_at" type="date" />
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                            <label class="small mb-1">Location</label>
                            <input class="form-control" name="location" type="text" placeholder="Enter your location" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1">Tour Description</label>
                        <textarea name="description" placeholder="Enter your tour description" class="form-control" rows="6"></textarea>
                    </div>
                    <!-- Form Group (create account submit)-->
                    <button type="submit" class="btn btn-primary btn-block">Update Edit Tour</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
