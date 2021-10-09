@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Booths</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="group-head">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tr style="background-color: #ccc !important; border: 1px solid #ccc;" onclick="toggleGroup(0)">
                            <td colspan="8">
                                <span style="float: left">Free Booths</span>
                                <span style="float: right"> <i class="fas fa-caret-down"></i> </span>
                            </td>
                        </tr>
                        <tbody class="group-0">
                            @foreach ($freeBooths as $freeBooth)
                            <tr>
                                <td>1</td>
                                <td>{{$freeBooth->name}}</td>
                                <td>Dinh phong</td>
                                <td><span>In Process</span></td>
                                <td>September 26, 2021</td>
                                <td>
                                    <i class="fa fa-trash"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @foreach ($zones as $zone)
                        <div>
                            <tr style="background-color: #ccc !important; border: 1px solid #ccc;" onclick="toggleGroup({{$zone->id}})">
                                <td colspan="8">
                                    <span style="float: left">{{$zone->name}}</span>
                                    <span style="float: right"> <i class="fas fa-caret-down"></i> </span>
                                </td>
                            </tr>
                            <tbody class="group-{{$zone->id}}">
                                @foreach ($zone->booths as $booth)
                                <tr>
                                    <td>1</td>
                                    <td>{{$booth->name}}</td>
                                    <td>Dinh phong</td>
                                    <td><span>In Process</span></td>
                                    <td>September 26, 2021</td>
                                    <td>
                                        <i class="fa fa-trash"></i>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </div>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleGroup(id) {  
            $('.group-' + id).toggle();
        }
    </script>
@endsection
