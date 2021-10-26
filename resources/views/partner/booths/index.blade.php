@extends('layouts.partner')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Booths </h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="group-head">
                            <tr style="background: #eef2f7;">
                                <th style="text-align: center;width: 5%">#</th>
                                <th style="width: 15%;">Name</th>
                                <th style="width: 20%;">Owner</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 15%;">Last change at</th>
                            </tr>
                        </thead>
                        <tbody class="group-0">
                            @if (count($booths) == 0)
                            <tr>
                                <td colspan="10"><center><span>No booths</span></center></td>
                            </tr>
                            @endif
                            @foreach ($booths as $booth)
                            <tr class="booth-{{$booth->id}}">
                                <td style="text-align: center">1</td>
                                <td><a href="/partner/tours/{{$tour->id}}/booths/{{$booth->id}}">{{$booth->name}}</a></td>
                                <td>
                                    <span class="text-primary font-weight-bold">{{$booth->owner->name}}</span>
                                </td>  
                                <td>
                                    @if ($booth->status == 'No owner')
                                        <span class="badge bg-warning">{{$booth->status}}</span>
                                    @elseif ($booth->status == 'Granted owner')
                                        <span class="badge bg-danger">{{$booth->status}}</span>
                                    @endif
                                </td>
                                <td>{{$booth->lastChangeAt}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
