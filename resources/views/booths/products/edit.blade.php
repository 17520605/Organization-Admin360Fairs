@extends('layouts.master')

@section('content')
 <div class="container-fluid card-booths">
                    <section class="content">
                        <div class="row">
                            <div class="col-xl-8">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-header">Account Details</div>
                                    <div class="card-body">
                                        <form>
                                            <!-- Form Group (username)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                                <select id="inputStatus" class="form-control custom-select">
                                                    <option selected="" disabled="">Select one</option>
                                                    <option>On Hold</option>
                                                    <option>Canceled</option>
                                                    <option>Success</option>
                                                </select>
                                            </div>
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (first name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="Valerie">
                                                </div>
                                                <!-- Form Group (last name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="Luna">
                                                </div>
                                            </div>
                                            <!-- Form Row        -->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (organization name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputOrgName">Organization name</label>
                                                    <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">
                                                </div>
                                                <!-- Form Group (location)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLocation">Location</label>
                                                    <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="San Francisco, CA">
                                                </div>
                                            </div>
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                                            </div>
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (phone number)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                                    <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="555-123-4567">
                                                </div>
                                                <!-- Form Group (birthday)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputBirthday">Birthday</label>
                                                    <input class="form-control" id="inputBirthday" type="date" name="birthday" placeholder="Enter your birthday" value="06/10/1988">
                                                </div>
                                            </div>
                                            <!-- Save changes button-->
                                            <button class="btn btn-primary" type="button">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <!-- Profile picture card-->
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Logo Picture</div>
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <h2>LOGO</h2>
                                        <!-- Profile picture help block-->
                                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        <button class="btn btn-primary" type="button">Upload Logo</button>
                                    </div>
                                </div>
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Banner Picture</div>
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <h2>Banner 01</h2>
                                        <!-- Profile picture help block-->
                                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        <button class="btn btn-primary" type="button">Upload banner 1</button>
                                    </div>
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <h2>Banner 02</h2>
                                        <!-- Profile picture help block-->
                                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        <button class="btn btn-primary" type="button">Upload banner 2</button>
                                    </div>
                                </div>
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Link Video</div>
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <h2>Link video</h2>
                                        <!-- Profile picture help block-->
                                        <div class="small font-italic text-muted mb-4">File no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        <button class="btn btn-primary" type="button">Upload Video</button>
                                    </div>

                                </div>
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Powerpoint</div>
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <h2>Powerpoint</h2>
                                        <!-- Profile picture help block-->
                                        <div class="small font-italic text-muted mb-4">File no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        <button class="btn btn-primary" type="button">Upload Files</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>

@endsection
