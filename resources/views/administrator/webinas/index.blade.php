@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background: #eef2f7;">
                                <th style="text-align: center">#</th>
                                <th>Events</th>
                                <th>Baner</th>
                                <th>Name</th>
                                <th>Link MSteam</th>
                                <th>Start time</th>
                                <th>Date</th>
                                <th style="width: 8%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center">1</td>
                                <td>Event 279</td>
                                <td><img style="width: 150px; max-height: 80px;" src="https://cdn.vn.garenanow.com/web/fo4vn/2019-Nov/VNDAU/KV-Adapt-1920x1080.jpg" alt=""></td>
                                <td>Thuyết trình triển lãm</td>
                                <td>
                                    <a href="https://github.com/">https://github.com/</a>
                                </td>
                                <td>12:00 to 13.30</td>
                                <td>Friday 1 Oct 2021</td>
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
