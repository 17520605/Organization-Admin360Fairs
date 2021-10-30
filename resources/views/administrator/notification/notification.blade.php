@extends('layouts.master')
@section('content')
    <div>
        <form action="">
            @csrf
            <div class="form-group">
                <input class="form-control" type="text" placeholder="To:">
            </div>
        </form>
    </div>
@endsection
