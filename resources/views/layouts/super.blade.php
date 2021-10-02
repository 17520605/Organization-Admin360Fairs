<!DOCTYPE html>
<html lang="en">
    @include('components.header')
    <body id="page-top">
        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content" style="min-height: 100vh;">
                    @include('components.navbar-top-super')
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
        function onActiveTourCard() {
            let icon = document.querySelector('.icon_show_hide_card');
            let card_body = document.querySelector('.card_body');
            icon.classList.toggle('active');
            card_body.classList.toggle('active');
        }
    </script>
    </body>
</html>
