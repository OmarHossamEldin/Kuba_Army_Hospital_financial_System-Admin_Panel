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
            <h3 class="login-box-msg">سؤال الامان</h3>

            <form action="{{route('answerStore')}}" method="post">
                @csrf
                <div class="form-group answer" dir='rtl' style="text-align: right;">
                    <label for="InputQuestion answer">{{$question[$key]}}</label>
                    <input type="text" class="form-control answer" id="key" required name="answer" aria-describedby="answerhelp" placeholder="الاجابة">
                </div>
                <input type="hidden" name="key" value="{{$key}}">
                <div class="row">
                    <div class="col-3">
                    <!-- /.col -->
                    </div>
                    <!-- /.col -->
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block">اجــــــــــــــابة</button>
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