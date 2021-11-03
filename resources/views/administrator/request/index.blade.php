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
                                    <button type="button" class="btn btn-sm btn-success"  title="Edit" style="width: 32px;"><i class="fas fa-check"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" title="Delete" style="width: 32px;"><i class="fas fa-times"></i></button>
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
                                         <button type="button" class="btn btn-sm btn-success"  title="Edit" style="width: 32px;"><i class="fas fa-check"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" title="Delete" style="width: 32px;"><i class="fas fa-times"></i></button>
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
@endsection
