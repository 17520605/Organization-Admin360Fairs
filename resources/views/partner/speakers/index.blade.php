@extends('layouts.partner')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Speakers</h1>
            <div class="div_cardheader_btn" >
                <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-create-speaker"><i class="fas fa-plus"></i> Add </button>
                <button class="mb-0 btn float-right" id="btn-send-mail-speaker"  data-toggle="modal" data-target="#popup-confirm-send-email" style="display: none"><i class="fas fa-paper-plane"></i> Send Mail </button>
                <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-import-csv"><i class="fas fa-upload"></i> Import </button>
            </div>
        </div>
        <div class="card-body" style="border: none !important;">
            <div class="row mb-3">
                <div class="col-6 tag-header"  data-tag="my">My Speakers</div>
                <div class="col-6 tag-header" data-tag="all">All Speakers</div>
            </div>
            <div class="table-responsive tag-body tag-body-all" style="display: none">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="background: #eef2f7">
                            <th style="width: 40px;">
                                <input class="checkbox-all form-check-input1 dt-checkboxes" type="checkbox" name="all">
                            </th>
                            <th style="width: 6%;">Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Invited by</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($invitations as $invitation)
                        <tr class="speaker-{{$invitation->speaker->id}}">
                            <td>
                                @if ($invitation->status == \App\Models\Tour_Speaker::UNCONFIRMED)
                                     <input class="checkbox form-check-input1 dt-checkboxes" type="checkbox" value="{{$invitation->speaker->id}}" name="speakerIds[]">
                                @else
                                    <input class="form-check-input1 dt-checkboxes"  type="checkbox" style="opacity: 0.3" checked disabled>
                                @endif
                            </td>
                            <td style="text-align: center">
                                <div><img class="rounded-circle avatar-xs" src="{{$invitation->speaker->avatar != null ? $invitation->speaker->avatar : 'https://res.cloudinary.com/virtual-tour/image/upload/v1634539139/icons/default_avatar_k3wxez.png' }}" alt=""></div>
                            </td>
                            <td>{{$invitation->speaker->name}}</td>
                            <td>{{$invitation->speaker->email}}</td>
                            <td>{{$invitation->speaker->contact}}</td>
                            <td>{{$invitation->inviter != null ? $invitation->inviter->name : 'N/A'}}</td>
                            <td>
                                @if ($invitation->status == "confirmed")
                                    <span class="badge bg-danger">{{$invitation->status}} </span>
                                @elseif($invitation->status == "unconfirmed")
                                    <span class="badge bg-success">{{$invitation->status}} </span>
                                @elseif($invitation->status == "sent email")
                                    <span class="badge bg-warning">{{$invitation->status}} </span>
                                @endif
                            </td>
                            <td class="btn-action-icon">
                                <a href="/partner/tours/1/speakers/{{$invitation->speaker->id}}/calendar"><i class="fas fa-calendar-week event"></i></a>
                                @if($invitation->status == "unconfirmed")
                                <i class="fas fa-pen edit" data-speaker-id="{{$invitation->speaker->id}}" data-speaker-name="{{$invitation->speaker->name}}" data-speaker-email="{{$invitation->speaker->email}}" data-speaker-contact="{{$invitation->speaker->contact}}" onclick="onOpenPopupEditSpeaker(this);"></i>
                                <i class="fas fa-trash-alt delete" data-speaker-id="{{$speaker->id}}" onclick="onOpenPopupDeleteSpeaker(this);"></i>
                                @elseif($invitation->status == "sent email")
                                <i class="fas fa-pen edit" style="opacity: 0.3;pointer-events: none"></i>
                                <i class="fas fa-trash-alt delete" data-speaker-id="{{$invitation->speaker->id}}" onclick="onOpenPopupDeleteSpeaker(this);"></i>
                                @elseif($invitation->status == "confirmed")
                                <i class="fas fa-pen edit" style="opacity: 0.3;pointer-events: none"></i>
                                <i class="fas fa-trash-alt delete"  style="opacity: 0.3;pointer-events: none"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive tag-body tag-body-my" style="display: block">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="background: #eef2f7">
                            <th style="width: 40px;">
                                <input class="checkbox-all form-check-input1 dt-checkboxes" type="checkbox" name="all">
                            </th>
                            <th style="width: 6%;">Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Invited by</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($myInvitations as $invitation)
                        <tr class="speaker-{{$invitation->speaker->id}}">
                            <td>
                                @if ($invitation->status == \App\Models\Tour_Speaker::UNCONFIRMED)
                                     <input class="checkbox form-check-input1 dt-checkboxes" type="checkbox" value="{{$invitation->speaker->id}}" name="speakerIds[]">
                                @else
                                    <input class="form-check-input1 dt-checkboxes"  type="checkbox" style="opacity: 0.3" checked disabled>
                                @endif
                            </td>
                            <td style="text-align: center">
                                <div><img class="rounded-circle avatar-xs" src="{{$invitation->speaker->avatar != null ? $invitation->speaker->avatar : 'https://res.cloudinary.com/virtual-tour/image/upload/v1634539139/icons/default_avatar_k3wxez.png' }}" alt=""></div>
                            </td>
                            <td>{{$invitation->speaker->name}}</td>
                            <td>{{$invitation->speaker->email}}</td>
                            <td>{{$invitation->speaker->contact}}</td>
                            <td>{{$invitation->inviter != null ? $invitation->inviter->name : 'N/A'}}</td>
                            <td>
                                @if ($invitation->status == "confirmed")
                                    <span class="badge bg-danger">{{$invitation->status}} </span>
                                @elseif($invitation->status == "unconfirmed")
                                    <span class="badge bg-success">{{$invitation->status}} </span>
                                @elseif($invitation->status == "sent email")
                                    <span class="badge bg-warning">{{$invitation->status}} </span>
                                @endif
                            </td>
                            <td class="btn-action-icon">
                                <a href="/partner/tours/1/speakers/{{$invitation->speaker->id}}/calendar"><i class="fas fa-calendar-week event"></i></a>
                                @if($invitation->status == "unconfirmed")
                                <i class="fas fa-pen edit" data-speaker-id="{{$invitation->speaker->id}}" data-speaker-name="{{$invitation->speaker->name}}" data-speaker-email="{{$invitation->speaker->email}}" data-speaker-contact="{{$invitation->speaker->contact}}" onclick="onOpenPopupEditSpeaker(this);"></i>
                                <i class="fas fa-trash-alt delete" data-speaker-id="{{$speaker->id}}" onclick="onOpenPopupDeleteSpeaker(this);"></i>
                                @elseif($invitation->status == "sent email")
                                <i class="fas fa-pen edit" style="opacity: 0.3;pointer-events: none"></i>
                                <i class="fas fa-trash-alt delete" data-speaker-id="{{$invitation->speaker->id}}" onclick="onOpenPopupDeleteSpeaker(this);"></i>
                                @elseif($invitation->status == "confirmed")
                                <i class="fas fa-pen edit" style="opacity: 0.3;pointer-events: none"></i>
                                <i class="fas fa-trash-alt delete"  style="opacity: 0.3;pointer-events: none"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- POPUP CREATE SPEAKER --}}
