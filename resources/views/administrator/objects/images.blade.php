@extends('layouts.master')

@section('content')
    <div class="container-fluid gallery">
        <div class="container-fluid gallery-ds">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Images  <button  class="btn btn-df" onclick="openPopupCreateObject('image')" style="position: absolute; right: 1.5rem;"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new file</button></h1>
            <div class="row clearfix">
                @if (count($images) == 0)
                    <div style=" text-align: center; width: 100%; padding: 30vh 0px; ">
                        There are currently no images !
                    </div>
                @endif
                    @foreach ($images as $image)
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="file">
                                <a href="javascript:void(0);">
                                    <div class="hover">
                                        <button class="btn"  data-image-id="{{$image->id}}" onclick="onOpenPopupDeleteImage(this);"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                    <div class="image">
                                        @if ($image->source == 'local')
                                            <img src="{{$image->url}}" alt="img" class="img-fluid1">
                                        @elseif($image->source == 'link')
                                            <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px; color:#727cf5 "></i>
                                            <img src="{{$image->url}}" alt="img" class="img-fluid1">
                                        @endif
                                        
                                    </div>
                                    <div class="file-name">
                                        <p class="text-muted">{{$image->name != null ? $image->name : "n/a"}}</p>
                                        <small>
                                            <span class="mb-2 float-left" style="color: #007bff !importan;">Size: {{ number_format(floatval($image->size)/1048576, 1) }} MB</span>
                                            <span class="ml-3 float-left text-muted" style="text-transform: uppercase;">{{ $image->format }}</span>
                                            <span class="mb-2 float-right text-muted">{{Carbon\Carbon::parse($image->updated_at)->format('M d Y')}}</span>
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