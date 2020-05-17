@extends('layouts.print')
@section('title')
فاتورة {{$action}}
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-2 ">
        </div>
        <div class="col-2 ">
        </div>
        <div class="col-4 invoice invoice-head">
            <img src="{{asset('img/logo_.png')}}">
        </div>
        <div class="col-2 ">
          
        </div>
        <div class="col-2 ">
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            
        </div>
        <div class="col-2">
           
        </div>
        <div class="col-4 invoice invoice-body" dir='rtl'>
        <label class='text'>رقم الفاتورة</label>
            <input class='text input number' type="text" readonly value="{{$walletDetail->ID}}" > 
        </div>
        <div class='col-2'></div>
        <div class='col-2'></div>
    </div>
    <div class="row" >
        <div class="col-2">
          
        </div>
        <div class="col-2">
        </div>
        <div class="col-4 invoice invoice-body" dir='rtl'>
             <label class='text'>الخدمة</label>
            <input class='text input name' type="text" readonly value="{{$walletDetail->service->name}}"> 
        </div>
        <div class='col-2'></div>
        <div class='col-2'></div>
    </div>
    <div class="row" >
        <div class="col-2">
          
        </div>
        <div class="col-2">
        </div>
        <div class="col-4 invoice invoice-body" dir='rtl'>
             <label class='text'>{{$action}}</label>
            <input class='text input name' type="text" readonly value="{{$patientn}}"> 
        </div>
        <div class='col-2'></div>
        <div class='col-2'></div>
    </div>
    <div class="row text-align" >
        <div class="col-2">
        </div>
        <div class="col-2">
        </div>
        <div class="col-4 invoice invoice-body" dir='rtl'>
            <label class='text'>المبلغ</label>
           <div class="input-group money">
                <input type="text" class="form-control text input text-align " value="{{$newMount}} جنيه مصري" readonly>
                <div class="input-group-prepend">
                <span class="input-group-text gp" ><i class="fas fa-money-bill-alt"></i></span>
                </div>
            </div>
        </div>
        <div class='col-2'></div>
        <div class='col-2'></div>
    </div>
    
     <div class="row text-align" >
        <div class="col-2">
        </div>
        <div class="col-2">
        </div>
        <div class="col-4 invoice invoice-footer" dir='rtl'>
            <label class='text'>توقيع </label>
            <textarea class='text input' readonly></textarea>
        </div>
        <div class='col-2'></div>
        <div class='col-2'></div>
    </div><br>
    <div class="row">
        <div class="col-2 ">
        </div>
        <div class="col-2 ">
        </div>
        <div class="col-4 ">
            <button class='col-12 btn btn-success print'>طباعة</button>
        </div>
        <div class="col-2 ">
          
        </div>
        <div class="col-2 ">
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('js/printThis.js')}}"></script>
<script src="{{asset('js/print.js')}}"></script>
@endsection
