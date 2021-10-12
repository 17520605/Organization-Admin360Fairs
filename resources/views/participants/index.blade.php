@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="mb-0 font-weight-bold text-primary float-left">Participants</h6>
            <h6 class="mb-0 btn float-right" data-toggle="modal" data-target="#popup-create-participant"><i class="fas fa-plus"></i> Add </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th style="width: 100px">Location</th>
                            <th style="width: 80px;">Status</th>
                            <th style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Brielle Williamson</td>
                            <td>nguyenhuuminhkhai@gmail.com</td>
                            <td>0969888999</td>
                            <td>Hà nội</td>
                            <td>Joinded</td>
                            <td>
                                <a class="mr-2"><i class="fa fa-pen"></i></a>
                                <a class="mr-0"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="popup-create-participant" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation" action="participants/save"  method="POST" novalidate>
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
                    <div class="form-group">
                        <label for="name" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control form-control-user" id="address" placeholder="Enter address" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please enter participant address
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
@endsection
