@extends('Admin.leading._AdminLayout')

@section('title')
    常用連結
@stop

@section('css')
    <style>
        .container-fluid {
            padding: 20px 36px;
        }
        tbody > tr > td {
            width: 50%;
        }
        .mask {
            position: relative;
            margin: 8px 0px;
            /* width: 160px; */
            height: 60px;
            overflow: hidden;
            border: 1px solid #2194E0;
            background-color: #FFFFFF;
            color: #2194E0;
            font-size: 20px;
            font-weight: bold;
        }
        .mask:before {
            display: block;
            position: absolute;
            top: 0px;
            left: -4em;
            width: 36px;
            height: 100%;
            transform: skewX(-45deg) translateX(0);
            content: "";
            background-color: rgba(255, 255, 255, 0.5);
        }
        .mask:hover {
            cursor: pointer;
            background-color: #2194E0;
            color: #FFFFFF;
        }
        .mask:hover:before {
            z-index: 2;
            transform: skewX(-45deg) translateX(800px);
            transition: all 0.8s ease-in-out;
        }
        .mask:active {
            opacity: 0.6;
        }
    </style>
@stop

@section('content')
    @include("Admin.link.{$site}")
@stop

@section('js')
    <script>
        $(function() {
            $('button').attr('onclick', 'newWindows(this)');
        });

        function newWindows(_this) {
            window.open($(_this).attr('href'));
        }
    </script>
@stop
