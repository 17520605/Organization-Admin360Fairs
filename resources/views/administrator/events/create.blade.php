@extends('layouts.master')

@section('content')
<div class="m-3">
    <form class="needs-validation" action="/administrator/tours/{{$tour->id}}/events/webinars/save-create" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Create New Webinar</h1>
                    <div class="div_cardheader_btn">
                        <button type="submit" class="mb-0 btn float-right active"><span class="icon-loader-form"></span> Create </button>
                        <button type="button" class="mb-0 btn float-right">Clean</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-light" style="float: left">Poster</h5>
                        <button type="button" style="float: right"><i class="far fa-question-circle"></i></button>
                    </div>
                    <div class="card-body">
                        <div style="position: relative;">
                            <img src="https://res.cloudinary.com/virtual-tour/image/upload/v1636451555/c0hh6rq7set6wvke4gls.jpg" alt="" style="width: 100%; height: 60vh;">
                            <button type="button" style="position: absolute; top: 10px; right: 10px; font-size: 20px" onclick="selectPoster(event)"><i class="fas fa-pen"></i></button>
                            <input class="poster-file-input" type="file" name="poster" hidden onchange="changePoster(event)">
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-light">General</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="small mb-1">Topic</label>
                            <input class="form-control" type="text" name="topic" placeholder="Enter topic" required>
                            <div class="invalid-feedback">
                                Please enter topic.
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="start">Start time</label>
                                <input class="form-control" id="start" name="start" type="datetime-local" required>
                                <div class="invalid-feedback">
                                    Please enter start time.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="end">End time</label>
                                <input class="form-control" id="end" name="end" type="datetime-local" required>
                                <div class="invalid-feedback">
                                    Please enter end time.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="description">Description</label>
                            <textarea placeholder="Enter webinar description" class="form-control" name="description" rows="6" required></textarea>
                            <div class="invalid-feedback">
                                Please enter description.
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-light">Speakers</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id="speakers-wrapper" class="col-12"></div>
                            <div class="col-12">
                                <button type="button" onclick="openPopupCreateSpeaker()" style="width: 100%">Create New Speaker</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-light">Agenda</h5>
                    </div>
                    <div class="card-body">
                        {{-- <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="titles[]" placeholder="Title">
                            </div>
                            <div class="col-md-1" style="padding: 0;">
                                <input class="form-control" type="number" name="durations[]" min="0" max="500" style="padding-right: 0!important;" placeholder="Duration">
                            </div>
                            <div class="col-md-4" style="padding-right:0px ;">
                                <select class="form-control" name="speakers[]">
                                    <option disabled selected>--Choose speaker--</option>
                                    
                                </select>
                            </div>
                            <div class="col-md-1" style="text-align: center;">
                                <i class="fas fa-plus-circle add-agenda" onclick="addAgenda();" style="font-size: 25px;color: #4e73df;line-height: 38px;"></i>
                                <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px; display: none;"></i>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div id="agendas-wrapper" class="col-12"></div>
                            <div class="col-12">
                                <button type="button" onclick="openPopupCreateAgenda()" style="width: 100%">Create New Agenda</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- POPUP CREATE SPEAKER --}}
<div class="modal fade" id="popup-create-speaker" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light">Create New Speaker</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px">
                <div class="row mb-4 pl-3 speaker-wrapper">
                    <div style="float: left; width: 150px; height: 100px;"> 
                        <button type="button" class="avatar-upload-btn" onclick="selectAvatar(event)" style="position: relative; width: 100px; height: 100px; border: 1px gray; border-style: dotted; border-radius: 50px">
                            <div style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;">
                                <img type="image" src="https://dongthanhphat.vn//userfiles/images/Partner/anh-dai-dien-FB-200.jpg" style="width: 100px; height: 100px; border-radius: 50px"/>
                            </div>
                            <i class="fas fa-pen"></i>
                        </button>
                        <input class="avatar-file-input" type="file" name="speakerAvatar[]" accept="image/*" hidden onchange="changeAvatar(event)">
                    </div>
                    <div style="float: left; width: calc(100% - 250px); height: 100px;">
                        <input type="hidden" name="speakerNo[]" value='0'>
                        <div class="row mb-3">
                            <div class="col-3">
                                <select class="form-control" name="speakerHonorific[]" required>
                                    <option>Mr</option>
                                    <option>Ms</option>
                                    <option>Mrs</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please choose honorific.
                                </div>
                            </div>
                            <div class="col-9">
                                <input class="form-control" type="text" name="speakerName[]" onchange="changeSpeakerName(event)" placeholder="Speaker's name" required>
                                <div class="invalid-feedback">
                                    Please enter speaker name.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="speakerPosition[]" placeholder="Speaker's position" required>
                                <div class="invalid-feedback">
                                    Please enter speaker position.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="popup-create-speaker__create-btn" class="btn btn-primary btn-block" onclick="addSpeaker()">Create</button>
            </div>
        </div>
    </div>
