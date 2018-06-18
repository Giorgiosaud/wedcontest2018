@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="pt-4">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1>{{$contestant->name}} {{$contestant->last_name}} {{$contestant->age}} @lang('lang.yearsOld') From: <img src="{{$contestant->representant->flag}}" alt="{{$contestant->representant->country}}"></h1>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<img src="{{asset($artwork->url)}}" class="img-fluid">
			</div>
		</div>
		<div class="row py-4">
			<div class="col">
				<h2>{{$artwork->title}}</h2>
				{!!$artwork->description!!}
			</div>
		</div>

	</div>
</div>
@endsection
