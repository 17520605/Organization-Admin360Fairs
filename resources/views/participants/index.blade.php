@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Participants</h1>
            <div class="div_cardheader_btn" >
                <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-create-participant"><i class="fas fa-plus"></i> Add </button>
                <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-create-participant"><i class="fas fa-paper-plane"></i> Send Mail </button>
                <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-import-csv"><i class="fas fa-upload"></i> Import </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <input class="checkbox-all" type="checkbox" name="all">
                            </th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th style="width: 80px;">Status</th>
                            <th style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $participant)
                        <tr>
                            <td>
                                <input class="checkbox" type="checkbox" value="{{$participant->id}}" name="participantIds[]">
                            </td>
                            <td>1</td>
                            <td>{{$participant->name}}</td>
                            <td>{{$participant->email}}</td>
                            <td>{{$participant->contact}}</td>
                            <td>Joinded</td>
                            <td>
                                <a class="mr-2"><i class="fa fa-pen"></i></a>
                                <a class="mr-0"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" id="popup-create-participant" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-create-participant__form" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="fw-light">Create Participant </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

{{-- POPUP IMPORT CSV --}}
<div class="modal fade" id="popup-import-csv" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="popup-import-csv__form">
                <div class="modal-header">
                    <h5 class="fw-light">Import Participant </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                url: "/tours/{{$tour->id}}/participants/save-create",
                data: data,
                dataType: 'json',
                success: function (response) {
                    if(response.success == 1){
                        location.reload();
                    }
                    else{
                        $('#popup-create-participant').find('.messages-wrapper').empty();
                        $('#popup-create-participant').find('.messages-wrapper').show();
                        let wrapper = $(
                            `<div class="p-3">
                                <span> `+response.error+` </span>
                            </div>
                        `);
                        $('#popup-create-participant').find('.messages-wrapper').append(wrapper);
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
                url: "/tours/{{$tour->id}}/participants/check-import-csv",
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
                url: "/tours/{{$tour->id}}/participants/import-csv",
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

    });
</script>
@endsection
