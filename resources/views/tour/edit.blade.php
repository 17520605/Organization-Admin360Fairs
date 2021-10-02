@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <section class="content">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Tour Picture</div>
                        <div class="card-body text-center">
                            <img class=" mb-2" style="width: 100%;" src="https://gconnect.edu.vn/wp-content/uploads/2016/06/bg-slide-01.jpg" alt="">
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <button class="btn btn-primary" type="button">Upload new image</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Tour Edit</div>
                        <div class="card-body">
                            <form id="tour-form" class="form-signin needs-validation" action="/tours/{{$tour->id}}/tour/save-edit" method="post" novalidate>
                                @csrf 
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername"></label>
                                    <input class="form-control" id="inputUsername" type="text" name="name" value="{{$tour->name}}" placeholder="Enter Tour Name" required>
                                    <div class="invalid-feedback">
                                        Please enter tour name.
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">Start time</label>
                                        <input class="form-control" id="inputFirstName" type="date" name="start_at" value="{{ Carbon\Carbon::parse($tour->start_at)->format('Y-m-d')}}" required>
                                        <div class="invalid-feedback">
                                            Please enter start time.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">End time</label>
                                        <input class="form-control" id="inputLastName" type="date" name="end_at" value="{{ Carbon\Carbon::parse($tour->end_at)->format('Y-m-d')}}" required>
                                        <div class="invalid-feedback">
                                            Please enter end time.
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="inputLocation">Location</label>
                                        <input class="form-control" id="inputLocation" type="text" name="location" value="{{$tour->location}}" required>
                                        <div class="invalid-feedback">
                                            Please enter location.
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Tour Description</label>
                                    <textarea placeholder="Enter your tour description" class="form-control" name="description" id="" rows="6" required >{{$tour->description}}</textarea>
                                    <div class="invalid-feedback">
                                        Please enter tour description.
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" form="tour-form" type="submit">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
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
    </script>
@endsection
