@extends('layouts.ui-log')
@section('title')
سؤال الامان
@endsection
@section('content')
<div class='container'>

  <div class="login-logo">
    <a href="/"><b><i class="fas fa-cogs fa-lg"></i>&nbsp;</b>البرنامج المالي</a>
  </div>
  <!-- /logo -->
  <div class='row'>
    <div class="card col-12">
        <div class="card-body login-card-body col-12">
            <h3 class="login-box-msg">نسيت كلمة المرور</h3>

            <div>
                @csrf
                <div class="form-group" dir='rtl' style="text-align: right;">
                    <label for="username" class='question'>من فضلك ادخل اسم المستخدم الخاص بك؟</label>
                    <input type="text" class="form-control answer" id="key" required name="username" aria-describedby="username" placeholder="اسم المستخدم">
                    <label for="msg" class='msg-alert'></label>
                </div>
                <div class="row">
                    <div class="col-3">
                    <!-- /.col -->
                    </div>
                    <!-- /.col -->
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block store">ادخـــــــــال</button>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        
        <!-- /.card-body -->
    </div>
  </div>
  
  <div class="text-right">
    <strong  class="text-right"> جميع الحقوق محفوظة<a href="#"> النظم كوبري القبة</a>  &copy; <script>
        var x= new Date().getFullYear();
        document.write (x+1);
        document.write ('-');
        document.write (x); 
      </script>  </strong> 
  </div>
</div>
@endsection
@section('script')
<script src="{{asset('js/forgetpassword.js')}}" ></script>
@endsection