@extends('layouts.master')
@section('content')
    <div class="container-fluid container-mail">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="h3 mb-2 text-gray-800">Create New Notifications</h1>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Compose New Notifications</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input class="form-control" placeholder="To:">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Subject:">
                                </div>
                                <div class="form-group">
                                    <textarea id="compose-textarea" class="form-control" style="height: 400px"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> cancel</button>
                                    <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
