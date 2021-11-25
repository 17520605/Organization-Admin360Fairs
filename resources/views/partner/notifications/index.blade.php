@extends('layouts.partner')

@section('content')
<div class="container-fluid notification_col">
    <div class="container">
        <div class="m-b-50 "> 
            <h3 class="heading-line"> Notifications <i class="fa fa-bell text-muted"></i></h3>
            <div>Only unread notifications <input id="only-unseen-checkbox" type="checkbox"></div>
        </div>
        <div class="notification-ui_dd-content">
            @foreach ($notifications as $notification)
            <div class="notification-list {{$notification->isSeen == false ? 'unseen' : ''}}" data-notification-id="{{$notification->id}}">
                <div class="notification-list_content">
                    <div class="notification-list_img">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div class="notification-list_detail">
                        <p><b>{{$notification->title}}</b></p>
                        <p class="text-muted">{!! $notification->content !!}</p>
                        <p class="text-muted"><small>{{Carbon\Carbon::parse($notification->created_at)->format('M d Y g:i A')}}</small></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.notification-list').click(function () {  
            let notificaionId = $(this).attr('data-notification-id');
            if($(this).hasClass('active')){
                $(this).removeClass('active');
            }
            else{
                seenNotification(notificaionId);
            }
        })

        $('#only-unseen-checkbox').change(function (e) { 
            let checked = $(this).is(':checked');
            if(checked){
                $('.notification-list').not('.unseen').hide();
            }
            else{
                $('.notification-list').show();
            }
        });
    });

    function seenNotification(notificaionId) 
    {  
        if(notificaionId != null && notificaionId != ""){
            $('.notification-list[data-notification-id="'+notificaionId+'"]').addClass('active');
            $('.notification-list[data-notification-id="'+notificaionId+'"]').removeClass('unseen');

            // scroll page to this
            // TODO

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "/partner/booths/" + "{{$booth->id}}" + "/notifications/" + notificaionId + "/set-seen",
                data: {
                    notificaionId: notificaionId
                },
                success: function (res) {  
                    if(res == true || res == 1){
                        $('#top-nav-notifications__wrapper').find('.nav-notification-item[data-notification-id="'+notificaionId+'"]').remove();
                        let count = parseInt($('#top-nav-notifications__count').text()) - 1;
                        $('#top-nav-notifications__count').text(count);
                        if(count <= 0){
                            $('#top-nav-notifications__count').hide();
                        }
                    }
                }
            });
        }
        
    }

    function activeNotificationSelected() {  
        let notificaionId = new URL(location.href).searchParams.get('active');
        seenNotification(notificaionId);

        // scroll page to this
        // TODO
    }
</script>
@endsection
