<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.min.css') }}">
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
        <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
        <style>
            html {
                height: 100%;
            }
            body {
                height: 100%;
            }
            .container-fluid {
                padding: 0px;
            }
            .table > tbody > tr > th, .table > tbody > tr > td {
                vertical-align: middle;
            }
            .hover:hover {
                background-color: #f08080;
                color: #FFFFFF;
                cursor: pointer;
            }
            .hover-green:hover {
                background-color: #00BB00;
                color: #FFFFFF;
                cursor: pointer;
            }
        </style>
        @yield('css')
        <script>

        </script>
        @yield('_js')
    </head>

    <body>
        <div class="container-fluid">
            @yield('content')
        </div>
        @yield('modal')
        @yield('js')
        <script src="{{ asset('js/Functions.js') }}"></script>
        <script>

        </script>
    </body>

</html>
