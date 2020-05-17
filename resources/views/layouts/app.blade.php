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
  <!-- arabic font for the app -->
  <link rel="stylesheet" href="{{asset('font/stylesheet.css')}}">

  <!-- jquery ui -->
  <link href="{{asset('css/jquery-ui.min.css')}}" rel="stylesheet">
  <!-- jquery ui -->

  <style>
  body{
    font-family:'air_strip_arabicregular' Arial, sans-serif;
    font-weight:bold;
    font-style:normal;
  }
  </style>
  <!-- my css -->
  <link rel="stylesheet" href="{{asset('css/mycss.css')}}">
  @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed" >


<!-- Site wrapper -->
<div class="wrapper"  >

  @include('inc.navbar')
   <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('img/20128411.jpg')}}"
           alt="Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{"البرنامج المالي"}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" dir="rtl">
        <div class="info">
          <a href="{{route('dashboard')}}" class="d-block" >{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-users"></i>
              <p >
                المستخدمين
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="\user/create" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>انشاء مستخدم</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.all')}}" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>جميع المستخدمين</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link" >
              <i class="fas fa-user-injured"></i>
              <p >
                المرضي
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('patient.all')}}" class="nav-link">
                  <i class="fas fa-procedures"></i>
                  <p>جميع المرضي</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link" >
              <i class="fas fa-bed"></i>
              <p >
                الزيارات
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('visitin.all')}}" class="nav-link">
                  <i class="fas fa-bed"></i>
                  <p>جميع الزيارات</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- logout -->
          <li class="nav-item has-treeview">
            <a href="{{route('logout')}}" class="nav-link" >
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    تسجيل الخروج
                </p>
              </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                @yield('breadcrumb')
            </ol>
          </div>
          <div class="col-sm-6 text-right">
              <h1>@yield('mainsubject')</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        @include('inc.notifi')
        @yield('content')
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  
<!-- paste here!-->
  <footer class="main-footer" >
    <div class="float-right d-none d-sm-block">
    <strong  class="text-right"> جميع الحقوق محفوظة<a href="#"> فرع نظم ومعلومات المجمع الطبي ق.م كوبري القبة</a>  &copy; 
      <script>
        var x= new Date().getFullYear();
        document.write (x+1);
        document.write ('-');
        document.write (x);
        
      </script> 
    </strong> 
      
    </div>
    <strong>verison 1.0.0</strong> 
    
  </footer>
  
</div>
<!-- ./wrapper -->

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
  <!-- jquery ui -->
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
  <!-- jquery ui -->
@yield('script')
</html>
