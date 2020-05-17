@extends('layouts.app')
@section('title')
جميع المرضي
@endsection
@section('mainsubject')
جميع المرضي
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('patient.all')}}">المرضي</a></li>
    <li class="breadcrumb-item active">جميع المرضي</li>
@endsection
@section('content')
<div class="row">
          <div class="col-12">
              <!-- Default box -->
               <!-- card  search -->
              <div class="card">
                <!-- card-header -->
                <div class="card-header">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  <div class="card-tools">
                    <h3 class="card-title ">جميع المرضي</h3>
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
                          <input type="text" class="form-control patient" placeholder="بحث">
                        </div>
                      </div><br>
                      <div class='message'></div>
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- card-footer-->
                <div class="card-footer">
                  <i class="fas fa-search"></i>
                  بحث
                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card  search -->

              <!-- card result -->
              <div class="card">
                <!-- card-header -->
                <div class="card-header">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  <div class="card-tools">
                    <h3 class="card-title "> <i class="fas fa-procedures "></i> النتائج</h3>
                  </div>
                  
                </div>
                <!-- /.card-header -->
                <!-- card-body -->
                <div class="card-body">
                
                  <div class='container' dir='rtl'>
                    <div class='patients-result'>
                    </div>          
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- card-footer-->
                <div class="card-footer">
                <i class="fas fa-procedures"></i>
                  المرضي
                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card result -->
          </div>
</div>
@endsection
@section('css')
<link  href="{{asset('css/sweetalert2.min.css')}}">
@endsection
@section('script')
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('js/patients.js')}}"></script>

@endsection