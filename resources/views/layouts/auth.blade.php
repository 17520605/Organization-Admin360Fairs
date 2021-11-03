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
        $('.btn-icon-loader').click(function(){
            $('.icon-loader-form').show();
        });
        $('.btn-icon-loader-delete').click(function(){
            $('.icon-loader-form-delete').show();
        });
    </script>
</html>