</div>
{{-- POPUP CREATE AGENDA --}}
<div class="modal fade" id="popup-create-agenda" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light">Create New Speaker</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px">
                <div class="row mb-3 pl-3 agenda-wrapper">
                    <div class="col-12 mb-3">
                        <label for="">Title</label>
                        <input class="form-control" type="text" name="titles[]" placeholder="Enter title">
                    </div>
                    <div class="col-3"> 
                        <label for="">Duration</label>
                        <input class="form-control" type="number" name="durations[]" min="5" max="500" step="5" value="5" style="padding-right: 0!important;" placeholder="Duration">
                    </div>
                    <div class="col-9"> 
                        <label for="">Speaker</label>
                        <select class="form-control" name="speakers[]" required>
                            <option disabled="" selected="">--Choose speaker--</option>
                        </select>
                        <div class="invalid-feedback">
                            Please choose speaker name.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="popup-create-agenda__create-btn" class="btn btn-primary btn-block" onclick="addAgenda()">Create</button>
            </div>
        </div>
    </div>
</div>


<script>
    var nextNo = 0;

    function openPopupCreateSpeaker() {  
        $('#popup-create-speaker').find('input').val(null);
        $("#popup-create-speaker").find('select').prop("selectedIndex", 0);
        $('#popup-create-speaker').find('img').attr('src',"https://res.cloudinary.com/virtual-tour/image/upload/v1634458347/icons/default-avatar_muo2gc.jpg");
        $('#popup-create-speaker__create-btn').prop('disabled', true);
        $('#popup-create-speaker').modal('show');
    }
    
    function openPopupCreateAgenda() {  
        $('#popup-create-agenda').find('input[type="text"]').val(null);
        $('#popup-create-agenda').find('input[type="number"]').val(5);
        $("#popup-create-agenda").find('select').prop("selectedIndex", 0);
       // $('#popup-create-agenda').find('select').val(null);
        $('#popup-create-agenda__create-btn').prop('disabled', true);
        $('#popup-create-agenda').modal('show');
    }

    function addAgenda() {
        let title = $('#popup-create-agenda').find('input[name="titles[]"]').val();
        let duration = $('#popup-create-agenda').find('input[name="durations[]"]').val();
        let speaker = $('#popup-create-agenda').find('select[name="speakers[]"]').val();
        let select = $('#popup-create-agenda').find('select[name="speakers[]"]').clone();
        select.val(speaker);

        let wrapper = $(`
            <div class="row gx-3 mb-4 agenda-item">
                <div class="col-md-6">
                    <input class="form-control" type="text" name="titles[]" placeholder="Title" required>
                    <div class="invalid-feedback">
                        Please enter title.
                    </div>
                </div>
                <div class="col-md-1" style="padding: 0;">
                    <input class="form-control" type="number" name="durations[]" min="0" max="500" style="padding-right: 0!important;" placeholder="Duration" required>
                    <div class="invalid-feedback">
                        Please enter duration.
                    </div>
                </div>
                <div class="col-md-4 speaker-select-wrapper" style="padding-right:0px;">
                    
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px;"></i>
                </div>
            </div>
        `);
        
        wrapper.find('input[name="titles[]"]').val(title);
        wrapper.find('input[name="durations[]"]').val(duration);
        wrapper.find('.speaker-select-wrapper').append(select);

        $("#agendas-wrapper").append( wrapper );

        $('#popup-create-agenda').modal('hide');
    }

    function removeAgenda(e) {
        $(e.currentTarget).parent().parent().remove();
    }

    function addSpeaker() {
        let no = ++nextNo;
        let name = $('#popup-create-speaker').find('input[name="speakerName[]"]').val();
        let honorific = $('#popup-create-speaker').find('select[name="speakerHonorific[]"]').val();
        let wrapper = $('#popup-create-speaker').find('.speaker-wrapper').clone();
        wrapper.find('input[name="speakerNo[]"]').val(no);
        wrapper.find('select[name="speakerHonorific[]"]').val(honorific);
        wrapper.append(`
            <div style="float: left; width: 100px; height:100%; text-align: center;">
                <i class="fas fa-minus-circle" onclick="removeSpeaker(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px;"></i>
            </div>
        `);

        $('.add-speaker').hide();
        $('.remove-speaker').show();
        $("#speakers-wrapper").append(wrapper);

        $('select[name="speakers[]"').append(`
            <option value="`+ no +`">`+ name +`</option>
        `);

        $('#popup-create-speaker').modal('hide');
    }

    function changeSpeakerName(e) {  
        let wrapper = $(e.currentTarget).parents('.speaker-wrapper');
        let name = wrapper.find('input[name="speakerName[]"]').val();
        let no = wrapper.find('input[name="speakerNo[]"]').val();

        $('select[name="speakers[]"]').find('option[value="'+no+'"]').text(name);
    }

    function removeSpeaker(e) {
        let wrapper = $(e.currentTarget).parents('.speaker-wrapper');
        let no = wrapper.find('input[name="speakerNo[]"]').val();

        let options = $('select[name="speakers[]"').find('option[value="'+no+'"]');
        let selects = options.parent().prop("selectedIndex", 0);
        options.remove();

        $(e.currentTarget).parent().parent().remove();
    }

    function selectAvatar(e) {  
        let target = $(e.currentTarget);
        target.parent().find('.avatar-file-input').trigger('click');
    }

    function changeAvatar(e) {  
        let files = $(e.currentTarget).prop('files');;
        if(files.length > 0){
            let file = files[0];
            let btn = $(e.currentTarget).parent().find('.avatar-upload-btn');
            let img = btn.find('img');
            img.attr('src', URL.createObjectURL(file));
        }
    }

    function selectPoster(e) {  
        let target = $(e.currentTarget);
        target.parent().find('.poster-file-input').trigger('click');
    }

    function changePoster(e) {  
        let files = $(e.currentTarget).prop('files');;
        if(files.length > 0){
            let file = files[0];
            let img = $(e.currentTarget).parent().find('img');
            img.attr('src', URL.createObjectURL(file));
        }
    }
