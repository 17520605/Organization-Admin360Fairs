@extends('layouts.partner')

@section('content')
    <div class="container-fluid gallery">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Videos  <button class="btn btn-df" onclick="openPopupCreateObject('video')" style="position: absolute; right: 1.5rem;"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new file</button></h1>
        <div class="row clearfix">
            @if (count($videos) == 0)
                <div style=" text-align: center; width: 100%; padding: 30vh 0px; ">
                    There are currently no Videos !
                </div>
            @endif
                @foreach ($videos as $video)
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button class="btn"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                @if ($video->source == 'local')
                                    <div class="icon">
                                        <i class="fas fa-film"></i>
                                    </div>
                                @elseif($video->source == 'link')
                                    <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                    <div class="icon">
                                        <i class="fas fa-film"></i>
                                    </div>
                                @elseif($video->source == 'youtube')
                                    <i class="fas fa-link" style="font-size: 15px; position: absolute;top: 10px;left: 10px;"></i>
                                    <div class="icon">
                                        <i class="fab fa-youtube text-danger"></i>
                                    </div>
                                @endif
                                <div class="file-name">
                                    <p class="text-muted">{{$video->name != null ? $video->name : "n/a"}}</p>
                                    <small>
                                        <span class="mb-2 float-left" style="color: #007bff !importan;">Size: {{ number_format(floatval($video->size)/1048576, 1) }} MB</span>
                                        <span class="ml-3 float-left text-muted" style="text-transform: uppercase;">{{ $video->format }}</span>
                                        <span class="mb-2 float-right text-muted">{{Carbon\Carbon::parse($video->updated_at)->format('M d Y')}}</span>
                                    </small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
