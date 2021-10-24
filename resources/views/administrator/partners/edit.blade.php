@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <section class="content">
            <div class="row">
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Add Company</div>
                        <div class="card-body">
                            <form>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">Company Name</label>
                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter company name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">Service type</label>
                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter service type">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                        <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputOrgName">Link website</label>
                                        <input class="form-control" id="inputOrgName" type="text" placeholder="Enter link website">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address">
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="inputLocation">Location</label>
                                        <input class="form-control" id="inputLocation" type="text" placeholder="Enter location">
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="button">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Logo Company</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <h2 style="font-weight: 800;">LOGO</h2>
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <button class="btn btn-primary" type="button">Upload Logo</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
