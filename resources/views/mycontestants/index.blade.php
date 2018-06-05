@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="container">
	<div class="row">
	<contestants-list :contestants="{{$contestants}}"></contestants-list>
</div>
<div class="row">
	<a class="btn btn-wedcontest is-green w-full" href="{{route('contestant.create')}}">@lang('contestants.addNew')</a>
	</div>
</div>
	@endsection    