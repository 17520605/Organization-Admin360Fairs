@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <section class="content">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Tour Picture</div>
                        <div class="card-body text-center">
                            @if ($tour->image != null)
                                <img id="preview-img" class="card-img-top" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="{{$tour->image}}" data-holder-rendered="true"> 
                            @else
                                <img id="preview-img" class="card-img-top" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17c4158f272%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17c4158f272%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                            @endif
                            <div id="loader-update-image" class="spinner-border text-primary" role="status" style=" display: none; position: absolute; top: 45%; left: 45%; ">
                                <span class="sr-only">Loading...</span>
                            </div> 
                            <button id="file-btn" class="mt-3 btn btn-secondary" type="button"> <i class="fa fa-cloud-upload"></i> Upload new image</button>
                            <input id="file-input" name="file" type="file" hidden >
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Tour Edit</div>
                        <div class="card-body">
                            <form id="tour-form" class="form-signin needs-validation" action="/tours/{{$tour->id}}/tour/save-edit" method="post" novalidate>
                                @csrf
                                <input id="image-hidden-input" name="image" type="text" hidden >
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
                                        <input class="form-control" id="inputFirstName" type="date" name="start_at" value="{{ Carbon\Carbon::parse($tour->startTime)->format('Y-m-d')}}" required>
                                        <div class="invalid-feedback">
                                            Please enter start time.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">End time</label>
                                        <input class="form-control" id="inputLastName" type="date" name="end_at" value="{{ Carbon\Carbon::parse($tour->endTime)->format('Y-m-d')}}" required>
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
                            <button class="btn btn-primary btn-block" form="tour-form" type="submit">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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

        $(document).ready(function () {  

            $('#file-btn').click(function(){ $('#file-input').trigger('click');});

            $('#file-input').change(function () {  
                $('#loader-update-image').show();
                $('#file-btn').attr('disabled',true);
                let file = this.files[0];
                let data = new FormData();
                data.append('file', file);
                let ajax = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/storage/upload",
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (res) {  
                        $('#preview-img').attr('src', res);
                        $('#image-hidden-input').val(res);
                        $('#loader-update-image').hide();
                        $('#file-btn').attr('disabled',false);
                    }
                });

            });
        });

    </script>
@endsection
