@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Partners</h1>
            <div class="div_cardheader_btn" >
                <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-create-partner"><i class="fas fa-plus"></i> Add </button>
                <button class="mb-0 btn float-right" id="btn-send-mail-partners" data-toggle="modal" data-target="#popup-confirm-send-email" style="display: none"><i class="fas fa-paper-plane"></i> Send Mail </button>
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
                        @foreach ($partners as $partner)
                        <tr class="partner-{{$partner->id}}">
                            <td>
                                @if ($partner->status == \App\Models\Tour_Partner::UNCONFIRMED)
                                    <input class="checkbox form-check-input1 dt-checkboxes" type="checkbox" value="{{$partner->id}}" name="partnerIds[]">
                                @else
                                    <input class="form-check-input1 dt-checkboxes"  type="checkbox" style="opacity: 0.3" checked disabled>
                                @endif
                            </td>
                            <td style="text-align: center">1</td>
                            <td style="text-align: center">
                                <div><img class="rounded-circle avatar-xs" src="https://res.cloudinary.com/virtual-tour/image/upload/v1634539139/icons/default_avatar_k3wxez.png" alt=""></div>
                            </td>
                            <td>{{$partner->name}}</td>
                            <td>{{$partner->email}}</td>
                            <td>{{$partner->contact}}</td>
                            <td>
                                @if ($partner->status == "confirmed")
                                    <span class="badge bg-danger">{{$partner->status}} </span>
                                @elseif($partner->status == "unconfirmed")
                                    <span class="badge bg-success">{{$partner->status}} </span>
                                @elseif($partner->status == "sent email")
                                    <span class="badge bg-warning">{{$partner->status}} </span>
                                @endif
                            </td>
                            <td class="btn-action-icon">
                                @if($partner->status == "unconfirmed")
                                    <i class="fas fa-pen edit"  data-partner-id="{{$partner->id}}" data-partner-name="{{$partner->name}}" data-partner-email="{{$partner->email}}" data-partner-contact="{{$partner->contact}}" onclick="onOpenPopupEditPartner(this);"></i>
                                    <i class="fas fa-trash-alt delete" data-partner-id="{{$partner->id}}" onclick="onOpenPopupDeletePartner(this);"></i>
                                @elseif($partner->status == "sent email")
                                    <i class="fas fa-pen edit" style="opacity: 0.3;pointer-events: none"></i>
                                    <i class="fas fa-trash-alt delete" data-partner-id="{{$partner->id}}" onclick="onOpenPopupDeletePartner(this);"></i>                           
                                @elseif($partner->status == "confirmed")
                                    <i class="fas fa-pen edit" style="opacity: 0.3;pointer-events: none"></i>
                                    <i class="fas fa-trash-alt delete" style="opacity: 0.3;pointer-events: none"></i>
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
{{-- POPUP CREATE PARTICIANT --}}
<div class="modal fade" id="popup-create-partner" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-create-partner__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Create Partner </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Enter partner name" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter partner name
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
<div class="modal fade" id="popup-edit-partner" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-edit-partner__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Edit Partner </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px">
                    @csrf
                    <input id="popup-edit-partner__id-hidden-input" type="hidden" name="partnerId">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-user" id="popup-edit-partner__name-input" placeholder="Enter partner name" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter partner name
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-user" id="popup-edit-partner__email-input" placeholder="Enter email" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter email
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Contact</label>
                        <input type="tel" name="contact" class="form-control form-control-user" id="popup-edit-partner__contact-input" placeholder="Enter Contact" aria-describedby="inputGroupPrepend" required>
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
<div class="modal fade" id="popup-confirm-delete-partner" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="popup-edit-partner__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Delete Partner </h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <p>Do you really want to delete it?</p>
                </div>
                <div class="modal-footer" style="padding: 0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="popup-confirm-delete-partner__delete-btn">Delete</button>
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
                    <h5 class="fw-light">Import Partner </h5>
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
                    <span>You sure to send emails to partners</span>
                </div>
            </div>
            <div class="modal-footer">
                <input id="popup-confirm-delete-partner__id-hidden-input" type="hidden">
                <button class="btn" type="submit">Cancel</button>
                <button id="popup-confirm-send-email__send-btn" class="btn btn-primary" type="submit">Send</button>
            </div>
        </div>
    </div>
