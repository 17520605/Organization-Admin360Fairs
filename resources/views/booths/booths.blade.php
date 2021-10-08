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
                            <tr>
                                <th>#</th>
                                <th>Name Booths</th>
                                <th>Avatar</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Dinh phong Boots</td>
                                <td><img class="booth-tables" src="https://dt2sdf0db8zob.cloudfront.net/wp-content/uploads/2019/08/99-logo.png" alt=""></td>
                                <td>Dinh phong</td>
                                <td><span class="btn btn-df1">In Process</span></td>
                                <td>September 26, 2021</td>
                                <td>
                                    <a class="btn btn-xs btn-danger" href="#"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Dinh phong Boots 2</td>
                                <td><img class="booth-tables" src="https://dt2sdf0db8zob.cloudfront.net/wp-content/uploads/2019/08/99-logo.png" alt=""></td>
                                <td>Dinh phong 3</td>
                                <td><span class="btn btn-df2">Processed</span></td>
                                <td>September 26, 2021</td>
                                <td>
                                    <a class="btn btn-xs btn-danger" href="#"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
