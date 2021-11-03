<!DOCTYPE html>
<html lang="en">
    @include('components.header')
    <body class="bg-gradient-primary">
        @include('components.page-loader')
        @yield('content')
    </body>
    <script>
        $('.btn-page-loader').click(function(){
            $('.page-loader-wrapper').show();
        });
    </script>
</html>