</div>
<script>
    function onOpenPopupEditPartner(target){
        let partnerId = $(target).attr('data-partner-id');
        let name = $(target).attr('data-partner-name');
        let email = $(target).attr('data-partner-email');
        let contact = $(target).attr('data-partner-contact');

        $('#popup-edit-partner__id-hidden-input').val(partnerId);
        $('#popup-edit-partner__name-input').val(name);
        $('#popup-edit-partner__email-input').val(email);
        $('#popup-edit-partner__contact-input').val(contact);
        $('#popup-edit-partner').modal('show');
    }

    function onOpenPopupDeletePartner(target){
        let partnerId = $(target).attr('data-partner-id');
        $('#popup-confirm-delete-partner__id-hidden-input').val(partnerId);
        $('#popup-confirm-delete-partner').modal('show');
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
        $('#popup-create-partner__form').submit(function (e) { 
            if(this.checkValidity() == false) return;
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/administrator/tours/{{$tour->id}}/partners/save-create",
                data: data,
                dataType: 'json',
                success: function (response) {
                    if(response.success == 1){
                        location.reload();
                    }
                    else{
                        $('#popup-create-partner').find('.messages-wrapper').empty();
                        $('#popup-create-partner').find('.messages-wrapper').show();
                        Object.keys(response.errors).forEach(key => {
                            let wrapper = $(
                                `<div class="p-3">
                                    <span> `+response.errors[key]+` </span>
                                </div>
                            `);
                            $('#popup-create-partner').find('.messages-wrapper').append(wrapper);
                        });
                    }
                }
            });
        });

        $('#popup-edit-partner__form').submit(function (e) { 
            if(this.checkValidity() == false) return;
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/administrator/tours/{{$tour->id}}/partners/save-edit",
                data: data,
                dataType: 'json',
                success: function (response) {
                    if(response.success == 1){
                        location.reload();
                    }
                    else{
                        $('#popup-edit-partner').find('.messages-wrapper').empty();
                        $('#popup-edit-partner').find('.messages-wrapper').show();
                        Object.keys(response.errors).forEach(key => {
                            let wrapper = $(
                                `<div class="p-3">
                                    <span> `+response.errors[key]+` </span>
                                </div>
                            `);
                            $('#popup-edit-partner').find('.messages-wrapper').append(wrapper);
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
                url: "/administrator/tours/{{$tour->id}}/partners/check-import-csv",
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
                url: "/administrator/tours/{{$tour->id}}/partners/import-csv",
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
            let checkedCount = $('.checkbox:enabled:checked');
            if(checked == true)
            {
                if(checkedCount > 0)
                {
                    $('#btn-send-mail-partners').show();
                }
                else{
                    $('#btn-send-mail-partners').hide();
                }
            }
            else{
                $('#btn-send-mail-partners').hide();
            }
            
        })

        $('.checkbox').change(function () {
            let totalCount = $('.checkbox').length;
            let checkedCount = $('.checkbox:checked').length;
            if(checkedCount > 0)
            {
                $('#btn-send-mail-partners').show();
            }
            else if(checkedCount < 1){

                $('#btn-send-mail-partners').hide();
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
            let checkboxs = $('.checkbox:enabled:checked');
            $.each(checkboxs, function (i, checkbox) {  
                data.append('partnerIds[]', checkbox.value);
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/administrator/tours/{{$tour->id}}/partners/send-emails",
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

        $('#popup-confirm-delete-partner__delete-btn').click(function (){
            let id = $('#popup-confirm-delete-partner__id-hidden-input').val();
            if(id != null && id != ""){
                let ajax = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/partners/" + id,
                    type: 'delete',
                    dataType: 'json',
                    success: function (res) { 
                        if (res == 1) {
                            $('#popup-confirm-delete-partner').modal('hide');
                            let row = $('.partner-' + id);
                            let wrapper = row.parent();
                            row.remove();
                            if(wrapper.children().length == 0){
                                wrapper.append(`
                                    <tr>
                                        <td colspan="10"><center><span>No partners</span></center></td>
                                    </tr>
                                `);
                            }
                        }
                    }
                });
            }
        });
    });
</script>
@endsection
