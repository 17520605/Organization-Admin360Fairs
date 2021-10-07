@extends('layouts.master')

@section('content')
    <div class="container-fluid gallery">
        <div class="container-fluid gallery-ds">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Model 3D  <button  class="btn btn-df" onclick="openPopupCreateObject('model')" style="position: absolute; right: 1.5rem;"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new file</button></h1>
            <div class="row clearfix">
                @if (count($models) == 0)
                    <div style=" text-align: center; width: 100%; padding: 30vh 0px; ">
                        There are currently no Model 3D !
                    </div>
                @endif
                    @foreach ($models as $model)
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="file">
                                <a href="javascript:void(0);">
                                    <div class="hover">
                                        <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                                    </div>
                                    <div class="image">
                                        <model-viewer src="{{$model->url}}"></model-viewer>
                                    </div>
                                    <div class="file-name">
                                        <p class="text-muted">{{$model->name != null ? $model->name : "n/a"}}</p>
                                        <small>
                                            <span class="mb-2 float-left" style="color: #007bff !importan;">Size: {{ number_format(floatval($model->size)/1048576, 1) }} MB</span>
                                            <span class="ml-3 float-left text-muted" style="text-transform: uppercase;">{{ $model->format }}</span>
                                            <span class="mb-2 float-right text-muted">{{Carbon\Carbon::parse($model->updatedAt)->format('M d Y')}}</span>
                                        </small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
