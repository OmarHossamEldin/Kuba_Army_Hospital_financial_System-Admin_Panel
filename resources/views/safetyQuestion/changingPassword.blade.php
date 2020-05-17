@extends('layouts.ui-log')
@section('title')
تغير كلمة المرور
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
            <h3 class="login-box-msg">تغير كلمة المرور</h3>

            <form action='{{route('newPassword')}}' method='POST' dir='rtl' style="text-align: right;">
                @csrf
                <div class="form-group">
                    <label for="Password">كلمة المرور الجديدة</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="كلمة المرور">
                </div>
                <div class="form-group">
                    <label for="Password">تأكيد كلمة المرور</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="تأكيد كلمة المرور">
                    <input type='hidden' name='id' value='{{$username}}'>
                </div>
                <div class="row">
                    <div class="col-3">
                    <!-- /.col -->
                    </div>
                    <!-- /.col -->
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block ">ادخـــــــــال</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
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

@endsection