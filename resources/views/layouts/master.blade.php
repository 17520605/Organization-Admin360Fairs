<!DOCTYPE html>
<html lang="en">
    @include('components.header')
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            @include('components.navbar-left')

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
        @include('components.up_object')

        @include('components.add_event')
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
        function addAgenda() {
            $('.add-agenda').hide();
            $('.remove-agenda').show();
            $("#add-new-input").append(`<div class="row gx-3 mb-3 agenda_record">
                <div class="col-md-6">
                    <input class="form-control" id="" type="text" placeholder="Enter Type tour">
                </div>
                <div class="col-md-1" style="padding: 0;">
                    <input class="form-control" id="" type="number" min="0" max="500" style="padding-right: 0!important;" placeholder="Time">
                </div>
                <div class="col-md-4" style="padding-right:0px ;">
                    <select class="form-control" name="" id="">
                        <option value="">-Choose speaker-</option>
                        <option value="volvo">Nguyễn Khai</option>
                        <option value="saab">Ngọc Khải</option>
                    </select>
                </div>
                <div class="col-md-1" style="text-align: center;">
                    <i class="fas fa-plus-circle add-agenda" onclick="addAgenda();" style="font-size: 25px;color: #4e73df;line-height: 38px;"></i>
                    <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px; display: none;"></i>
                </div>
            </div>`);
        }

        function removeAgenda(e) {
            $(e.currentTarget).parent().parent().remove();
        }
    </script>
    <script>
        // image gallery
        // init the state from the input
        $(".image-checkbox").each(function() {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
                $(this).addClass('show');
            } else {
                $(this).removeClass('image-checkbox-checked');
                $(this).removeClass('show');
            }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function(e) {
            $(this).toggleClass('image-checkbox-checked');
            var $checkbox = $(this).find('input[type="checkbox"]');
            $checkbox.prop("checked", !$checkbox.prop("checked"))

            e.preventDefault();
        });
        //# sourceURL=pen.js
    </script>
    </body>
</html>
