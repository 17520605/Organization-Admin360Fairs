<!DOCTYPE html>
<html lang="en">
    @include('components.header')
    <body id="page-top">
        @include('components.page-loader')
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            @include('components.partner-navbar-left')

            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->

                <div id="content">

                    @include('components.navbar-top')

                    @yield('content')

                </div>

                <!-- Footer -->

                @include('components.footer')

            </div>
            <!-- End of Content Wrapper -->
        </div>

        {{-- POP --}}
        <!-- Scroll to Top Button-->

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        {{-- <script>
            $(function() {
                $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox({
                        alwaysShowClose: true
                    });
                });
                $('.filter-container').filterizr({
                    gutterPixels: 3
                });
                $('.btn[data-filter]').on('click', function() {
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });
            })
        </script> --}}

        <script src="{{ asset('admin-master/asset/js/sb-admin-2.min.js')}}"></script>
        <script src="{{ asset('admin-master/asset/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
        <script src="{{ asset('admin-master/asset/vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('admin-master/asset/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('admin-master/asset/js/demo/datatables-demo.js')}}"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <script>
            $(function() {
                //Enable check and uncheck all functionality
                $('.checkbox-toggle').click(function() {
                    var clicks = $(this).data('clicks')
                    if (clicks) {
                        //Uncheck all checkboxes
                        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
                        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
                    } else {
                        //Check all checkboxes
                        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
                        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
                    }
                    $(this).data('clicks', !clicks)
                })

                //Handle starring for font awesome
                $('.mailbox-star').click(function(e) {
                    e.preventDefault()
                        //detect type
                    var $this = $(this).find('a > i')
                    var fa = $this.hasClass('fa')

                    //Switch states
                    if (fa) {
                        $this.toggleClass('fa-star')
                        $this.toggleClass('fa-star-o')
                    }
                })
            })
        </script>

         {{-- NOTIFICATIONS --}}
         <script>
            $(document).ready(function () {
                loadNotifications();

                var pusher = new Pusher('{{env("PUSHER_APP_KEY")}}', {
                    cluster: '{{env("PUSHER_APP_CLUSTER")}}'
                });

                var channel = pusher.subscribe('users@'+'{{$profile->id}}');
                channel.bind('webinar@new', function(res) {
                    let notification = JSON.parse(res);
                    let text = $('#top-nav-notifications__count').text();
                    let notifCount = text == "" ? 1 : parseInt(text) + 1;
                    $('#top-nav-notifications__count').text(notifCount);
                    $('#top-nav-notifications__count').show();

                    $('#top-nav-notifications__wrapper').append(createHTMLNotification(notification));
                });
            });
            
            function createHTMLNotification(notification) { 
                let elm = null;
                switch (notification.type) {
                    case '{{\App\Models\Notification::INFO}}':
                        elm = $(`
                            <a class="dropdown-item d-flex align-items-center" href="/partner/booths/{{$booth->id}}/notifications?active=`+ notification.id +`">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">`+ moment(notification.created_at).format('MMMM DD YYYY hh:mm') +`</div>
                                    <span class="font-weight-bold">`+ notification.title +`</span>
                                    <span>`+ notification.content +` </span>
                                </div>
                            </a>
                        `);
                        break;

                    default:
                        break;
                };
                
                return elm;
            };

            function loadNotifications() {  
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/partner/booths/{{$booth->id}}/notifications/get-unseen",
                    method: 'get',
                    dataType: 'json',
                    success: function (notifications) {
                        $('#top-nav-notifications__count').text(notifications.length);
                        if(notifications.length > 0){
                            $('#top-nav-notifications__count').show();
                        }
                        else{
                            $('#top-nav-notifications__count').hide();
                        }
                        
                        notifications.forEach(notification => {
                            $('#top-nav-notifications__wrapper').append(createHTMLNotification(notification));
                        });

                        // thực hiện mở notification ở page notification#id
                        try {
                            activeNotificationSelected();
                        } catch (error) {
                            
                        }
                    }
                });
            }
        </script>
        <script>
            $('body').on('click', function (e) {
                if (!$('li.dropdown').is(e.target) 
                    && $('li.dropdown').has(e.target).length === 0 
                    && $('.open').has(e.target).length === 0
                ) {
                    $('li.dropdown').removeClass('open');
                }
            });
        </script>
        <script>
            $(function() {
                //Add text editor
                $('#compose-textarea').summernote()
            })
        </script>
        <script>
            $('#btn_object_local').click(function(){
                $('#btn_object_local').addClass("active");
                $('#btn_object_link').removeClass("active");
                $('#create_upload_object').find('.form-step1').show();
                $('#create_upload_object').find('.form-step2').hide();
            });
            $('#btn_object_link').click(function(){
                $('#btn_object_link').addClass("active");
                $('#btn_object_local').removeClass("active");
                $('#create_upload_object').find('.form-step1').hide();
                $('#create_upload_object').find('.form-step2').show();
            });
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover({
                placement: 'top',
                trigger: 'hover'
            });
        });
    </script>
    <script>
        $('.btn-page-loader').click(function(){
            $('.page-loader-wrapper').show();
        });
        $('.btn-icon-loader').click(function(){
            $('.icon-loader-form').show();
        });
        $('.btn-icon-loader-delete').click(function(){
            $('.icon-loader-form-delete').show();
        });
    </script>
    <script>
        $('table').DataTable();
    </script>
    </body>
</html>
