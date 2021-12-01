@extends('layouts.master')
@section('content')
<div class="container-fluid tags-wrapper">
    <div class="card shadow mb-4 tag-body" >
        <div class="card-header">
            <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Interest</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="background: #eef2f7;">
                            <th style="text-align: center;width: 5%;">#</th>
                            <th style="width: 15%">Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Interest at</th>
                            <th>Purpose</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp
                        @foreach ($interests as $interest)
                        <tr class="zone-1">
                            <td style="text-align: center">{{$number++}}</td>
                            <td><span class="font-weight-bold text-primary">{{$interest->visitor->name}}</span></td>
                            <td><a class="font-weight-bold text-primary" href="mailto:{{$interest->visitor->email}}">{{$interest->visitor->email}} </a></td>
                            <td><a class="font-weight-bold text-primary" href="tel:{{$interest->visitor->contact}}">{{$interest->visitor->contact}}</a></td>
                            <td>{{$interest->datetime}}</td>
                            {{-- <th><a href="" class="btn {{$interest->status == 0 ? 'btn-df1' : 'btn-df2' }}"> {{$interest->status == 0 ? 'process' : 'processed' }}</th> --}}
                            <td>
                                @if ($interest->tourId != null)
                                    <a href="/administrator/tours/{{$interest->tourId}}" class="font-weight-bold text-primary"><i class="fas fa-torii-gate"></i> {{$interest->tour->name}}</a>
                                @elseif ($interest->boothId != null)
                                    <a href="/administrator/tours/{{$tour->id}}/booths/{{$interest->boothId}}" class="font-weight-bold text-primary"><i class="fas fa-store"></i> {{$interest->booth->name}}</a>
                                @elseif ($interest->objectId != null)
                                    <a href="/administrator/tours/1/objects/{{$interest->objectId}}" class="font-weight-bold text-primary"><i class="fas fa-folder"></i> {{$interest->object->name}}</a>
                                @endif
                            </td>
                            <td>{{$interest->message}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- POPUP DELETE PARTICIANT --}}
<div class="modal fade" id="popup-confirm-delete-partner" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="popup-confirm-delete-partner__delete-btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
