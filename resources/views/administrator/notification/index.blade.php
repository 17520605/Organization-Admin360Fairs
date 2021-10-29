@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <h4 class="mb-0 mt-5">All Notifiaction <button class="btn btn-df" data-toggle="modal" data-target="#popup_create_notification" style="position: absolute; right: 1.5rem; margin-top: -10px"><i class="fas fa-plus" style="margin-right: 8px;"></i> Create Notification</button></h4>
        <hr class="mt-2 mb-4">
        <div id="notifications-wrapper">
            <a class="card mb-2" href="#">
                <div class="row">
                    <div class="col-2">
                        <div style="width: 100%;height: 100%; border-bottom-left-radius: 5px;border-top-left-radius: 5px;" class="bg-primary">
                        <i class="fas fa-exclamation-triangle text-white" style="width: 100%;text-align: center;font-size: 70px;height: 100%;line-height: 135px;" ></i>
                    </div>
                    </div>
                    <div class="col">
                        <div class="card-body py-4">
                            <h5 class="card-title text-primary mb-2">Getting Started</h5>
                            <p class="card-text mb-1">Basic information about getting started including installation instructions, setup, and basic usage.</p>
                            <div class="small text-muted">5 articles in this category</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
        <div class="modal fade" id="popup_create_notification"  tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Notification</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="popup_create_notification__form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" name="group" placeholder="Group">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="channel" placeholder="Channel">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="subject"  placeholder="Subject:">
                        </div>
                        <div class="form-group">
                            <textarea id="compose-textarea" name="content" class="form-control" style="height: 300px"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                            <button id="popup_create_notification__send-btn" type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                        </div>
                        <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var pusher = new Pusher('285747dd0c21472794fc', {
          cluster: 'ap1'
        });
    
        var channel = pusher.subscribe('users');
        channel.bind('1', function(data) {
            data = JSON.parse(data);
            let elm = $(`
            <a class="card mb-2" href="#">
                <div class="row">
                    <div class="col-2">
                        <div style="width: 100%;height: 100%; border-bottom-left-radius: 5px;border-top-left-radius: 5px;" class="bg-primary">
                        <i class="fas fa-exclamation-triangle text-white" style="width: 100%;text-align: center;font-size: 70px;height: 100%;line-height: 135px;" ></i>
                    </div>
                    </div>
                    <div class="col">
                        <div class="card-body py-4">
                            <h5 class="card-title text-primary mb-2">`+ data.subject +`</h5>
                            <div class="card-text mb-1">`+ data.content +`</div>
                        </div>
                    </div>
                </div>
            </a>
            `);

            $('#notifications-wrapper').append(elm);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#popup_create_notification__form').submit(function (e) { 
                e.preventDefault();
                let data = $(this).serializeArray();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/administrator/tours/{{$tour->id}}/notifications/save-create",
                    method: 'post',
                    dataType: 'json',
                    data: data,
                    success: function (res) { 
                    }
                });
                return false;
            });
        });
    </script>
@endsection
