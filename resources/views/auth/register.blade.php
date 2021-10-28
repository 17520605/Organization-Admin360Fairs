@extends('layouts.auth')

@section('content')
    <div class="container" style="height: 100vh;align-items: center;">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>
                                    <form class="user form-signin needs-validation" method="POST" action="{{env('APP_URL')}}/register" novalidate>
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="firstname" class="form-control form-control-user" id="firstname" placeholder="First Name" aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Please enter first name.
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="lastname" class="form-control form-control-user" id="lastname" placeholder="Last Name" aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Please enter last name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email Address" aria-describedby="inputGroupPrepend" required>
                                            <div class="invalid-feedback">
                                                Please enter email.
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Please enter password.
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" id="repassword" placeholder="Repeat Password" aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Password not a match.
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" href="login.html" class="btn btn-primary btn-user btn-block">
                                            Register Account
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.html">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
    <script>
        // $("#password, #repassword").on("keyup", function () {
        //     if (
        //         $("#newPassword").val() != "" &&
        //         $("#confirmPassword").val() != "" &&
        //         $("#confirmPassword").val() == $("#confirmPassword").val()
        //     ) {
        //     }
        // });

        // Example starter JavaScript for disabling form submissions if there are invalid fields
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

    </script>
@endsection
