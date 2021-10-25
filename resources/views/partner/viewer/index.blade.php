@extends('layouts.partner')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Managerment</h6>
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
                            <tr>
                                <td style="text-align: center">1</td>
                                <td>Brielle Williamson</td>
                                <td><img class="avatar-tables" src="/asset/images/undraw_profile_1.svg" alt=""></td>
                                <td>0969888999</td>
                                <td>nguyenhuuminhkhai@gmail.com</td>
                                <td>UIT</td>
                                <td>Hà nội</td>
                                <td class="btn-action-icon">
                                    <i class="fas fa-pen edit"></i>
                                    <i class="fas fa-trash-alt delete"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
