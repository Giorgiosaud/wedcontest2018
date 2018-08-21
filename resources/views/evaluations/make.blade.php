@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light gallery-bg" >
	<div class="container text-center">
        <h1 class="text-light">@lang('lang.wedGallery')</h1>
    </div>
</div>
<div class="pt-6">
   <div class="content py-4">
   	<div class="container"><a href="{{route('evaluation.show',$contest)}}" class="btn btn-wedcontest">@lang('lang.goBackToList')</a></div>
   	<evaluation :contest="{{$contest}}" :category="{{$category}}">
   		
   	</evaluation>
   </div>
</div>
@endsection
