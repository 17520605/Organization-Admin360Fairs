@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Zones : ( {{count($zones)}}/{{$tour->maximumZone}})</h1>
                <div class="div_cardheader_btn" >
                    <button class="mb-0 btn float-right active"  data-toggle="modal" data-target="#popup-create-zone"><i class="fas fa-plus"></i> Add New Booth </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background: #eef2f7;">
                                <th style="text-align: center;width: 5%;">#</th>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 15%;">Booths count</th>
                                <th>Booths of zone</th>
                                <th style="width: 130px;">Visit</th>
                                <th style="width: 8%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zones as $zone)
                            <tr>
                                <td style="text-align: center">1</td>
                                <td><a href="zones/{{$zone->id}}">{{$zone->name}}</a></td>
                                <td>{{ count($zone->booths)}} </td>
                                <td>
                                    @foreach ($zone->booths as $booth)
                                        <a href="booths/{{$booth->id}}">{{$booth->name}}</a> , 
                                    @endforeach
                                </td>
                                <td>
                                    <a href="" class="btn-visit-now" >Visit now <i class="fas fa-chevron-right"></i></a>
                                </td>
                                <td class="btn-action-icon">
                                    <i class="fas fa-pen edit"></i>
                                    <i class="fas fa-trash-alt delete"></i>
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
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <form action="/administrator/tours/{{$tour->id}}/zones/save-create" method="POST">
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
