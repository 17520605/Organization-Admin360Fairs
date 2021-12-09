@extends('layouts.master')

@section('content')
<div class="container-fluid notification_col">
    <div class="container">
        <div class="mb-4 "> 
            <h3 class="heading-line"> Notifications <i class="fa fa-bell text-muted"></i></h3>
            <div class="mt-2"><input id="only-unseen-checkbox" class=" checkbox form-check-input1 dt-checkboxes" style="margin-right: 10px" type="checkbox">  Only unread notifications </div>
        </div>
        <div class="notification-ui_dd-content">
            @foreach ($notifications as $notification)
            <div style="position: relative" class="notification-list {{$notification->isSeen == false ? 'unseen' : ''}}" data-notification-id="{{$notification->id}}">
                <div class="notification-list_content" style="width: 100%;">
                    <div class="notification-list_img">
                        @if($notification->type == 'success')
                            <div class="icon-circle bg-success">
                                @if($notification->channel == 'booth@booth' || $notification->channel == 'booth@approve'||$notification->channel == 'booth@cancel'||$notification->channel == 'booth@reedit' ||$notification->channel == 'booth@reject'||$notification->channel == 'booth@request' )
                                    <i class="fas fa-store text-white"></i>
                                @elseif($notification->channel == 'webinar@new' || $notification->channel == 'webinar@approve'||$notification->channel == 'webinar@reedit'||$notification->channel == 'webinar@reject')
                                    <i class="fas fa-calendar-check text-white"></i>
                                @else
                                    <i class="fas fa-bell text-white"></i>
                                @endif
                            </div>
                        @elseif($notification->type == 'info')
                            <div class="icon-circle bg-info">
                                @if($notification->channel == 'booth@booth' || $notification->channel == 'booth@approve'||$notification->channel == 'booth@cancel'||$notification->channel == 'booth@reedit' ||$notification->channel == 'booth@reject'||$notification->channel == 'booth@request' )
                                    <i class="fas fa-store text-white"></i>
                                @elseif($notification->channel == 'webinar@new' || $notification->channel == 'webinar@approve'||$notification->channel == 'webinar@reedit'||$notification->channel == 'webinar@reject')
                                    <i class="fas fa-calendar-check text-white"></i>
                                @else
                                    <i class="fas fa-bell text-white"></i>
                                @endif
                            </div>
                        @elseif($notification->type == 'warning')
                            <div class="icon-circle bg-warning">
                                @if($notification->channel == 'booth@booth' || $notification->channel == 'booth@approve'||$notification->channel == 'booth@cancel'||$notification->channel == 'booth@reedit' ||$notification->channel == 'booth@reject'||$notification->channel == 'booth@request' )
                                    <i class="fas fa-bell text-white"></i>
                                @elseif($notification->channel == 'webinar@new' || $notification->channel == 'webinar@approve'||$notification->channel == 'webinar@reedit'||$notification->channel == 'webinar@reject')
                                    <i class="fas fa-bell text-white"></i>
                                @else
                                    <i class="fas fa-bell text-white"></i>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="notification-list_detail" style="width: 80%;">
                        <p><b>{{$notification->title}}</b></p>
                        <p class="text-muted">{!! $notification->content !!}</p>
                        <p class="text-muted"><small>{{Carbon\Carbon::parse($notification->created_at)->format('M d Y g:i A')}}</small></p>
                    </div>
                </div>
                @if($notification->isSeen == false ? 'unseen' : '')
                    <i class="fas fa-envelope text-primary" style="position: absolute; right: 10px; top: 10px"></i>
                @else
                    <i class="fas fa-envelope-open text-primary" style="position: absolute; right: 10px; top: 10px"></i>
                @endif
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
                url: "/administrator/tours/" + "{{$tour->id}}" + "/notifications/" + notificaionId + "/set-seen",
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
    }
</script>
@endsection
