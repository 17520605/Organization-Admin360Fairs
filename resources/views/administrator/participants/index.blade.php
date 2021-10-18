@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Participants</h1>
            <div class="div_cardheader_btn" >
                <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-create-participant"><i class="fas fa-plus"></i> Add </button>
                <button class="mb-0 btn float-right" id="btn-send-mail-participants" data-toggle="modal" data-target="#popup-confirm-send-email" style="display: none"><i class="fas fa-paper-plane"></i> Send Mail </button>
                <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-import-csv"><i class="fas fa-upload"></i> Import </button>
            </div>
        </div>
        <div class="card-body" style="border: none !important;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="background: #eef2f7">
                            <th style="width: 40px;">
                                <input class="checkbox-all form-check-input1 dt-checkboxes" type="checkbox" name="all">
                            </th>
                            <th style="text-align: center">#</th>
                            <th style="width: 8%;">Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 8%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $participant)
                        <tr>
                            <td>
                                @if ($participant->status == \App\Models\Tour_Participant::UNCONFIRMED)
                                    <input class="checkbox form-check-input1 dt-checkboxes" type="checkbox" value="{{$participant->id}}" name="participantIds[]">
                                @else
                                    <input class="form-check-input1 dt-checkboxes" type="checkbox" style="opacity: 0.3" checked disabled>
                                @endif
                            </td>
                            <td style="text-align: center">1</td>
                            <td style="text-align: center">
                                <div><img class="rounded-circle avatar-xs" src="https://res.cloudinary.com/virtual-tour/image/upload/v1634539139/icons/default_avatar_k3wxez.png" alt=""></div>
                            </td>
                            <td>{{$participant->name}}</td>
                            <td>{{$participant->email}}</td>
                            <td>{{$participant->contact}}</td>
                            <td>
                                @if ($participant->status == "confirmed")
                                    <span class="badge bg-danger">{{$participant->status}} </span>
                                @elseif($participant->status == "unconfirmed")
                                    <span class="badge bg-success">{{$participant->status}} </span>
                                @elseif($participant->status == "sent email")
                                    <span class="badge bg-warning">{{$participant->status}} </span>
                                @endif
                            </td>
                            <td class="btn-action-icon">
                                <i class="fas fa-pen edit" data-participant-id="{{$participant->id}}" data-participant-name="{{$participant->name}}" data-participant-email="{{$participant->email}}" data-participant-contact="{{$participant->contact}}" onclick="onOpenPopupEditParticipant(this);"></i>
                                <i class="fas fa-trash-alt delete" data-participant-id="{{$participant->id}}" onclick="onOpenPopupDeleteParticipant(this);"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- POPUP CREATE PARTICIANT --}}
<div class="modal fade" id="popup-create-participant" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-create-participant__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Create Participant </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Enter participant name" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter participant name
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
{{-- POPUP EDIT PARTICIANT --}}
<div class="modal fade" id="popup-edit-participant" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-edit-participant__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Edit Participant </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    @csrf
                    <input id="popup-edit-participant__id-hidden-input" type="hidden" name="participantId">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-user" id="popup-edit-participant__name-input" placeholder="Enter participant name" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter participant name
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-user" id="popup-edit-participant__email-input" placeholder="Enter email" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter email
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Contact</label>
                        <input type="tel" name="contact" class="form-control form-control-user" id="popup-edit-participant__contact-input" placeholder="Enter Contact" aria-describedby="inputGroupPrepend" required>
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
<div class="modal fade" id="popup-delete-participant" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="popup-edit-participant__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Delete Participant </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <p>Do you really want to delete it?</p>
                </div>
                <div class="modal-footer" style="padding: 0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- POPUP IMPORT CSV --}}
<div class="modal fade" id="popup-import-csv" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-import-csv__form">
                <div class="modal-header">
                    <h5 class="fw-light">Import Participant </h5>
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
{{-- POPUP CONFIRM SENT EMAIL --}}
<div class="modal fade" id="popup-confirm-send-email" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light">Send Email</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px">
                <div class="form-group p-3">
                    <span>You sure to send emails to participants</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" type="submit">Cancel</button>
                <button id="popup-confirm-send-email__send-btn" class="btn btn-primary" type="submit">Send</button>
            </div>
        </div>
    </div>
</div>
<script>
    function onOpenPopupEditParticipant(target){
        let participantId = $(target).attr('data-participant-id');
        let name = $(target).attr('data-participant-name');
        let email = $(target).attr('data-participant-email');
        let contact = $(target).attr('data-participant-contact');

        $('#popup-edit-participant__id-hidden-input').val(participantId);
        $('#popup-edit-participant__name-input').val(name);
        $('#popup-edit-participant__email-input').val(email);
        $('#popup-edit-participant__contact-input').val(contact);
        $('#popup-edit-participant').modal('show');
    }

    function onOpenPopupDeleteParticipant(target){
        let participantId = $(target).attr('data-participant-id');
        $('#popup-confirm-delete-participant__id-hidden-input').val(participantId);
        $('#popup-confirm-delete-participant').modal('show');
    }
</script>
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
    $(document).ready(function () {
        $('#popup-create-participant__form').submit(function (e) { 
            if(this.checkValidity() == false) return;
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/administrator/tours/{{$tour->id}}/participants/save-create",
                data: data,
                dataType: 'json',
                success: function (response) {
                    if(response.success == 1){
                        location.reload();
                    }
                    else{
                        $('#popup-create-participant').find('.messages-wrapper').empty();
                        $('#popup-create-participant').find('.messages-wrapper').show();
                        Object.keys(response.errors).forEach(key => {
                            let wrapper = $(
                                `<div class="p-3">
                                    <span> `+response.errors[key]+` </span>
                                </div>
                            `);
                            $('#popup-create-participant').find('.messages-wrapper').append(wrapper);
                        });
                    }
                }
            });
        });

        $('#popup-edit-participant__form').submit(function (e) { 
            if(this.checkValidity() == false) return;
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/administrator/tours/{{$tour->id}}/participants/save-edit",
                data: data,
                dataType: 'json',
                success: function (response) {
                    if(response.success == 1){
                        location.reload();
                    }
                    else{
                        $('#popup-edit-participant').find('.messages-wrapper').empty();
                        $('#popup-edit-participant').find('.messages-wrapper').show();
                        Object.keys(response.errors).forEach(key => {
                            let wrapper = $(
                                `<div class="p-3">
                                    <span> `+response.errors[key]+` </span>
                                </div>
                            `);
                            $('#popup-edit-participant').find('.messages-wrapper').append(wrapper);
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
                url: "/administrator/tours/{{$tour->id}}/participants/check-import-csv",
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
                                <li> Line ` + line + ` : ` + res.errors[line] + `</li>
                            `)
                        });
                        $('#popup-import-csv').find('.messages-wrapper').append(wrapper);
                    }
                }
            });
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
                url: "/administrator/tours/{{$tour->id}}/participants/import-csv",
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
                $('#btn-send-mail-participants').show();
            }
            else{
                $('#btn-send-mail-participants').hide();
            }
            
        })

        $('.checkbox').change(function () {
            let totalCount = $('.checkbox').length;
            let checkedCount = $('.checkbox:checked').length;
            if(checkedCount > 0)
            {
                $('#btn-send-mail-participants').show();
            }
            else if(checkedCount < 1){

                $('#btn-send-mail-participants').hide();
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
                data.append('participantIds[]', checkbox.value);
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/administrator/tours/{{$tour->id}}/participants/send-emails",
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


    });
</script>
@endsection
