@extends('layouts.partner')

@section('content')
<div class="container-fluid gallery">
    <!-- Page Heading -->
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
    </section>
</div>

<script>
    // validate form
    (function () {
        "use strict";
        window.addEventListener(
            "load",
            function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName("needs-validation");
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener(
                "submit",
                function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                },
                false
                );
            });
            },
            false
        );
    })();

    function closePopupCreateObject() { 
        $('popup-create-object__local-type-select').val('image');
        $('popup-create-object__link-type-select').val('image');
        $('#popup-create-object').find('img').attr('src', null);
        $('#popup-create-object').find('input').not('input[name="_token"]').not('input[name="source"]').val(null);
        $('#popup-create-object').find('textarea').val(null);
        $('#popup-create-object').find(".form_upload").show();
        $('#popup-create-object').find(".form_preview").hide();
        $('#popup-create-object').find(".preview-wrapper").hide();
        $('#popup-create-object').find('.nav_profile > a').removeClass('active');
        $(this).addClass('active');
        $('#popup-create-object').find('.form-step1').show();
        $('#popup-create-object').find('.form-step2').hide();
    }
</script>

<script>
    $(document).ready(function () {
        var filterizr = null;
        if($('#card-object-wrapper').children().length > 0){
            filterizr = $('#card-object-wrapper').filterizr({
                gutterPixels: 0
            });
        }
        
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
            if(filterizr != null){
                let filter = $('.btn[data-filter].active').data('filter');
                filterizr.filterizr('filter', filter);
            }
        })

        $('#tab-header-btn-table').on('click', function () {  
            let filter = $('.btn[data-filter].active').data('filter');
            $('.filter-wrapper[data-filter]').hide();
            $('.filter-wrapper[data-filter="'+filter+'"]').show();
        })

        $('#popup-create-object__local-type-select').click(function (e) { 
            let type = $(this).val(); 
            $('#popup-create-object__local-file-hidden-input').attr('accept', type + '/*');
        });

        $('#popup-create-object__local-upload-btn').click(function (e) {  
            $('#popup-create-object__local-file-hidden-input').trigger('click');
        });

        $('#popup-create-object').on('hidden.bs.modal', function () {  
            closePopupCreateObject();
        });

        $('#switch-local-btn').click(function (e) { 
            closePopupCreateObject();
            $('#popup-create-object').find('.nav_profile > a').removeClass('active');
            $(this).addClass('active');
            $('#popup-create-object').find('.form-step1').show();
            $('#popup-create-object').find('.form-step2').hide();
        });

        $('#switch-link-btn').click(function (e) { 
            closePopupCreateObject();
            $('#popup-create-object').find('.nav_profile > a').removeClass('active');
            $(this).addClass('active');
            $('#popup-create-object').find('.form-step2').show();
            $('#popup-create-object').find('.form-step1').hide();          
        });

        $('#popup-create-object__local-file-hidden-input').change(function () { 
            let type = $('#popup-create-object__local-type-select').val();
            let file = this.files[0];
            if(file != null){
                if(type=='image')
                {
                    $('#popup-create-object__local-preview-img').show();
                    $('#popup-create-object__local-preview-img').attr('src', URL.createObjectURL(this.files[0]));
                }
                else if(type=='video')
                {
                    $('#opup-create-object__local-preview-video').show();
                    $('#popup-create-object__local-preview-video').attr('src', URL.createObjectURL(this.files[0]));
                }
                else if(type=='audio')
                {
                    $('#popup-create-object__local-preview-audio').show();
                    $('#popup-create-object__local-preview-audio').attr('src', URL.createObjectURL(this.files[0]));
                }
                else if(type=='model')
                {
                    $('#popup-create-object__local-preview-model').show();
                    $('#popup-create-object__local-preview-model').attr('src', URL.createObjectURL(this.files[0]));
                }
               
                $('#popup-create-object').find(".form_upload").hide();
                $('#popup-create-object').find(".form_preview").show();
                $('#popup-create-object__local-name-input').val(file.name.replace(/\.[^/.]+$/, ""));
            }
        });

        $('#popup-create-object__local-remove-btn').click(function (e) { 
            $('#popup-create-object__local-preview-img').attr('src', null);
            $('#popup-create-object__local-preview-video').attr('src', null);
            $('#popup-create-object__local-preview-audio').attr('src', null);
            $('#popup-create-object').find(".form_upload").show();
            $('#popup-create-object').find(".form_preview").hide();
            $('#popup-create-object__local-file-hidden-input').val(null);
            $('#popup-create-object').find('input[name="url"]').val(null);
        });

        $('#popup-create-object__link-url-input').change( async function () { 
            let type = $('#popup-create-object__link-type-input').val();
            let url = $(this).val();
            let ext = url.split(/[#?]/)[0].split('.').pop().trim();
            let correct = false;
            if( url.startsWith("https://youtu.be/")){
                $('#popup-create-object__link-preview-video-ytb').show();
                if(type =='video')
                {
                    let link_ytb= url.replace("https://youtu.be/", "https://www.youtube.com/embed/");
                    $('#popup-create-object__link-preview-video-ytb').attr('src', link_ytb);
                    $('#popup-create-object').find('input[name="url"]').val(link_ytb);
                    $('#popup-create-object__source-hidden-input').val('youtube');
                    $('#popup-create-object').find(".form_upload").hide();
                    $('#popup-create-object').find(".form_preview").show();
                    $('#popup-create-object__link-remove-btn').show();
                    $('#popup-create-object__link-save-btn').prop('disabled', false);
                }
                else{
                    alert("LINK KHONG DUNG");
                    $('#popup-create-object__link-save-btn').prop('disabled', true);
                    return;
                }
            }
            else {
                if(ext == null || ext == ""){
                    alert("LINK KHONG DUNG");
                    $('#popup-create-object__link-save-btn').prop('disabled', true);
                    return;
                };

                $('#popup-create-object__link-preview-video-ytb').hide();
                if(url != null && url != ""){
                    let blob = await fetch(url).then(function(response) {
                        if (response.ok)  correct = true;
                        return response.blob();
                    });
                    if(correct){
                        if(type=='image' && blob.type.split("/")[0] == 'image')
                        {   
                            $('#popup-create-object__link-preview-img').show();
                            $('#popup-create-object__link-preview-img').attr('src', url );
                        }
                        else if(type=='video' && blob.type.split("/")[0] == 'video')
                        {
                            $('#popup-create-object__link-preview-video').show();
                            $('#popup-create-object__link-preview-video').attr('src', url);
                        }
                        else if(type=='audio' && blob.type.split("/")[0] == 'audio')
                        {
                            $('#popup-create-object__link-preview-audio').show();
                            $('#popup-create-object__link-preview-audio').attr('src', url);
                        }
                        else if(type=='model' && blob.type.split("/")[0] == 'model')
                        {
                            $('#popup-create-object__link-preview-model').show();
                            $('#popup-create-object__link-preview-model').attr('src', url);
                        }
                        else{
                            alert("SAI FORMAT FILE");
                            $('#popup-create-object__link-save-btn').prop('disabled', true);
                            return;
                        }
                    }
                    else{
                        alert("LINK KHONG DUNG");
                        $('#popup-create-object__link-save-btn').prop('disabled', true);
                        return;
                    }
                    $('#popup-create-object').find(".form_upload").hide();
                    $('#popup-create-object').find(".form_preview").show();
                    $('#popup-create-object__link-remove-btn').show();
                    $('#popup-create-object__link-save-btn').prop('disabled', false);
                }
            }
        });

        $('#popup-create-object__link-type-input').click(function (e) { 
            let type = $(this).val();
            switch (type) {
                case 'image':
                    $('#popup-create-object__link-url-input').attr('placeholder', 'e.g. https://www.image.com/myImage.png');
                    break;
                case 'video':
                    $('#popup-create-object__link-url-input').attr('placeholder', 'e.g. https://www.video.com/myVideo.mp4 or https://youtu.be/tqAtreRlWwc');
                    break;
                case 'audio':
                    $('#popup-create-object__link-url-input').attr('placeholder', 'e.g. https://www.audio.com/myAudio.mp3');
                    break;
                case 'model':
                    $('#popup-create-object__link-url-input').attr('placeholder', 'e.g. https://www.model.com/myModel.glb');
                    break;
                default:
                    break;
            }
        });

        $('#popup-create-object__link-remove-btn').click(function (e) { 
            $('#popup-create-object__link-preview-img').attr('src', null);
            $('#popup-create-object__link-preview-video').attr('src', null);
            $('#popup-create-object__link-preview-audio').attr('src', null);
            $('#popup-create-object').find(".form_upload").show();
            $('#popup-create-object').find(".form_preview").hide();
            $('#popup-create-object__link-remove-btn').hide();
            $('#popup-create-object__link-file-hidden-input').val(null);
            $('#popup-create-object').find('input[name="url"]').val(null);

        });
    });
</script>
@endsection