<div class="modal fade" id="popup-create-speaker" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-create-speaker__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Create Speaker </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Enter speaker name" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter speaker name
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Enter email" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter email
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Contact</label>
                        <input type="tel" name="contact" class="form-control form-control-user" id="contact" placeholder="Enter Contact" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter contact
                        </div>
                    </div>
                    <div class="form-group messages-wrapper border" style="display: none">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- POPUP EDIT SPEAKER --}}
<div class="modal fade" id="popup-edit-speaker" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-edit-speaker__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Edit Speaker </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    @csrf
                    <input id="popup-edit-speaker__id-hidden-input" type="hidden" name="id">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-user" id="popup-edit-speaker__name-input" placeholder="Enter speaker name" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter speaker name
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-user" id="popup-edit-speaker__email-input" placeholder="Enter email" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter email
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Contact</label>
                        <input type="tel" name="contact" class="form-control form-control-user" id="popup-edit-speaker__contact-input" placeholder="Enter Contact" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter contact
                        </div>
                    </div>
                    <div class="form-group messages-wrapper border" style="display: none">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- POPUP DELETE PARTICIANT --}}
<div class="modal fade" id="popup-confirm-delete-speaker" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="popup-edit-speaker__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Delete Speaker </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <p>Do you really want to delete it?</p>
                </div>
                <div class="modal-footer" style="padding: 0">
                    <input id="popup-confirm-delete-speaker__id-hidden-input" type="hidden">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="popup-confirm-delete-speaker__delete-btn" type="button" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- POPUP CONFIRM SENT EMAIL --}}
