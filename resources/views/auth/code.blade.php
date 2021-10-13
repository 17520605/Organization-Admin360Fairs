@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="height: 100vh;align-items: center;">
            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4" style="color: #4e73df;">Information verification !</h1>
                                        <p class="text-muted font-size-14 mb-4">Enter your code to verify the account is correct. <br> The verification code we send in your email</p>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="XXXX-XXXX-XXXX" style="text-align: center;font-size: 20px;color: #222; text-transform: uppercase;">
                                        </div>
                                        <a href="#" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-paper-plane" style="margin-right: 10px;"></i> Code verification
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
