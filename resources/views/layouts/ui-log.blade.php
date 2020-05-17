<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- title -->
  <title>@yield('title','البرنامج المالي')</title>
  <!--icon -->
  <link rel="shortcut icon" href="{{asset('img/20128411.ico')}}" type="image/x-icon">
   <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin_panel/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin_panel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin_panel/dist/css/adminlte.min.css')}}">
  <style>
  body{
    font-family:'air_strip_arabicregular' Arial, sans-serif;
    font-weight:bold;
    font-style:normal;
  }
  .test{
    text-align:center;
  }
  </style>
</head>

<body class="hold-transition login-page">
@include('inc.notifi')
  @yield('content')

</body>
<!-- jQuery -->
<script src="{{asset('admin_panel/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_panel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin_panel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_panel/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_panel/dist/js/demo.js')}}"></script>
<script>
$(document).ready(function(){

$('input').attr("autocomplete","off");  
});
</script>
@yield('script')
</html>
