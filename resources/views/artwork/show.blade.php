@extends('layouts.app')
@section('content')
@include('layouts.assets.noTextHeaderStandart')
<div class="pt-4">
	<div class="container">
		<div class="row">
			<div class="col text-center child-name">
				<p class="text-big">{{$contestant->name}} {{$contestant->last_name}}, {{ Carbon\Carbon::parse($contestant->dob)->diffInYears($contest->year) }} @lang('lang.yearsOld'), @lang('lang.from') {{ $contestant->representant->countryData->name}} <img src="{{$contestant->representant->flag}}" alt="{{$contestant->representant->country}}"></p>
			</div>
		</div>
		<hr>

		<div class="row">
			<div class="col text-center pb-4">
				<h1 class="text-muted">{{$artwork->title}}</h1>
				<h2 >{!!$artwork->description!!}</h2>
			</div>
		</div>
		<div class="row">
			<div class="col text-center py-4">
				<img src="/storage/{{($artwork->url)}}" class="img-fluid">
			</div>
		</div>


		@if($artwork->state==='reviewing')
		<hr>
		<div class="row">
			<div class="container py-4">
				<a href="{{ $artwork->pathApprove }}" class="btn btn-wedcontest">@lang('lang.approve')</a>
				<a href="{{ $artwork->pathEdit }}" class="btn btn-wedcontest">@lang('lang.edit')</a>

			</div>
		</div>
		@endif
	@if(App::getLocale()=="es")
	<a href="http://wedcontest2018.diproinduca.com/es/ganadores-2018/" class="btn btn-wedcontest py-3">Regresar a Ganadores 2018</a>
	@else
	<a href="http://wedcontest2018.diproinduca.com/winners-2018/" class="btn btn-wedcontest py-3">Go back to Winners 2018</a>
	@endif
		<div class="fb-comments" data-numposts="50" data-width="100%" data-href="{{route('gallery.show',$contest->slug)}}#{{$artwork->id}}"></div>
	</div>
</div>
@endsection
