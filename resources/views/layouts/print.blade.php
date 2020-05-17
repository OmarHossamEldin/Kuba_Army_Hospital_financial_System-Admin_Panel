<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- title -->
  <title>@yield('title','البرنامج المالي')</title>
   <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- fontawesome  -->
  <link rel="stylesheet" href="{{ asset('admin_panel/plugins/fontawesome-free/css/all.min.css') }}">
   <!-- Bootstrap 4 -->
  <link rel="stylesheet"  href="{{asset('css/bootstrap.min.css')}}">
   <!-- print css -->
  <link rel="stylesheet"  href="{{asset('css/print.css')}}">

</head>

<body class="hold-transition login-page">

  @yield('content')

</body>
<!-- jQuery -->
<script src="{{asset('admin_panel/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_panel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
@yield('script')
</html>
