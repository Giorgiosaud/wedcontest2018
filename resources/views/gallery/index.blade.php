@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light gallery-bg" >
	<div class="container text-center">
        <img src="/storage/{{$contest->logo_image}}" width="300" alt="Reinventando el Plástico">
        <h1 class="text-light">@lang('lang.wedGallery')</h1>
    </div>
</div>
<div class="pt-6">
   <div class="content py-4">
   	<gallery :contest="{{$contest}}">
   		
   	</gallery>
   </div>
</div>
@endsection
