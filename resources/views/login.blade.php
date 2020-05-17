@extends('layouts.ui-log')
@section('title')
تسجيل الدخول
@endsection
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b><i class="fas fa-cogs fa-lg"></i>&nbsp;</b>البرنامج المالي</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">تسجيل الدخول لبدء التحكم</p>

      <form action="{{route('login')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control text-center" name='username' value="{{ old('username') }}" required placeholder="اسم المستخدم">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control text-center" name='password' required placeholder="كلمت المرور">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block">تسجيل الدخول</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{route('forgetPassword')}}">لقد نسيت كلمة المرور</a>
      </p>
      
    </div>
    
    <!-- /.login-card-body -->
  </div>
  <div class='test' dir='rtl'>
    <strong  > جميع الحقوق محفوظة<br><a href="#"> فرع نظم ومعلومات المجمع الطبي ق.م كوبري القبة</a><br>  &copy; 
      <script>
          var x= new Date().getFullYear();
          document.write (x+1);
          document.write ('-');
          document.write (x); 
        </script>  
      </strong> 
  </div>
</div>
<!-- /.login-box -->

@endsection