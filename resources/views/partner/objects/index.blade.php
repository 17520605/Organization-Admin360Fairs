@extends('layouts.partner')

@section('content')
<div class="container-fluid gallery">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h1 class="h4 font-weight-bold text-primary" style="margin: 0px"> Objects </h1>
                <div class="div_cardheader_btn">
                    <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-create-speaker"><i class="fas fa-plus"></i> Add </button>
                </div>
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
                        <div id="card-object-wrapper" class="tab-body" data-tab="card" style="min-height: 400px">
                            @foreach ($objects as $object)
                            @if ($object->type == 'image')
                            <div class="filtr-item" data-category="image" style="width: 25%; padding: 10px">
                                <div class="card object-file-booth">
                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                        <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}">
                                            <div class="image">
                                                @if ($object->url != null || $object->url !='')
                                                    <img src="{{$object->url}}" alt="img" class="img-fluid">
                                                @else
                                                    <img src="https://res.cloudinary.com/virtual-tour/image/upload/v1634815623/error-404_ghj2tk.png" alt="img" class="img-fluid">
                                                @endif
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">{{$object->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($object->type == 'video')
                            <div  class="filtr-item" data-category="video" style="width: 25%; padding: 10px">
                                @if ($object->source == 'local')
                                <div class="card object-file-booth">
                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                        <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}">
                                            <div class="image">
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
                                        <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}">
                                            <div class="image">
                                                <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                <div class="icon">
                                                    <i class="fab fa-soundcloud"></i>
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
                            <div  class="filtr-item" data-category="audio" style="width: 25%; padding: 10px">
                                <div class="card object-file-booth">
                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                        <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}">
                                            <div class="image">
                                                <i class="fas fa-link" style="font-size: 20px; position: absolute;top: 10px;left: 10px;color:#727cf5 "></i>
                                                <div class="icon">
                                                    <i class="fab fa-soundcloud"></i>
                                                </div>
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">{{$object->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($object->type == 'model')
                            <div class="filtr-item" data-category="model" style="width: 25%; padding: 10px">
                                <div class="card object-file-booth">
                                    <div class="file" style="position: relative; border-radius: .30rem; overflow: hidden;">
                                        <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}">
                                            <div class="image">
                                                <model-viewer style="width: 100%; height: 120px;" src="{{$object->url}}" ar-status="not-presenting"></model-viewer>
                                            </div>
                                            <div class="file-name">
                                                <p class="m-b-5 text-muted">{{$object->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
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
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                <tr>
                                                    <td>
                                                        @if ($object->type == 'image')
                                                            <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}"><i class="fas fa-image font-size-16 mr-2"></i> {{$object->name}}</a>
                                                        @elseif($object->type == 'video')
                                                            <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}"><i class="far fa-play-circle font-size-16 mr-2"></i> {{$object->name}}</a>
                                                        @elseif($object->type == 'audio')
                                                            <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}"><i class="fas fa-music font-size-16 mr-2"></i> {{$object->name}}</a>
                                                        @elseif($object->type == 'model')
                                                            <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}"><i class="fab fa-unity font-size-16 mr-2"></i> {{$object->name}}</a>
                                                        @else 
                                                            <a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}"><i class="fas fa-file-code font-size-16 mr-2"></i> {{$object->name}}</a>
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
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                    @if ($object->type == 'image')
                                                    <tr>
                                                        <td><a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}"><i class="fas fa-file-code font-size-16 mr-2"></i> {{$object->name}}</a></td>
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
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                    @if ($object->type == 'video')
                                                    <tr>
                                                        <td><a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}"><i class="far fa-play-circle font-size-16 mr-2"></i> {{$object->name}}</a></td>
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
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                    @if ($object->type == 'audio')
                                                    <tr>
                                                        <td><a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}"><i class="fas fa-music font-size-16 mr-2"></i> {{$object->name}}</a></td>
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
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Source</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Format</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Date modified</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objects as $object)
                                                    @if ($object->type == 'model')
                                                    <tr>
                                                        <td><a href="/partner/tours/{{$tour->id}}/objects/{{$object->id}}"><i class="fab fa-unity font-size-16 mr-2"></i> {{$object->name}}</a></td>
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
