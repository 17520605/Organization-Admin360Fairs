<!DOCTYPE html>
<html lang="en">
    @include('components.header')
    <body id="page-top">
        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content" style="min-height: 100vh;">
                    @yield('content')
                </div>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin-master/asset/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin-master/asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin-master/asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    </body>
</html>
