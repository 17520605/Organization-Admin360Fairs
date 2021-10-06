@extends('layouts.master')

@section('content')
    <div class="container-fluid gallery">
         <div class="container-fluid gallery-ds">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Images  <button  class="btn btn-df" onclick="openPopupCreateObject('image')" style="position: absolute; right: 1.5rem;"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new file</button></h1>
            <div class="row clearfix">
                @if (count($images) == 0)
                    <div>
                        Khong co hinh anh
                    </div>
                @endif
                    @foreach ($images as $image)
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="file">
                                <a href="javascript:void(0);">
                                    <div class="hover">
                                        <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                                    </div>
                                    <div class="image">
                                        <img src="{{$image->url}}" alt="img" class="img-fluid">
                                    </div>
                                    <div class="file-name">
                                        <p class="text-muted">{{$image->name != null ? $image->name : "n/a"}}</p>
                                        <small>
                                            <span class="mb-2 float-left text-muted">Size: {{ number_format(floatval($image->size)/1048576, 1) }} MB</span>
                                            <span class="ml-3 float-left text-muted">{{ $image->format }}</span>
                                            <span class="mb-2 float-right text-muted">{{Carbon\Carbon::parse($image->updatedAt)->format('M d Y')}}</span>
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
