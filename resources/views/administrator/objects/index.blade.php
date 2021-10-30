@extends('layouts.master')

@section('content')
<div class="container-fluid gallery">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h1 class="h4 font-weight-bold text-primary" style="margin: 0px"> Objects  <button  class="btn btn-df" onclick="openPopupCreateBoothObject('image')" style="position: absolute; right: 1.5rem;"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new file</button></h1>
            </div>
            <div class="card-body">
                <div>
                    <div class="btn-group w-100 mb-2">
                        <a class="btn btn-info-tab active" href="javascript:void(0)" data-filter="all"><i class="fas fa-list"></i> All</a>
                        <a class="btn btn-info-tab" href="javascript:void(0)" data-filter="image"></i><i class="fas fa-images"></i> Images </a>
                        <a class="btn btn-info-tab" href="javascript:void(0)" data-filter="video"><i class="fas fa-film"></i> Videos </a>
                        <a class="btn btn-info-tab" href="javascript:void(0)" data-filter="audio"><i class="fas fa-music"></i> Audios </a>
                        <a class="btn btn-info-tab" href="javascript:void(0)" data-filter="model"><i class="fab fa-unity"></i> Models </a>
                    </div> 
                </div>
                <div class="tabs">
                    <div>
                        <div class="tab-header" style="width: 100%; height: 40px;">
                            <span id="tab-header-btn-card" class="mb-0 btn float-right tab-header-btn active" data-tab="card"><i class="far fa-clone"></i></span>
                            <span id="tab-header-btn-table" class="mb-0 btn float-right tab-header-btn" data-tab="table"><i class="fas fa-list-ul"></i> </span>
                        </div>
                    </div>
                    <div>
                        <div id="card-object-wrapper" class="tab-body" data-tab="card" style="min-height: 400px;margin-left: 2%;">
                            @foreach ($objects as $object)
                                @if ($object->type == 'image')
                                    <div class="filtr-item" data-category="image" style="width: 24%; padding: 10px">
                                        @if ($object->source == 'local')
                                            <div class="card object-file-booth">
                                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                    <a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">
                                                        <div class="image" style="height: 150px">
                                                            @if ($object->url != null || $object->url !='')
                                                                <img class="border-image-bt" src="{{$object->url}}" alt="img" class="img-fluid">
                                                            @else
                                                                <img class="border-image-bt" src="https://res.cloudinary.com/virtual-tour/image/upload/v1634815623/error-404_ghj2tk.png" alt="img" class="img-fluid">
                                                            @endif
                                                        </div>
                                                        <div class="file-name">
                                                            <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($object->source == 'link')
                                            <div class="card object-file-booth">
                                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                    <a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">
                                                        <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                        <div class="image" style="height: 150px">
                                                            @if ($object->url != null || $object->url !='')
                                                                <img class="border-image-bt" src="{{$object->url}}" alt="img" class="img-fluid">
                                                            @else
                                                                <img class="border-image-bt" src="https://res.cloudinary.com/virtual-tour/image/upload/v1634815623/error-404_ghj2tk.png" alt="img" class="img-fluid">
                                                            @endif
                                                        </div>
                                                        <div class="file-name">
                                                            <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if ($object->type == 'video')
                                    <div  class="filtr-item" data-category="video" style="width: 24%; padding: 10px">
                                        @if ($object->source == 'local')
                                            <div class="card object-file-booth">
                                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                    <a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">
                                                        <div class="image" style="height: 150px">
                                                            <img src="" alt="img" class="img-fluid">
                                                        </div>
                                                        <div class="file-name">
                                                            <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($object->source == 'link')
                                            <div class="card object-file-booth">
                                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                    <a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">
                                                        <div class="image" style="height: 150px">
                                                            <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                            <div class="icon">
                                                                <i class="fas fa-film"></i>
                                                            </div>
                                                        </div>
                                                        <div class="file-name">
                                                            <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($object->source == 'youtube')
                                            <div class="card object-file-booth">
                                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                    <a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">
                                                        <div class="image" style="height: 150px">
                                                            <i class="fab fa-youtube" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#FF0000 "></i>
                                                            <div class="icon">
                                                                <i class="fab fa-youtube" style="color: #FF0000"></i>
                                                            </div>
                                                        </div>
                                                        <div class="file-name">
                                                            <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if ($object->type == 'audio')
                                    <div  class="filtr-item" data-category="audio" style="width: 24%; padding: 10px">
                                        @if ($object->source == 'local')
                                            <div class="card object-file-booth">
                                            <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                <a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">
                                                    <div class="image" style="height: 150px">
                                                        <div class="icon">
                                                            <i class="fab fa-soundcloud" style="color: #F77300"></i>
                                                        </div>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($object->source == 'link')
                                        <div class="card object-file-booth">
                                            <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                <a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">
                                                    <div class="image" style="height: 150px">
                                                        <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                        <div class="icon">
                                                            <i class="fab fa-soundcloud" style="color: #F77300"></i>
                                                        </div>
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                @endif
                                @if ($object->type == 'model')
                                    <div class="filtr-item" data-category="model" style="width: 24%; padding: 10px">
                                        @if ($object->source == 'local')
                                            <div class="card object-file-booth">
                                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                    <a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">
                                                        <div class="image" style="height: 150px">
                                                            <model-viewer style="width: 100%; height: 150px;" src="{{$object->url}}" ar-status="not-presenting"></model-viewer>
                                                        </div>
                                                        <div class="file-name">
                                                            <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($object->source == 'link')
                                            <div class="card object-file-booth">
                                                <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                                    <a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">
                                                        <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                        <div class="image" style="height: 150px">
                                                            <model-viewer style="width: 100%; height: 150px;" src="{{$object->url}}" ar-status="not-presenting"></model-viewer>
                                                        </div>
                                                        <div class="file-name">
                                                            <p class="m-b-5 text-muted">{{$object->name}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <div class="tab-body" data-tab="table" style="display: none; min-height: 400px">
                                <div class="filter-wrapper" data-filter="all">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap table-hover mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col" style="width:15%">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                <tr>
                                                    <td style="width: 4%; text-align: center">
                                                        @if ($object->type == 'image')
                                                            <i class="fas fa-image font-size-16 text-success"></i>
                                                        @elseif($object->type == 'video')
                                                            <i class="far fa-play-circle font-size-16 text-danger"></i>
                                                        @elseif($object->type == 'audio')
                                                            <i class="fas fa-music font-size-16 text-info"></i>
                                                        @elseif($object->type == 'model')
                                                            <i class="fab fa-unity font-size-16 text-models"></i>
                                                        @else 
                                                            @if ($object->format == 'pdf')
                                                                <i class="fas fa-file-pdf font-size-16 text-danger"></i>
                                                            @elseif ($object->format == 'doc' || $object->format == 'docx')
                                                                <i class="fas fa-file-word font-size-16 text-primary" ></i>
                                                            @elseif ($object->format == 'xlsx' || $object->format == 'xlsm' || $object->format == 'csv')
                                                                <i class="fas fa-file-csv font-size-16 text-success"></i>
                                                            @elseif ($object->format == 'txt' || $object->format == 'html' || $object->format == 'php')
                                                                <i class="fas fa-file-alt font-size-16 text-primary"></i>
                                                            @else
                                                                <i class="fas fa-file font-size-16 text-warning"></i>
                                                            @endif
                                                            
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($object->type == 'image')
                                                            <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                        @elseif($object->type == 'video')
                                                            <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                        @elseif($object->type == 'audio')
                                                            <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                        @elseif($object->type == 'model')
                                                            <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                        @else 
                                                            <a class="text-primary" href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a>
                                                        @endif
                                                    </td>
                                                    <td>{{$object->source}}</td>
                                                    <td>{{$object->type}}</td>
                                                    <td>{{$object->format != null ? $object->format : 'N/A'}}</td>
                                                    <td>{{$object->size != null ? strval(number_format(floatval($object->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                    <td>{{$object->updated_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="filter-wrapper" data-filter="image">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap table-hover mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>   
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col" style="width:15%">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                    @if ($object->type == 'image')
                                                    <tr>
                                                        <td style="width: 4%; text-align: center"><i class="fas fa-image font-size-16 text-success"></i></td>
                                                        <td><a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a></td>
                                                        <td>{{$object->source}}</td>
                                                        <td>{{$object->type}}</td>
                                                        <td>{{$object->format != null ? $object->format : 'N/A'}}</td>
                                                        <td>{{$object->size != null ? strval(number_format(floatval($object->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                        <td>{{$object->updated_at}}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="filter-wrapper" data-filter="video">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap table-hover mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>  
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col" style="width:15%">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                    @if ($object->type == 'video')
                                                    <tr>
                                                        <td style="width: 4%; text-align: center"> <i class="far fa-play-circle font-size-16 text-danger"></i></td>
                                                        <td><a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a></td>
                                                        <td>{{$object->source}}</td>
                                                        <td>{{$object->type}}</td>
                                                        <td>{{$object->format != null ? $object->format : 'N/A'}}</td>
                                                        <td>{{$object->size != null ? strval(number_format(floatval($object->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                        <td>{{$object->updated_at}}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="filter-wrapper" data-filter="audio">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap table-hover mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>   
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col" style="width:15%">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                    @if ($object->type == 'audio')
                                                    <tr>
                                                        <td style="width: 4%; text-align: center"><i class="fas fa-music font-size-16 text-info"></i></td>
                                                        <td><a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a></td>
                                                        <td>{{$object->source}}</td>
                                                        <td>{{$object->type}}</td>
                                                        <td>{{$object->format != null ? $object->format : 'N/A'}}</td>
                                                        <td>{{$object->size != null ? strval(number_format(floatval($object->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                        <td>{{$object->updated_at}}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="filter-wrapper" data-filter="model">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap table-hover mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>  
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col" style="width:15%">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                    @if ($object->type == 'model')
                                                    <tr>
                                                        <td style="width: 4%; text-align: center"><i class="fab fa-unity font-size-16 text-models"></i></td>
                                                        <td><a href="/administrator/tours/{{$tour->id}}/objects/{{$object->id}}">{{$object->name}}</a></td>
                                                        <td>{{$object->source}}</td>
                                                        <td>{{$object->type}}</td>
                                                        <td>{{$object->format != null ? $object->format : 'N/A'}}</td>
                                                        <td>{{$object->size != null ? strval(number_format(floatval($object->size)/(1048576), 1)).' MB' : 'N/A'}}</td>
                                                        <td>{{$object->updated_at}}</td>
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
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<script>
    $(document).ready(function () {
        var filterizr = $('#card-object-wrapper').filterizr({
            gutterPixels: 0
        });

        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');

            let filter = $('.btn[data-filter].active').data('filter');
            $('.filter-wrapper[data-filter]').hide();
            $('.filter-wrapper[data-filter="'+filter+'"]').show();
        });


        $('.tab-header-btn').on('click', function () {  
            $('.tab-header-btn').removeClass('active');
            $(this).addClass('active');

            let tab = $(this).attr('data-tab');
            $(this).parents('.tabs').find('.tab-body').hide();
            $(this).parents('.tabs').find('.tab-body[data-tab="'+tab+'"]').show();
        });

        $('#tab-header-btn-card').on('click', function () {  
            $('#card-object-wrapper').show();
            let filter = $('.btn[data-filter].active').data('filter');
            filterizr.filterizr('filter', filter);
        })

        $('#tab-header-btn-table').on('click', function () {  
            let filter = $('.btn[data-filter].active').data('filter');
            $('.filter-wrapper[data-filter]').hide();
            $('.filter-wrapper[data-filter="'+filter+'"]').show();
        })
    });
</script>
@endsection
