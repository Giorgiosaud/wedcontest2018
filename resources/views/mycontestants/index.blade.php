@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="container py-4">
	@if(auth()->user()->confirmed)
	<div class="row py-4">
		<div class="col">
			<h1>@lang('contestants.contestants')</h1>
		</div>
	</div>
	<div class="row">
		@foreach($contestants as $contestant)
		<contestant-card :contestant="{{$contestant}}" :artwork="{{ $contestant->artworks->whereIn('category_id', $cats) }}" :key="{{$contestant->id}}"></contestant-card>
		@endforeach
	</div>
	<div class="row">
		<div class="col">
			<a class="btn btn-wedcontest is-green w-full" href="{{route('mycontestant.create')}}">@lang('contestants.addNew')</a>
		</div>
	</div>
	@else
	<p class="border-dashed border-light p-3">@lang('contests.confirm_email')</p>
	@endif
</div>
@endsection