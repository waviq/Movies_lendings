<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Movies | Home</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/vendor.css')}}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    @yield('css_custom')
</head>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('layouts.header')

    @include('layouts.sidebar')

    @include('layouts.content')
    @include('layouts.footer')

    <div class="control-sidebar-bg"></div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
@yield('js_custom')

</body>
</html>
