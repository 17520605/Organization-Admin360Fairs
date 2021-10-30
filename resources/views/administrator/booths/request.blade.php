@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Request Booths</h6>
                <button class="btn btn-sm btn-primary" style="position: absolute; right: 15px; top: 10px;" type="button"><i class="fas fa-plus" style="margin-right: 10px;"></i>  Add Managerment</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background: #eef2f7;">
                                <th style="text-align: center">#</th>
                                <th>Name</th>
                                <th>Avatar</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $number = 1;
                        @endphp
                            <tr>
                                <td style="text-align: center">{{$number++}}</td>
                                <td>Brielle Williamson</td>
                                <td style="text-align: center">
                                    <div><img class="rounded-circle avatar-xs" src="https://res.cloudinary.com/virtual-tour/image/upload/v1634539139/icons/default_avatar_k3wxez.png" alt=""></div>
                                </td>
                                <td>0969888999</td>
                                <td>nguyenhuuminhkhai@gmail.com</td>
                                <td>UIT</td>
                                <td>Hà nội</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success"  title="Edit" style="width: 32px;"><i class="fas fa-check"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger"  title="Delete" style="width: 32px;"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
