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

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
      
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('admin-master/asset/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('admin-master/asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('admin-master/asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('admin-master/asset/js/sb-admin-2.min.js')}}"></script>

        <script src="{{ asset('admin-master/asset/js/adminlte.min.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('admin-master/asset/vendor/chart.js/Chart.min.js')}}"></script>
        <!-- Page level custom scripts -->
        <script src="{{ asset('admin-master/asset/js/demo/chart-area-demo.js')}}"></script>

        <script src="{{ asset('admin-master/asset/js/demo/chart-pie-demo.js')}}"></script>
        <!-- Page level plugins -->
        <script src="{{ asset('admin-master/asset/vendor/datatables/jquery.dataTables.min.js')}}"></script>

        <script src="{{ asset('admin-master/asset/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('admin-master/asset/js/demo/datatables-demo.js')}}"></script>

    <script src="{{ asset('admin-master/asset/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
    <script src="{{ asset('admin-master/asset/plugins/summernote/summernote-bs4.min.js')}}"></script>
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
    </body>
</html>
