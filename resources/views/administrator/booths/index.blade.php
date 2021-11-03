@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Booths </h1>
                <div class="div_cardheader_btn" >
                    <button class="mb-0 btn float-right active"  data-toggle="modal" data-target="#popup-create-booth"><i class="fas fa-plus"></i> Add New Booth </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="group-head">
                            <tr style="background: #eef2f7;">
                                <th style="text-align: center;width: 5%">#</th>
                                <th style="">Name</th>
                                <th style="width: 20%;">Owner</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 15%;">Last change at</th>
                                <th style="width: 125px;">Visit</th>
                                <th style="width: 8%;">Action</th>
                            </tr>
                        </thead>
                        <tr style="background-color: #4e73dfcf !important; color:#fff;" onclick="toggleGroup(0)">
                            <td colspan="8">
                                <span style="float: left"><i class="fas fa-asterisk"></i> (Total : {{count($freeBooths)}} booths) </span>
                                <span style="float: right"> <i class="fas fa-caret-down"></i> </span>
                            </td>
                        </tr>
                        <tbody class="group-0" style="display: none" >
                            @php
                                $number = 1;
                            @endphp
                            @if (count($freeBooths) == 0)
                            <tr>
                                <td colspan="10"><center><span>No booths</span></center></td>
                            </tr>
                            @endif
                            @foreach ($freeBooths as $freeBooth)
                            <tr class="booth-{{$freeBooth->id}}">
                                <td style="text-align: center">{{$number++}}</td>
                                <td><a class="font-weight-bold text-primary" href="/administrator/tours/{{$tour->id}}/booths/{{$freeBooth->id}}">{{$freeBooth->name}}</a></td>
                                <td>
                                    @if ($freeBooth->owner == null || $freeBooth->owner->id == $profile->id)
                                        Host
                                    @else
                                        <span class="text-primary font-weight-bold">{{$freeBooth->owner->name}}</span>
                                    @endif
                                </td>  
                                <td>
                                    @if ($freeBooth->status == 'No owner')
                                        <span class="badge bg-warning">{{$freeBooth->status}}</span>
                                    @elseif ($freeBooth->status == 'Granted owner')
                                        <span class="badge bg-danger">{{$freeBooth->status}}</span>
                                    @endif
                                </td>
                                <td>{{$freeBooth->lastChangeAt}}</td>
                                <td>
                                    <a href="/administrator/tours/{{$tour->id}}/booths/{{$freeBooth->id}}" class="btn-visit-now btn-page-loader" >Visit now <i class="fas fa-chevron-right"></i></a>
                                </td>
                                <td class="btn-action-icon">
                                    <i onclick="onGrantOwner({{$freeBooth->id}}, '{{$freeBooth->name}}', {{$freeBooth->owner->id}})" class="fa fa-user-shield user"></i>
                                    <i onclick="onEditBooth(this)" data-name="{{$freeBooth->name}}" data-id="{{$freeBooth->id}}" class="fa fa-pen edit"></i>
                                    <i onclick="onDeleteBooth(this)" data-name="{{$freeBooth->name}}" data-id="{{$freeBooth->id}}" class="fa fa-trash-alt delete"></i>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                        @foreach ($groups as $group)
                        <div>
                            <tr style="background-color: #4e73dfcf !important; color:#fff;" onclick="toggleGroup({{$group->id}})">
                                <td colspan="8">
                                    <span style="float: left"><span class="font-weight-bold" style="margin-right: 5px">{{$group->name}} </span>(Total : {{count($group->booths)}} booths) </span>
                                    <span style="float: right"> <i class="fas fa-caret-down"></i> </span>
                                </td>
                            </tr>
                            <tbody class="group-{{$group->id}}"  style="display: none">
                                @if (count($group->booths) == 0)
                                <tr>
                                    <td colspan="10"><center><span>No booths</span></center></td>
                                </tr>
                                @endif
                                @foreach ($group->booths as $booth)
                                <tr class="booth-{{$booth->id}}">
                                    <td style="text-align: center">{{$number++}}</td>
                                    <td><a class="font-weight-bold text-primary btn-page-loader" href="/administrator/tours/{{$tour->id}}/booths/{{$booth->id}}">{{$booth->name}}</a></td>
                                    <td>
                                        @if ($booth->owner == null || $booth->owner->id == $profile->id)
                                            Host
                                        @else
                                            <span class="text-primary font-weight-bold">{{$booth->owner->name}}</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($booth->status == 'No owner')
                                            <span class="badge bg-warning">{{$booth->status}}</span>
                                        @elseif ($booth->status == 'Granted owner')
                                            <span class="badge bg-danger">{{$booth->status}}</span>
                                        @endif
                                    </td>
                                    <td>{{$booth->lastChangeAt}}</td>
                                    <td>
                                        <a href="/administrator/tours/{{$tour->id}}/booths/{{$booth->id}}" class="btn-page-loader btn-visit-now" >Visit now <i class="fas fa-chevron-right"></i></a>
                                    </td>
                                    <td class="btn-action-icon">
                                        <i onclick="onGrantOwner({{$booth->id}}, '{{$booth->name}}', {{$booth->owner->id}})" class="fa fa-user-shield user"></i>
                                        <i onclick="onEditBooth(this)" data-zoneId="{{$group->id}}" data-name="{{$booth->name}}" data-id="{{$booth->id}}" class="fa fa-pen edit"></i>
                                        <i onclick="onDeleteBooth(this)" data-name="{{$booth->name}}" data-id="{{$booth->id}}" class="fa fa-trash-alt delete"></i>
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
                            <div id="popup-create-booth__choose-zone-text" class="row row mb-3" style="color: #4e73df ; cursor: pointer;"> Choose zone </div>
                            <div class="row mb-3 p-3 border zones-wrapper" style="display: none;">
                                @if (count($zones) == 0)
                                    <center><span>No zone</span></center>
                                @else
                                    @foreach ($zones as $zone)
                                    <div class="form-check" style="margin-right: 20px">
                                        <input class="form-check-input" type="radio" value="{{$zone->id}}" name="zoneId">
                                        <label class="form-check-label"> {{$zone->name}} </label>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding: 0.75rem 0;">
                        <button class="btn btn-block btn-df" type="submit">Create new booths</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- POPUP EDIT BOOTH --}}
    <div class="modal fade" id="popup-edit-booth" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Edit Booth</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/administrator/tours/{{$tour->id}}/booths/save-edit" method="POST">
                    <div class="modal-body">
                        <div class="modal-body">
                            @csrf
                            <input id="popup-edit-booth__id-hidden-input" type="hidden" name="id">
                            <div class="row mb-3">
                                <label class="small mb-1" for="">Name</label>
                                <input id="popup-edit-booth__name-input" class="form-control" type="text" name="name" placeholder="Enter Booth Name">
                            </div>
                            <div id="popup-edit-booth__choose-zone-text" class="row row mb-3" > Choose zone </div>
                            <div class="row mb-3 p-3 border zones-wrapper" style="display: none;">
                                @if (count($zones) == 0)
                                    <center><span>No zone</span></center>
                                @else
                                    @foreach ($zones as $zone)
                                    <div class="form-check" style="margin-right: 20px">
                                        <input class="form-check-input" type="radio" value="{{$zone->id}}" name="zoneId">
                                        <label class="form-check-label"> {{$zone->name}} </label>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-block btn-df" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- POPUP CONFIRM DELETE BOOTH --}}
    <div class="modal fade" id="popup-confirm-delete-booth" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Detele Booth</h5>
                                       <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <span>Are you sure you want to delete &nbsp</span><span>"<span id="popup-confirm-delete-booth__name-text"></span>"</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="popup-confirm-delete-booth__id-hidden-input" type="hidden">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button id="popup-confirm-delete-booth__delete-btn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP GRANT OWNER --}}
    <div class="modal fade" id="popup-grant-owner" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Grant owner for "<span class="text-primary font-weight-bold" id="popup-grant-owner__booth-name"></span>"</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/administrator/tours/{{$tour->id}}/booths/grant-owner" method="POST">
                    <div class="modal-body">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="boothId">
                            <div class="row mb-3"> Partners Manager Booths:</div>
                            @if (count($partners) == 0)
                                <center><span>No zone</span></center>
                            @else
                                <select name="partnerId" id="popup-grant-owner__select-owner" class="form-control">
                                    @foreach ($partners as $partner)
                                        <option id="popup-grant-owner__parter-{{$partner->id}}" value="{{$partner->id}}">{{$partner->name}}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-block btn-df" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleGroup(id) {
            $('.group-' + id).toggle();
        }
        function onEditBooth(target) {  
            let id = $(target).attr('data-id');
            let name = $(target).attr('data-name');
            let zoneId = $(target).attr('data-zoneId');

            $('#popup-edit-booth__name-input').val(name);
            $('#popup-edit-booth__id-hidden-input').val(id);
            if( zoneId != null){
                $('#popup-edit-booth').find('.zones-wrapper').show();
                $('#popup-edit-booth').find('input[type="radio"][value="'+zoneId+'"]').prop('checked', true);
            }
            else{
                $('#popup-edit-booth').find('.zones-wrapper').hide();
            }

            $('#popup-edit-booth').modal('show');
        }

        function onGrantOwner(boothId, boothName, oldOwnerId) { 
            $('#popup-grant-owner').find('input[type="hidden"][name="boothId"]').val(boothId);
            $('#popup-grant-owner__select-owner').val(oldOwnerId);
            $('#popup-grant-owner__booth-name').text(boothName);
            $('#popup-grant-owner').modal('show');
        }

        function onDeleteBooth(target) {  
            let id = $(target).attr('data-id');
            let name = $(target).attr('data-name');
            $('#popup-confirm-delete-booth__name-text').text(name);
            $('#popup-confirm-delete-booth__id-hidden-input').val(id);
            $('#popup-confirm-delete-booth').modal('show');
        }


    </script>
    <script>
        $(document).ready(function () {
            $('#popup-create-booth__choose-zone-text').click(function () {  
                $('#popup-create-booth').find('.zones-wrapper').toggle();
                if($('#popup-create-booth').find('.zones-wrapper').is(':hidden')){
                    $('#popup-create-booth').find('.zones-wrapper').find('input[type="radio"]').prop('checked', false)
                }     
            });
 
            $('#popup-edit-booth__choose-zone-text').click(function () {  
                $('#popup-edit-booth').find('.zones-wrapper').toggle();
                if($('#popup-edit-booth').find('.zones-wrapper').is(':hidden')){
                    $('#popup-edit-booth').find('.zones-wrapper').find('input[type="radio"]').prop('checked', false)
                }     
            });

            $('#popup-confirm-delete-booth__delete-btn').click(function (){
                let id = $('#popup-confirm-delete-booth__id-hidden-input').val();
                if(id != null && id != ""){
                    let ajax = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/booths/" + id,
                        type: 'delete',
                        dataType: 'json',
                        success: function (res) { 
                            if (res == 1) {
                                $('#popup-confirm-delete-booth').modal('hide');
                                let row = $('.booth-' + id);
                                let wrapper = row.parent();
                                row.remove();
                                if(wrapper.children().length == 0){
                                    wrapper.append(`
                                        <tr>
                                            <td colspan="10"><center><span>No booths</span></center></td>
                                        </tr>
                                    `);
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
