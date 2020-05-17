@extends('layouts.app')
@section('title')
تعديل المريض
@endsection
@section('mainsubject')
تعديل المريض
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('patient.all')}}">المرضي</a></li>
    <li class="breadcrumb-item active">{{$Patient->name}} <i class="fas fa-user-injured"></i></li>
@endsection
@section('content')
<div class="row">
          <div class="col-12">
              <!-- Default box -->
               <!-- card patient  -->
              <div class="card">
                <!-- card-header -->
                <div class="card-header">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  <div class="card-tools">
                    <h3 class="card-title ">{{$Patient->name}} <i class="fas fa-user-injured"></i></h3>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- card-body -->
                <div class="card-body">
                <div class='container' dir='rtl'>
                    <div class="row" dir="rtl" style="text-align: right;">
                            <div class="form-group col-2">
                                <label class="control-label">رقم الحاسب</label> 
                                <input type="text" class="form-control code"  data="{{$Patient->ID}}" value="{{$Patient->code}}">
                            </div>
                            <div class="form-group col-3">
                                <label class="control-label">اسم المريض</label> 
                                <input type="text" class="form-control name"  value="{{$Patient->name}}">
                            </div>
                            <div class="form-group col-2">
                                <label class="control-label">الرتبة</label> 
                                @if(!$Patient->rank)
                                    <select class="form-control rank">
                                        <option></option>
                                        @foreach($ranks as $rank)
                                            <option value="{{$rank->ID}}">{{$rank->RName}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control rank" data="{{$Patient->rank->ID}}">
                                        <option></option>
                                        @foreach($ranks as $rank)
                                            <option value="{{$rank->ID}}">{{$rank->RName}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="form-group col-2">
                                <label class="control-label">درجة القرابة</label> 
                                @if(!$Patient->frank)
                                    <select class="form-control frank">
                                        <option></option>
                                        @foreach($franks as $frank)
                                            <option value="{{$frank->ID}}">{{$frank->FRName}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-control frank" data="{{$Patient->frank->ID}}">
                                        <option></option>
                                        @foreach($franks as $frank)
                                            <option value="{{$frank->ID}}">{{$frank->FRName}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="form-group col-2">
                                <button class="btn btn-primary update-info" style="margin-top:32px;width:100%">تحديث</button>
                            </div>
                    </div>
                    <div class="row relat_to" dir="rtl" style="display:none;text-align: right;">
                            <div class="form-group col-3">
                                <label class="control-label">بحث</label> 
                                <input type="text" class="form-control search_parent">
                            </div>
                            <div class="form-group col-2">
                            </div>
                            <div class="form-group col-5">
                                <label class="control-label">الرتبة</label> 
                                <input type="text" class="form-control parent" readonly >
                            </div>
                            
                    </div>
                </div>
                </div>
                <!-- /.card-body -->
                <!-- card-footer-->
                <div class="card-footer">
                  <i class="fas fa-user-injured"></i>
                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card   -->

              
          </div>
</div>
@endsection
@section('css')
<link  href="{{asset('css/sweetalert2.min.css')}}">
<link  href="{{asset('css/jquery-ui.min.css')}}">

@endsection
@section('script')
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/editpatient.js')}}"></script>
@endsection