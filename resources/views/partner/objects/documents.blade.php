@extends('layouts.partner')

@section('content')
    <div class="container-fluid gallery">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Document <button class="btn btn-df" onclick="openPopupCreateObject('document')" style="position: absolute; right: 1.5rem;"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new file</button></h1>
        <div class="row clearfix">
            @if (count($documents) == 0)
                <div style=" text-align: center; width: 100%; padding: 30vh 0px; ">
                    There are currently no Document !
                </div>
            @endif
                @foreach ($documents as $document)
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button class="btn"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                @if ($document->format == 'docx' || $document->format == 'doc')
                                    <div class="icon">
                                        <i class="fas fa-file-word" style="color: #2B5796" ></i>
                                    </div>
                                @elseif($document->format == 'PPT' || $document->format == 'PPS' || $document->format == 'PPTX' || $document->format == 'PPSX' )
                                    <div class="icon">
                                        <i class="fas fa-file-powerpoint" style="color: #D04526" ></i>
                                    </div>
                                @elseif($document->format == 'xls' || $document->format == 'xlsx' || $document->format == 'xlsm')
                                    <div class="icon">
                                        <i class="fas fa-file-excel" style="color: #1E7145" ></i>
                                    </div>
                                @elseif($document->format == 'pdf')
                                    <div class="icon">
                                        <i class="fas fa-file-pdf" style="color: #B11B1E" ></i>
                                    </div>
                                @else
                                    <div class="icon">
                                        <i class="fas fa-file-alt" style="color: #6F357D" ></i>
                                    </div>
                                @endif
                                <div class="file-name">
                                    <p class="text-muted">{{$document->name != null ? $document->name : "n/a"}}</p>
                                    <small>
                                        <span class="mb-2 float-left" style="color: #007bff !importan;">Size: {{ number_format(floatval($document->size)/1048576, 1) }} MB</span>
                                        <span class="ml-3 float-left text-muted" style="text-transform: uppercase;">{{ $document->format }}</span>
                                        <span class="mb-2 float-right text-muted">{{Carbon\Carbon::parse($document->updated_at)->format('M d Y')}}</span>
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
