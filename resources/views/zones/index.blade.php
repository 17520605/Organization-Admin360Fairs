@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="float-left m-0 font-weight-bold text-primary">List of Zones :</h6>
                <button class="btn" data-toggle="modal" data-target="#popup-create-zone" style="float: right; color: #fff; background-color: #224abe; border-color: #224abe;"><i class="fas fa-plus" ></i>Add New Booth</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Booths count</th>
                                <th>Booths of zone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zones as $zone)
                            <tr>
                                <td>1</td>
                                <td>{{$zone->name}}</td>
                                <td>{{ count($zone->booths)}} </td>
                                <td>
                                    @foreach ($zone->booths as $booth)
                                        <a>{{$booth->name}}</a> , 
                                    @endforeach
                                </td>
                                <td>
                                    <i class="fa fa-trash">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup-create-zone" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Zone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <form action="/tours/{{$tour->id}}/zones/save-create" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="">Name</label>
                                <input class="form-control" id="popup-create-zone__name-input" type="text" name="name" placeholder="Enter Name">
                            </div>
                            <div class="mb-3">
                                <a class="link link-primary" id="popup-create-zone__toggle-booths-wrapper-btn">Choose booths</a>
                            </div>
                            <div class="mb-3 p-3 border booths-wrapper" style="display: none">
                                @foreach ($freeBooths as $freeBooth)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="boothIds[]" value="{{$freeBooth->id}}" >
                                        <label class="form-check-label">
                                            {{$freeBooth->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer"  style="padding: 0.85rem 0px;">
                                <button type="submit" id="popup-create-zone__save-btn" class="btn btn-primary btn-block">Save Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#popup-create-zone__toggle-booths-wrapper-btn').click(function (e) { 
                let hidden =  $('#popup-create-zone').find('.booths-wrapper').is(":hidden");
                if(hidden){
                    $('#popup-create-zone').find('.booths-wrapper').show('fast');
                }
                else{
                    $('#popup-create-zone').find('.booths-wrapper').hide('fast');
                    $('#popup-create-zone').find('.booths-wrapper').find('input[type="checkbox"]').prop('checked', false);
                }
            });
        });
    </script>
@endsection