<div class="modal fade" id="popup-confirm-send-email" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light">Send Email</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px">
                <div class="form-group p-3">
                    <span>You sure to send emails to Speaker</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" type="submit">Cancel</button>
                <button id="popup-confirm-send-email__send-btn" class="btn btn-primary" type="submit">Send</button>
            </div>
        </div>
    </div>
</div>
{{-- POPUP IMPORT CSV --}}
<div class="modal fade" id="popup-import-csv" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-import-csv__form">
                <div class="modal-header">
                    <h5 class="fw-light">Import Speaker </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">File CSV</label>
                        <input id="popup-import-csv__file-input" type="file" name="csv" accept=".csv"  class="form-control" required>
                        <div class="invalid-feedback">
                            Please choose file CSV
                        </div>
                    </div>
                    <div class="form-group messages-wrapper border" style="display: none">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="popup-import-csv__check-btn" class="btn btn-primary" type="submit">Check</button>
                    <button id="popup-import-csv__save-btn" class="btn btn-primary" type="submit" style="display: none">Save Change</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        "use strict";
        window.addEventListener(
            "load",
            function () {
                var forms = document.getElementsByClassName("needs-validation");
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
</script>
<script>
    function onOpenPopupEditSpeaker(target){
        let speakerId = $(target).attr('data-speaker-id');
        let name = $(target).attr('data-speaker-name');
        let email = $(target).attr('data-speaker-email');
        let contact = $(target).attr('data-speaker-contact');

        $('#popup-edit-speaker__id-hidden-input').val(speakerId);
        $('#popup-edit-speaker__name-input').val(name);
        $('#popup-edit-speaker__email-input').val(email);
        $('#popup-edit-speaker__contact-input').val(contact);

        $('#popup-edit-speaker').modal('show');
    }

    function onOpenPopupDeleteSpeaker(target){
        let speakerId = $(target).attr('data-speaker-id');
        $('#popup-confirm-delete-speaker__id-hidden-input').val(speakerId);
        $('#popup-confirm-delete-speaker').modal('show');
    }
</script>
<script>
    $(document).ready(function () {
        $('#popup-create-speaker__form').submit(function (e) { 
            if(this.checkValidity() == false) return;
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/administrator/tours/{{$tour->id}}/speakers/save-create",
                data: data,
                dataType: 'json',
                success: function (response) {
                    if(response.success == 1){
                        location.reload();
                    }
                    else{
                        $('#popup-create-speaker').find('.messages-wrapper').empty();
                        $('#popup-create-speaker').find('.messages-wrapper').show();
                        Object.keys(response.errors).forEach(key => {
                            let wrapper = $(
                                `<div class="p-3">
                                    <span> `+response.errors[key]+` </span>
                                </div>
                            `);
                            $('#popup-create-speaker').find('.messages-wrapper').append(wrapper);
                        });
                    }
                }
            });
        });
        
        $('#popup-edit-speaker__form').submit(function (e) { 
            if(this.checkValidity() == false) return;
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/administrator/tours/{{$tour->id}}/speakers/save-edit",
                data: data,
                dataType: 'json',
                success: function (response) {
                    if(response.success == 1){
                        location.reload();
                    }
                    else{
                        $('#popup-edit-speaker').find('.messages-wrapper').empty();
                        $('#popup-edit-speaker').find('.messages-wrapper').show();
                        Object.keys(response.errors).forEach(key => {
                            let wrapper = $(
                                `<div class="p-3">
                                    <span> `+response.errors[key]+` </span>
                                </div>
                            `);
                            $('#popup-edit-speaker').find('.messages-wrapper').append(wrapper);
                        });
                    }
                }
            });
        });

        $('#popup-import-csv__check-btn').click(function (e) { 

            let form = document.getElementById('popup-import-csv__form');
            if(form.checkValidity() == false) return;

            e.preventDefault();
            let file = document.getElementById('popup-import-csv__file-input').files[0];
            let data = new FormData();
            data.append('csv', file);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/administrator/tours/{{$tour->id}}/speakers/check-import-csv",
                method: 'post',
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                success: function (res) {
                    $('#popup-import-csv').find('.messages-wrapper').empty();
                    $('#popup-import-csv').find('.messages-wrapper').show();
                    if(res.success == 1){
                        $('#popup-import-csv').find('.messages-wrapper').append(`
                            <div> Success : `+ res.correctCount + ` / `+ res.totalCount +` lines </div>
                        `);

                        $('#popup-import-csv__check-btn').hide();
                        $('#popup-import-csv__save-btn').show();
                    }
                    else{
                        let wrapper = $(`<div class="p-3"> <ul></ul> </div>`);
                        Object.keys(res.errors).forEach(line => {
                            wrapper.find('ul').append(`
                                <li> Line ` + line + ` : ` + Object.values(res.errors[line]).join(", ") + `</li>
                            `)
                        });
                        $('#popup-import-csv').find('.messages-wrapper').append(wrapper);
                    }
                }
            });
        });

        $('#popup-import-csv').on('hidden.bs.modal', function () {  
            $('#popup-import-csv__file-input').val(null);
            $('#popup-import-csv').find('.messages-wrapper').hide();
            $('#popup-import-csv__check-btn').show();
            $('#popup-import-csv__save-btn').hide();
        });

        $('#popup-import-csv__save-btn').click(function (e) { 
            let form = document.getElementById('popup-import-csv__form');
            if(form.checkValidity() == false) return;

            e.preventDefault();
            let file = document.getElementById('popup-import-csv__file-input').files[0];
            let data = new FormData();
            data.append('csv', file);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/administrator/tours/{{$tour->id}}/speakers/import-csv",
                method: 'post',
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                success: function (res) {
                    if(res == 1){
                        location.reload();
                    }
                    else{
                        console.log(res);
                    }
                }
            });
        });

        $('.checkbox-all').change(function () {
            let checked = $(this).prop('checked');  
            $('.checkbox').prop('checked', checked);
            if(checked == true)
            {
                if(checked > 0)
                {
                    $('#btn-send-mail-speaker').show();
                }
                else{
                    $('#btn-send-mail-speaker').hide();
                }
            }
            else{
                $('#btn-send-mail-speaker').hide();
            }
        })

        $('.checkbox').change(function () {
            let totalCount = $('.checkbox').length;
            let checkedCount = $('.checkbox:checked').length;
            if(checkedCount > 0)
            {
                $('#btn-send-mail-speaker').show();
            }
            else if(checkedCount < 1){

                $('#btn-send-mail-speaker').hide();
            }
            if(totalCount == checkedCount)
            {
                $('.checkbox-all').prop('checked', true);
            }
            else{
                $('.checkbox-all').prop('checked', false);
            }
        })

        $('#popup-confirm-send-email__send-btn').click(function () {  
            
            let data = new FormData();
            let checkboxs = $('.checkbox:checked');
            $.each(checkboxs, function (i, checkbox) {  
                data.append('speakerIds[]', checkbox.value);
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/administrator/tours/{{$tour->id}}/speakers/send-emails",
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (res) {
                    if(res == 1){
                        location.reload();
                    }
                }
            });
        })

        $('#popup-confirm-delete-speaker__delete-btn').click(function (){
            let id = $('#popup-confirm-delete-speaker__id-hidden-input').val();
            if(id != null && id != ""){
                let ajax = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/speakers/" + id,
                    type: 'delete',
                    dataType: 'json',
                    success: function (res) { 
                        if (res == 1) {
                            $('#popup-confirm-delete-speaker').modal('hide');
                            let row = $('.speaker-' + id);
                            let wrapper = row.parent();
                            row.remove();
                            if(wrapper.children().length == 0){
                                wrapper.append(`
                                    <tr>
                                        <td colspan="10"><center><span>No speakers</span></center></td>
                                    </tr>
                                `);
                            }
                        }
                    }
                });
            }
        });

        $('.tag-header').click(function(){
            let tag = $(this).attr('data-tag');
            $('.tag-body').hide();
            $('.tag-body-' + tag).show();
        });
    });
</script>
@endsection
