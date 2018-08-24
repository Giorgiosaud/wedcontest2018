@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url({{$contest->background_image}});    background-attachment: fixed;">
	<div class="container text-center">
        <img src="/storage/{{$contest->logo_image}}" width="300" alt="Reinventando el Plástico">
        <h2 class="cabecera text-light">@lang('lang.evaluation')</h2>
    </div>
</div>
@foreach($contest->categories as $category)
<div class="container ">
	<div class="col-4 mx-auto my-4">
		<a class="btn btn-wedcontest btn-block" href="{{route('admin.evaluation.show',[$contest->slug,$category->id])}}">{{$category->name}}</a>
	</div>
</div>
@endforeach
@endsection