</script>
<script>
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

    $(document).ready(function () {
        $('#popup-create-speaker').on('input', ':text', function(){ 
            let name = $('#popup-create-speaker').find('input[name="speakerName[]"]').val();
            let position = $('#popup-create-speaker').find('input[name="speakerPosition[]"]').val();
            if(name != null && position != null && name != '' && position != ''){
                $('#popup-create-speaker__create-btn').prop('disabled', false);
            }
            else{
                $('#popup-create-speaker__create-btn').prop('disabled', true);
            }
        });

        $('#popup-create-agenda').on('input', ':text', function(){ 
            let title = $('#popup-create-agenda').find('input[name="titles[]"]').val();
            let speaker = $('#popup-create-agenda').find('select[name="speakers[]"]').val();
            if(title != null && speaker != null && title != '' && speaker != ''){
                $('#popup-create-agenda__create-btn').prop('disabled', false);
            }
            else{
                $('#popup-create-agenda__create-btn').prop('disabled', true);
            }
        });

        $('#popup-create-agenda').find('select').change(function(){ 
            let title = $('#popup-create-agenda').find('input[name="titles[]"]').val();
            let speaker = $('#popup-create-agenda').find('select[name="speakers[]"]').val();
            if(title != null && speaker != null && title != '' && speaker != ''){
                $('#popup-create-agenda__create-btn').prop('disabled', false);
            }
            else{
                $('#popup-create-agenda__create-btn').prop('disabled', true);
            }
        });

    });
</script>
@endsection

