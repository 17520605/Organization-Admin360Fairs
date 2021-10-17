@extends('layouts.master')

@section('content')
<div class="container-fluid booths-card">
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
                                <th>Name</th>
                                <th>Images</th>
                                <th>Price</th>
                                <th>Link Products</th>
                                <th>Code</th>
                                <th>Booths</th>
                                <th style="width: 8%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center">1</td>
                                <td>Brielle Williamson</td>
                                <td><img class="products-tables" src="./../asset/images/apps-1.jpg" alt=""></td>
                                <td>150$</td>
                                <td>
                                    <a href="https://github.com/">https://github.com/</a>
                                </td>
                                <td>SALE123</td>
                                <td>Booth-01</td>
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
