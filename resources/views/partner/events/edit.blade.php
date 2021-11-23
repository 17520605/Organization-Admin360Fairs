@extends('layouts.partner')

@section('content')
<div class="m-3">
    <form id="form-edit" class="needs-validation" action="/partner/tours/{{$tour->id}}/events/webinars/save-edit" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <input type="hidden" name="webinarId" value="{{$webinar->id}}">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Edit Webinar</h1>
                    <div class="div_cardheader_btn">
                        <button type="submit" class="mb-0 btn float-right active"><span class="icon-loader-form"></span> Save Changes </button>
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
                            <img id="form-edit__poster-img" src="{{$webinar->poster}}" alt="" style="width: 100%; height: 60vh;">
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
                            <input class="form-control" type="text" value="{{$webinar->topic}}" name="topic" placeholder="Enter topic" required>
                            <div class="invalid-feedback">
                                Please enter topic.
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="start">Start time</label>
                                <input class="form-control" id="start" name="start" value="{{ Carbon\Carbon::parse($webinar->startAt)->format('Y-m-d\TH:i')}}" type="datetime-local" required>
                                <div class="invalid-feedback">
                                    Please enter start time.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="end">End time</label>
                                <input class="form-control" id="end" name="end" value="{{ Carbon\Carbon::parse($webinar->endAt)->format('Y-m-d\TH:i')}}" type="datetime-local" required>
                                <div class="invalid-feedback">
                                    Please enter end time.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="description">Description</label>
                            <textarea placeholder="Enter webinar description" class="form-control" name="description" rows="6" required> {{$webinar->description}} </textarea>
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
                            <div id="speakers-wrapper" class="col-12">
                                @foreach ($webinar->speakers as $key => $speaker)
                                <div class="row mb-4 pl-3 speaker-wrapper">
                                    <input type="hidden" name="speakerNos[]" value="{{$key}}">
                                    <input type="hidden" name="speakerIds[]" value="{{$speaker->id}}">
                                    <div style="float: left; width: 150px; height: 100px;"> 
                                        <button type="button" class="avatar-upload-btn" onclick="selectAvatar(event)" style="position: relative; width: 100px; height: 100px; border: 1px gray; border-style: dotted; border-radius: 50px">
                                            <div style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;">
                                                <img type="image" src="{{$speaker->avatar}}" style="width: 100px; height: 100px; border-radius: 50px"/>
                                            </div>
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <input class="avatar-file-input" type="file" name="speakerAvatars[]" accept="image/*" hidden onchange="changeAvatar(event)">
                                    </div>
                                    <div style="float: left; width: calc(100% - 250px); height: 100px;">
                                        <div class="row mb-3">
                                            <div class="col-3">
                                                <select class="form-control" name="speakerHonorifics[]" required>
                                                    <option value="Mr" {{$speaker->honorific == 'Mr' ? 'selected' : '' }} >Mr</option>
                                                    <option value="Ms" {{$speaker->honorific == 'Ms' ? 'selected' : '' }} >Ms</option>
                                                    <option value="Mrs" {{$speaker->honorific == 'Mrs' ? 'selected' : '' }} >Mrs</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please choose honorific.
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <input class="form-control" type="text" name="speakerNames[]" value="{{$speaker->name}}" onchange="changeSpeakerName(event)" placeholder="Speaker's name" required>
                                                <div class="invalid-feedback">
                                                    Please enter speaker name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="form-control" type="text" name="speakerPositions[]" value="{{$speaker->position}}" placeholder="Speaker's position" required>
                                                <div class="invalid-feedback">
                                                    Please enter speaker position.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="float: left; width: 100px; height:100%; text-align: center;">
                                        <i class="fas fa-minus-circle" onclick="removeSpeaker(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px;"></i>
                                    </div>
                                </div>
                                @endforeach
                            </div>
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
                        <div class="row">
                            <div id="agendas-wrapper" class="col-12">
                                @foreach ($webinar->details as $detail)
                                <div class="row gx-3 mb-4 agenda-item">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <input class="form-control" type="text" name="detailTitles[]" value="{{$detail->title}}" placeholder="Title" required>
                                                <div class="invalid-feedback">
                                                    Please enter title.
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input class="form-control" type="number" name="detailDurations[]" value="{{$detail->duration}}" min="0" max="500" style="padding-right: 0!important;" placeholder="Duration" required>
                                                <div class="invalid-feedback">
                                                    Please enter duration.
                                                </div>
                                            </div>
                                            <div class="col-9 speaker-select-wrapper">
                                                <select class="form-control" name="detailSpeakerNos[]" required>
                                                    <option disabled>--Choose speaker--</option>
                                                    @foreach ($webinar->speakers as $key => $speaker)
                                                        <option value="{{$key}}" {{$detail->speakerId == $speaker->id ? 'selected' : '' }}>{{$speaker->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please choose speaker name.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 speaker-content-wrapper">
                                        <textarea name="detailContents[]" class="form-control summernote" style="height: 300px">{!! $detail->content !!}</textarea>
                                    </div>
                                    <div class="col-md-1" style="text-align: center;">
                                        <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px;"></i>
                                    </div>
                                </div>
                                @endforeach
                            </div>
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
                    <input type="hidden" name="speakerNos[]">
                    <input type="hidden" name="speakerIds[]">
                    <div style="float: left; width: 150px; height: 100px;"> 
                        <button type="button" class="avatar-upload-btn" onclick="selectAvatar(event)" style="position: relative; width: 100px; height: 100px; border: 1px gray; border-style: dotted; border-radius: 50px">
                            <div style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;">
                                <img type="image" src="https://dongthanhphat.vn//userfiles/images/Partner/anh-dai-dien-FB-200.jpg" style="width: 100px; height: 100px; border-radius: 50px"/>
                            </div>
                            <i class="fas fa-pen"></i>
                        </button>
                        <input class="avatar-file-input" type="file" name="speakerAvatars[]" accept="image/*" hidden onchange="changeAvatar(event)">
                    </div>
                    <div style="float: left; width: calc(100% - 250px); height: 100px;">
                        <div class="row mb-3">
                            <div class="col-3">
                                <select class="form-control" name="speakerHonorifics[]" required>
                                    <option value="Mr">Mr</option>
                                    <option value="Ms">Ms</option>
                                    <option value="Mrs">Mrs</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please choose honorific.
                                </div>
                            </div>
                            <div class="col-9">
                                <input class="form-control" type="text" name="speakerNames[]" onchange="changeSpeakerName(event)" placeholder="Speaker's name" required>
                                <div class="invalid-feedback">
                                    Please enter speaker name.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="speakerPositions[]" placeholder="Speaker's position" required>
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
                        <input class="form-control" type="text" name="detailTitles[]" placeholder="Enter title">
                    </div>
                    <div class="col-3 mb-3"> 
                        <label for="">Duration</label>
                        <input class="form-control" type="number" name="detailDurations[]" min="5" max="500" step="5" value="5" style="padding-right: 0!important;" placeholder="Duration">
                    </div>
                    <div class="col-9 mb-3"> 
                        <label for="">Speaker</label>
                        <select class="form-control" name="detailSpeakerNos[]" required>
                            <option disabled>--Choose speaker--</option>
                            @foreach ($webinar->speakers as $key => $speaker)
                                <option value="{{$key}}" {{$detail->speakerId == $speaker->id ? 'selected' : '' }}>{{$speaker->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please choose speaker name.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="">Content</label>
                        <div class="form-group">
                            <textarea id="popup-create-agenda__content-input" name="detailContents[]" class="form-control summernote" style="height: 300px"></textarea>
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
    var _no = {{count($webinar->speakers)}};

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
        let title = $('#popup-create-agenda').find('input[name="detailTitles[]"]').val();
        let duration = $('#popup-create-agenda').find('input[name="detailDurations[]"]').val();
        let speaker = $('#popup-create-agenda').find('select[name="detailSpeakerNos[]"]').val();
        let select = $('#popup-create-agenda').find('select[name="detailSpeakerNos[]"]').clone();
        let content = $('#popup-create-agenda').find('textarea[name="detailContents[]"]').clone();
        select.val(speaker);

        let wrapper = $(`
            <div class="row gx-3 mb-4 agenda-item">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input class="form-control" type="text" name="detailTitles[]" placeholder="Title" required>
                            <div class="invalid-feedback">
                                Please enter title.
                            </div>
                        </div>
                        <div class="col-3">
                            <input class="form-control" type="number" name="detailDurations[]" min="0" max="500" style="padding-right: 0!important;" placeholder="Duration" required>
                            <div class="invalid-feedback">
                                Please enter duration.
                            </div>
                        </div>
                        <div class="col-9 speaker-select-wrapper">
                            <div class="invalid-feedback">
                                Please choose speaker name.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 speaker-content-wrapper"></div>
                <div class="col-md-1" style="text-align: center;">
                    <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px;"></i>
                </div>
            </div>
        `);
        
        wrapper.find('input[name="detailTitles[]"]').val(title);
        wrapper.find('input[name="detailDurations[]"]').val(duration);
        wrapper.find('.speaker-select-wrapper').preppend(select);
        wrapper.find('.speaker-content-wrapper').append(content);
        content.summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });

        $("#agendas-wrapper").append( wrapper );

        $('#popup-create-agenda').modal('hide');
    }

    function removeAgenda(e) {
        $(e.currentTarget).parent().parent().remove();
    }

    function addSpeaker() {
        _no = _no + 1;
        let name = $('#popup-create-speaker').find('input[name="speakerNames[]"]').val();
        let honorific = $('#popup-create-speaker').find('select[name="speakerHonorifics[]"]').val();
        let wrapper = $('#popup-create-speaker').find('.speaker-wrapper').clone();
        wrapper.find('input[name="speakerNos[]"]').val(_no);
        wrapper.find('select[name="speakerHonorifics[]"]').val(honorific);
        wrapper.append(`
            <div style="float: left; width: 100px; height:100%; text-align: center;">
                <i class="fas fa-minus-circle" onclick="removeSpeaker(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px;"></i>
            </div>
        `);

        $('.add-speaker').hide();
        $('.remove-speaker').show();
        $("#speakers-wrapper").append(wrapper);

        $('select[name="detailSpeakerNos[]"').append(`
            <option value="`+ _no +`">`+ name +`</option>
        `);

        $('#popup-create-speaker').modal('hide');
    }

    function changeSpeakerName(e) {  
        let wrapper = $(e.currentTarget).parents('.speaker-wrapper');
        let name = wrapper.find('input[name="speakerNames[]"]').val();
        let no = wrapper.find('input[name="speakerNos[]"]').val();

        $('select[name="detailSpeakerNos[]"]').find('option[value="'+no+'"]').text(name);
    }

    function removeSpeaker(e) {
        let wrapper = $(e.currentTarget).parents('.speaker-wrapper');
        let no = wrapper.find('input[name="speakerNos[]"]').val();

        let options = $('select[name="detailSpeakerNos[]"').find('option[value="'+no+'"]');
        $.each(options, function (i, v) {
            let option = $(v);
            let select = option.parent();
            let valueSelected = select.val();
            option.remove();
            if(no == valueSelected){
                select.val(null);
            }
            else{
                select.val(valueSelected);
            }
        });

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

    $(document).ready(function () 
    {
        $('textarea.summernote').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });

        $('#popup-create-speaker').on('input', ':text', function(){ 
            let name = $('#popup-create-speaker').find('input[name="speakerNames[]"]').val();
            let position = $('#popup-create-speaker').find('input[name="speakerPositions[]"]').val();
            if(name != null && position != null && name != '' && position != ''){
                $('#popup-create-speaker__create-btn').prop('disabled', false);
            }
            else{
                $('#popup-create-speaker__create-btn').prop('disabled', true);
            }
        });

        $('#popup-create-agenda').on('input', ':text', function(){ 
            let title = $('#popup-create-agenda').find('input[name="detailTitles[]"]').val();
            let speaker = $('#popup-create-agenda').find('select[name="detailSpeakerNos[]"]').val();
            if(title != null && speaker != null && title != '' && speaker != ''){
                $('#popup-create-agenda__create-btn').prop('disabled', false);
            }
            else{
                $('#popup-create-agenda__create-btn').prop('disabled', true);
            }
        });

        $('#popup-create-agenda').find('select').change(function(){ 
            let title = $('#popup-create-agenda').find('input[name="detailTitles[]"]').val();
            let speaker = $('#popup-create-agenda').find('select[name="detailSpeakerNos[]"]').val();
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

