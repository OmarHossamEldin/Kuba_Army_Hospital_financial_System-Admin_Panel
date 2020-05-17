@extends('layouts.app')
@section('title')
تعديل الزيارة
@endsection
@section('mainsubject')
تعديل الزيارة
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('visitin.all')}}">الزيارات</a></li>
    <li class="breadcrumb-item active">تعديل الزيارة</li>
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
                    <h3 class="card-title ">تعديل الزيارة</h3>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- card-body -->
                <div class="card-body">
                
                  <div class='container' dir='rtl'>
                      <div class="row" dir="rtl" style="text-align: right;">
                            <div class="form-group col-2">
                                <label class="control-label">التسلسل</label> 
                                <input type="text" class="form-control"value="{{$visitIn->ID}}" readonly>
                            </div>
                            <div class="form-group col-3">
                                <label class="control-label">المريض</label> 
                                <input type="text" class="form-control name"  value="{{$patientname}}" readonly>
                            </div>
                            <div class="form-group col-2">
                                <label class="control-label">رصيد</label>
                                <div class="input-group">
                                    <input type="text" class="form-control total pointer" visitInid="{{$visitIn->ID}}" readonly  value="{{$visitIn->myCash}}">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text gp" ><i class="fas fa-money-bill-alt"></i></span>
                                </div>
                            </div>
                            </div>
                            <div class="form-group col-2">
                                <label class="control-label">تاريخ الدخول</label>
                                <input type="text" class="form-control start pointer" visitInid="{{$visitIn->ID}}" data="{{$visitIn->date}}"readonly  value="{{Carbon\Carbon::create($visitIn->date)->toFormattedDateString()}}">  
                            </div>
                            @if($visitIn->VisitOut()->first()->date!=NULL)
                            <div class="form-group col-2">
                                <label class="control-label">تاريخ الخروج</label>
                                <input type="text" class="form-control end pointer" visitInid="{{$visitIn->ID}}" data="{{$visitIn->VisitOut()->first()->date}}" readonly value="{{Carbon\Carbon::create($visitIn->VisitOut()->first()->date)->toFormattedDateString()}}">  
                            </div>
                            @else 
                            <div class="form-group col-2">
                                <label class="control-label">تاريخ الخروج</label>
                                <input type="text" class="form-control end pointer" visitInid="{{$visitIn->ID}}"  readonly >  
                            </div>
                            @endif
                            <div class="form-group col-1">
                                <button class="btn btn-primary edit-date"  style="margin-top:32px;width:100%;">تعديل</button>
                                <button class="btn btn-success update-date" visitInid="{{$visitIn->ID}}"  style="margin-top:32px;width:100%;display:none">تحديث</button>
                            </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- card-footer-->
                <div class="card-footer">
                  <i class="fas fa-money-bill-alt"></i>
                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card  search -->

              <!-- If He Has Morafeks==================================================================== -->
              @if(count($Morafeks)>0)
              <!-- card-2 result -->
              <div class="card">
                <!-- card-header -->
                <div class="card-header">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  <div class="card-tools" dir="rtl">
                    <h3 class="card-title "><i class="fas fa-users"></i> / المرافقين</h3>
                  </div>
                </div>
                <!-- /.card-header -->
                <!-- card-body -->
                <div class="card-body">
                  <div class='container'>
                        @foreach($Morafeks as $Morafek)
                          <div class="row" dir="rtl" style="text-align: right;">
                            <div class="form-group col-2">
                                <label class="control-label">التسلسل</label> 
                                <input type="text" class="form-control" morafekId="{{$Morafek->ID}}" value="{{$Morafek->ID}}" readonly>
                    	      </div>
                            <div class="form-group col-2">
                                <label class="control-label">الاسم</label> 
                                <input type="text" class="form-control pointer type" morafekId="{{$Morafek->ID}}"  visitInid="{{$visitIn->ID}}" value="{{$Morafek->name}}" readonly>
                    	      </div>
                            <div class="form-group col-2">
                                <label class="control-label">رصيد</label>
                                <div class="input-group">
                                    <input type="text" class="form-control pointer morafekmoney{{$Morafek->ID}} morafekbalance"  readonly morafekId="{{$Morafek->ID}}"   value="{{$Morafek->myCash}}" >
                                    <div class="input-group-prepend">
                                      <span class="input-group-text gp" ><i class="fas fa-money-bill-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label class="control-label">تاريخ الدخول</label>
                                <div class='MStart{{$Morafek->ID}}'>
                                  <input type="text" class="form-control Morafekstart{{$Morafek->ID}} pointer" morafekId="{{$Morafek->ID}}" data="{{$Morafek->date}}"readonly  value="{{Carbon\Carbon::create($Morafek->date)->toFormattedDateString()}}">  
                                </div>
                            </div>
                            @if($Morafek->dayOut!=NULL)
                            <div class="form-group col-2">
                                <label class="control-label">تاريخ الخروج</label>
                                <div class='MEnd{{$Morafek->ID}}'>
                                <input type="text" class="form-control Morafekend{{$Morafek->ID}} pointer" morafekId="{{$Morafek->ID}}" data="{{$Morafek->dayOut}}" readonly value="{{Carbon\Carbon::create($Morafek->dayOut)->toFormattedDateString()}}">  
                                </div>
                            </div>
                            @else 
                            <div class="form-group col-2">
                                <div class='MEnd{{$Morafek->ID}}'>
                                <label class="control-label">تاريخ الخروج</label>
                                <input type="text" class="form-control Morafekend{{$Morafek->ID}} pointer" morafekId="{{$Morafek->ID}}"  readonly >  
                                </div>
                            </div>
                            @endif
                            <div class="form-group col-1">
                                <button class="btn btn-primary edit-info e{{$Morafek->ID}}" morafekId="{{$Morafek->ID}}" style="margin-top:32px;width:100%;">تعديل</button>
                                <button class="btn btn-success update-info u{{$Morafek->ID}}"  morafekId="{{$Morafek->ID}}" style="margin-top:32px;width:100%;display:none">تحديث</button>
                            </div>
                            <div class="form-group col-1">
                                <button class="btn btn-danger delete-info d{{$Morafek->ID}}" morafekId="{{$Morafek->ID}}" style="margin-top:32px;width:100%">حذف</button>
                                <button class="btn btn-info reverse r{{$Morafek->ID}}" morafekId="{{$Morafek->ID}}" style="margin-top:32px;width:100%;display:none">تراجع</button>
                            </div>
                          </div>
                        @endforeach
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- card-footer-->
                <div class="card-footer" dir="rtl">
                <i class="fas fa-notes-medical"></i>
                 خدمات طبية
                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card-2 result -->
              <!-- If He Has Morafeks==================================================================== -->
              @endif
          </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('css/daterangepicker.min.css')}}" />
<link rel="stylesheet"  href="{{asset('css/sweetalert2.min.css')}}">
@endsection
@section('script')
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/daterangepicker.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('js/walletdetails.js')}}"></script>
@endsection