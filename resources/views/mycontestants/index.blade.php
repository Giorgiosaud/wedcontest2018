@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="container py-4">
	<div class="row">
		<h1>@lang('contestants.contestants')</h1>
	<contestants-list :contestants="{{$contestants}}"></contestants-list>
</div>
<div class="row">
	<a class="btn btn-wedcontest is-green w-full" href="{{route('contestant.create')}}">@lang('contestants.addNew')</a>
	</div>
</div>
	@endsection    