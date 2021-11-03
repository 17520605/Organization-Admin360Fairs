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
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($zones as $zone)
                            <tr class="zone-{{$zone->id}}">
                                <td style="text-align: center">{{$number++}}</td>
                                <td><a href="zones/{{$zone->id}}">{{$zone->name}}</a></td>
                                <td>{{ count($zone->booths)}} </td>
                                <td>
                                    @foreach ($zone->booths as $booth)
                                        <a href="booths/{{$booth->id}}">{{$booth->name}}</a> , 
                                    @endforeach
                                </td>
                                <td>
                                    <a href="zones/{{$zone->id}}" class="btn-visit-now" >Visit now <i class="fas fa-chevron-right"></i></a>
                                </td>
                                <td class="btn-action-icon">
                                    <i class="fas fa-pen edit" data-zone-id="{{$zone->id}}" data-name="{{$zone->name}}" data-booths='@foreach ($zone->booths as $booth){"id":"{{$booth->id}}", "name":"{{$booth->name}}"};@endforeach' onclick="onOpenPopupEditZone(this);"></i>
                                    <i class="fas fa-trash-alt delete" data-zone-id="{{$zone->id}}" onclick="onOpenPopupDeleteZone(this);"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP CREATE ZONE --}}
    <div class="modal fade" id="popup-create-zone" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
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
                                <button type="submit" id="popup-create-zone__save-btn" class="btn btn-primary btn-block btn-icon-loader"><span class="icon-loader-form"></span> Save Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP EDIT ZONE --}}
    <div class="modal fade" id="popup-edit-zone" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Edit Zone</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column" style="flex-grow: 1;">
                        <form action="/administrator/tours/{{$tour->id}}/zones/save-edit" method="POST">
                            @csrf
                            <input id="popup-edit-zone__id-hidden-input" type="hidden" name="id">
                            <div class="mb-3">
                                <label class="small mb-1" for="">Name</label>
                                <input class="form-control" id="popup-edit-zone__name-input" type="text" name="name" placeholder="Enter Name">
                            </div>
                            <div class="mb-3">
                                <a class="link link-primary" id="popup-edit-zone__toggle-booths-wrapper-btn">Choose booths</a>
                            </div>
                            <div class="mb-3 p-3 border booths-wrapper" style="display: none">
                                <div class="free-booths">
                                    @foreach ($freeBooths as $freeBooth)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="boothIds[]" value="{{$freeBooth->id}}" >
                                        <label class="form-check-label">
                                            {{$freeBooth->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>  
                                <div class="zone-booths">
                                   
                                </div>
                            </div>
                            <div class="modal-footer"  style="padding: 0.85rem 0px;">
                                <button type="submit" id="popup-edit-zone__save-btn" data-zone-id="" class="btn btn-primary btn-block btn-icon-loader"> <span class="icon-loader-form"></span> Save Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- POPUP DELETE ZONE --}}
    <div class="modal fade" id="popup-confirm-delete-zone" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="popup-edit-partner__form" class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h5 class="fw-light">Delete Partner </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <p>Do you really want to delete it?</p>
                    </div>
                    <div class="modal-footer" style="padding: 0">
                        <input id="popup-confirm-delete-zone__id-hidden-input" type="hidden">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="popup-confirm-delete-zone__delete-btn" type="button" class="btn btn-danger btn-icon-loader-delete"><span class="icon-loader-form-delete"></span> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <script>
        function onOpenPopupEditZone(target){
            let name = $(target).attr('data-name');
            let booths = $(target).attr('data-booths');
            let zoneId = $(target).attr('data-zone-id');
            let arr = booths.split(';');
            $('#popup-edit-zone__name-input').val(name);
            $('#popup-edit-zone__id-hidden-input').val(zoneId);
            $('#popup-edit-zone').find('.zone-booths').empty();
            $('#popup-edit-zone').find('.booths-wrapper').hide();
            arr.forEach(str => {
                if(str != ""){
                    $('#popup-edit-zone').find('.booths-wrapper').show();
                    let item = JSON.parse(str);
                    let element = $(`
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="boothIds[]" value="`+item.id+`" checked>
                            <label class="form-check-label">`+item.name+`</label>
                        </div>`
                    );
                    $('#popup-edit-zone').find('.zone-booths').append(element);
                }
            });
            $('#popup-edit-zone').modal('show');
        }
        function onOpenPopupDeleteZone(target){
            let zoneId = $(target).attr('data-zone-id');
            $('#popup-confirm-delete-zone__id-hidden-input').val(zoneId);
            $('#popup-confirm-delete-zone').modal('show');
        }
    </script>
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
            $('#popup-edit-zone__toggle-booths-wrapper-btn').click(function (e) { 
                let hidden =  $('#popup-edit-zone').find('.booths-wrapper').is(":hidden");
                if(hidden){
                    $('#popup-edit-zone').find('.booths-wrapper').show('fast');
                }
                else{
                    $('#popup-edit-zone').find('.booths-wrapper').hide('fast');
                    $('#popup-edit-zone').find('.booths-wrapper').find('input[type="checkbox"]').prop('checked', false);
                }
            });
            $('#popup-confirm-delete-zone__delete-btn').click(function (){
                let id = $('#popup-confirm-delete-zone__id-hidden-input').val();
                if(id != null && id != ""){
                    let ajax = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/zones/" + id,
                        type: 'delete',
                        dataType: 'json',
                        success: function (res) { 
                            if (res == 1) {
                                $('#popup-confirm-delete-zone').modal('hide');
                                let row = $('.zone-' + id);
                                let wrapper = row.parent();
                                row.remove();
                                if(wrapper.children().length == 0){
                                    wrapper.append(`
                                        <tr>
                                            <td colspan="10"><center><span>No zones</span></center></td>
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
