@extends('layouts.app')
@section('title')
انشاء مستخدم
@endsection
@section('mainsubject')
انشاء مستخدم
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('user.all')}}">المستخدمين</a></li>
    <li class="breadcrumb-item active"><a href="{{route('user.register')}}">انشاء مستخدم</a></li>
@endsection
@section('content')
<div class="row">
          <div class="col-12">
              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  <div class="card-tools">
                    <h3 class="card-title ">انشاء مستخدم</h3>
                  </div>
                </div>
                <div class="card-body">
                <div class='container' dir='rtl'>
                    <div class='row'>
                        <form class='col-6 text-right' action="{{route('user.register')}}" method="Post">
                          @csrf
                            <div class="form-group" >
                              <label for="InputName">الاسم</label>
                              <input type="text" class="form-control" id="name" name="name" aria-describedby="namehelp" placeholder="الاسم">
                            </div>
                            <div class="form-group" >
                              <label for="InputUsername">اسم المستخدم</label>
                              <input type="text" class="form-control" id="username"  name="username" aria-describedby="Usernamehelp" placeholder="اسم المستخدم">
                              <small id="usernameHelp" class="form-text text-muted">لا تشاركه مع شخص اخر.</small>
                            </div>
                            <div class="form-group">
                              <label for="Password">كلمة المرور</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="كلمة المرور">
                            </div>
                            <div class="form-group">
                              <label for="Password">تأكيد كلمة المرور</label>
                              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="تأكيد كلمة المرور">
                            </div>
                            <div class="form-group">
                              <label for="Password">التصريح</label>
                              <select name="permission" class="browser-default custom-select permission">
                                <option selected value="0">عادي</option>
                                <option value="1">متحكم</option>
                              </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary form-group">تسجيل</button>
                        </form>
                    </div>
                  </div>
                </div>
                
                <!-- /.card-body -->
                <div class="card-footer">
                <i class="fas fa-cogs fa-lg"></i>
                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card -->
          </div>
</div>
@endsection
