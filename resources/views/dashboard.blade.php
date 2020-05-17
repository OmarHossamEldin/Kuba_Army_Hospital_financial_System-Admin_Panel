@extends('layouts.app')
@section('title')
لائحة التحكم
@endsection
@section('mainsubject')
لائحة التحكم
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{route('dashboard')}}">لائحة التحكم /</a></li>
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
                    <h3 class="card-title ">لائحة التحكم</h3>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- card-body -->
                <div class="card-body">
                
                  <div class='container' dir='rtl'>
                            <!-- content -->
                     
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- card-footer-->
                <div class="card-footer">
                
                <i class="fas fa-cogs fa-lg"></i>
                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card -->
          </div>
</div>
@endsection
@section('script')
<script ></script>
@endsection