@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Participants</h1>
            <div class="div_cardheader_btn" >
                <button class="mb-0 btn float-right active" data-toggle="modal" data-target="#popup-create-participant"><i class="fas fa-plus"></i> Add </button>
                <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-create-participant"><i class="fas fa-paper-plane"></i> Send Mail </button>
                <button class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-create-participant"><i class="fas fa-upload"></i> Import </button>
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
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Change</button>
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
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/tours/{{$tour->id}}/participants/save-create",
                data: data,
                success: function (response) {
                    if(response == true || response == "1"){
                        location.reload();
                    }
                    else{
                        alert(response);
                    }
                }
            });
        });
    });
</script>
@endsection
