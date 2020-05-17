@if(session('success'))
<div class="alert alert-success" style="text-align: right;">
    {{session('success')}}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger" style="text-align: right;">
    {{session('error')}}

    {{session()->forget('error')}}
</div>
@endif