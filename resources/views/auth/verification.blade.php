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
                                    <form id="form" class="user" action="confirmation" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$tour_participant->id}}">
                                        <div class="form-group">
                                            <input type="text" name="code" class="form-control form-control-user" maxlength="6" placeholder="_ _ _ _ _ _" style="text-align: center;font-size: 20px;color: #222;">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-paper-plane" style="margin-right: 10px;"></i> Code verification
                                        </button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="/forgot-password">Re-send</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('#form').submit(function (e) {  
                if(this.checkValidity() == false) return;
                e.preventDefault();
                let data = $(this).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/partner/confirmation",
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if(response.success == true){
                            window.location.href = "/init-password?email={{$tour_participant->email}}"
                        }
                        else{
                            if(response.incorrectCount <= 3){
                                alert('Code k hop le')
                            }
                            else{
                                alert('Nhap qua so lan cho phep')
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
