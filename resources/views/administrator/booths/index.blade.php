@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Booths : </h1>
                <div class="div_cardheader_btn" >
                    <button class="mb-0 btn float-right active"  data-toggle="modal" data-target="#popup-create-booth"><i class="fas fa-plus"></i> Add New Booth </button>
                </div>
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
                                <th style="width: 8%;">Action</th>
                            </tr>
                        </thead>
                        <tr style="background-color: #4e73dfcf !important; color:#fff;" onclick="toggleGroup(0)">
                            <td colspan="8">
                                <span style="float: left">Free Booths</span>
                                <span style="float: right"> <i class="fas fa-caret-down"></i> </span>
                            </td>
                        </tr>
                        <tbody class="group-0">
                            @if (count($freeBooths) == 0)
                                <tr>
                                    <td colspan="10"><center><span>No booths</span></center></td>
                                </tr>
                            @endif
                            @foreach ($freeBooths as $freeBooth)
                            <tr>
                                <td>1</td>
                                <td><a style="font-weight: 600" href="booths/{{$freeBooth->id}}">{{$freeBooth->name}}</a></td>
                                <td>Dinh phong</td>
                                <td><span>In Process</span></td>
                                <td>September 26, 2021</td>
                                <td class="btn-action-icon">
                                    <i class="fas fa-pen edit"></i>
                                    <i class="fas fa-trash-alt delete"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @foreach ($groups as $group)
                        <div>
                            <tr style="background-color: #4e73dfcf !important; color:#fff;" onclick="toggleGroup({{$group->id}})">
                                <td colspan="8">
                                    <span style="float: left">{{$group->name}}</span>
                                    <span style="float: right"> <i class="fas fa-caret-down"></i> </span>
                                </td>
                            </tr>
                            <tbody class="group-{{$group->id}}">
                                @foreach ($group->booths as $booth)
                                <tr>
                                    <td>1</td>
                                    <td><a style="font-weight: 600" href="booths/{{$booth->id}}">{{$booth->name}}</a></td>
                                    <td>Dinh phong</td>
                                    <td><span>In Process</span></td>
                                    <td>September 26, 2021</td>
                                    <td class="btn-action-icon">
                                       <i class="fas fa-trash-alt delete"  data-toggle="modal" data-target="#popup-delete-booth"></i>
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
    {{-- POPUP CREATE BOOTH --}}
    <div class="modal fade" id="popup-create-booth" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Booth</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/administrator/tours/{{$tour->id}}/booths/save-create" method="POST">
                    <div class="modal-body">
                        <div class="modal-body">
                            @csrf
                            <div class="row mb-3">
                                <label class="small mb-1" for="">Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Enter Booth Name">
                            </div>
                            <div id="popup-create-booth__choose-zone-text" class="row row mb-3" > Choose zone </div>
                            <div class="row mb-3 p-3 border zones-wrapper" style="display: none;">
                            @if (count($zones) == 0)
                                <center><span>No zone</span></center>
                            @else
                                @foreach ($zones as $zone)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="{{$zone->id}}" name="zoneId">
                                    <label class="form-check-label"> {{$zone->name}} </label>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer" style="padding: 0.75rem 0;">
                        <button class="btn btn-block btn-df" type="submit">Create new booths</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function toggleGroup(id) {  
            $('.group-' + id).toggle();
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#popup-create-booth__choose-zone-text').click(function () {  
                $('#popup-create-booth').find('.zones-wrapper').toggle();
            });
        });
    </script>
@endsection
