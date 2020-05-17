@extends('layouts.app')
@section('title')
جميع المستخدمين
@endsection
@section('mainsubject')
جميع المستخدمين
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('user.all')}}">المستخدمين</a></li>
    <li class="breadcrumb-item active">جميع المستخدمين</li>
@endsection
@section('content')
<div class="row">
          <div class="col-12">
              <!-- Default box -->
               <!-- card -->
              <div class="card">
                <!-- card-header -->
                <div class="card-header">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  <div class="card-tools">
                    <h3 class="card-title ">جميع المستخدمين</h3>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- card-body -->
                <div class="card-body">
                
                  <div class='container' dir='rtl'>
                      <div class='row'>
                        <div class='col-5'></div>
                        <div class="form-group has-search" dir='ltr'>
                          <span class="fa fa-search form-control-feedback"></span>
                          <input type="text" class="form-control searchusername" placeholder="بحث">
                        </div>
                      </div><br>
                      <div class='row'>
                        <table id="example2" class="table table-bordered table-hover col-12">
                            <thead>
                            <tr>
                              <th>التسلسل</th>
                              <th>الاسم</th>
                              <th>اسم المستخدم</th>
                              <th>التصريح</th>
                              <th>تاريخ الانشاء</th>
                            </tr>
                            </thead>
                            <tbody class="data-rows">
                            @if($users->count()>0)
                                @foreach($users as $user)
                                  <tr>
                                    <td><a href="\user/{{$user->id}}/edit">{{$user->id}}</a></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    @if($user->permission==1)
                                      <td>متحكم</td>
                                      @elseif($user->permission==0) 
                                      <td>عادي</td>
                                    @endif
                                    <td>{{$user->updated_at->toFormattedDateString()}}</td>
                                  </tr>  
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                              <th>التسلسل</th>
                              <th>الاسم</th>
                              <th>اسم المستخدم</th>
                              <th>التصريح</th>
                              <th>تاريخ الانشاء</th>
                            </tr>
                            </tfoot>
                        </table>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- card-footer-->
                <div class="card-footer">
                {{$users->links()}}
                <i class="fas fa-cogs fa-lg"></i>
                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card -->
          </div>
</div>
@endsection
@section('script')
<script src="{{asset('js/users.js')}}"></script>
@endsection