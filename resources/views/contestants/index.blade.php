@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="container py-4">
	<div class="row py-4">
		<h1>@lang('contestants.contestants')</h1>
	</div>
	<div class="row">
		{{-- <registered-users> --}}
			
		{{-- </registered-users> --}}
	</div>
	<div class="row">
		{{-- <a class="btn btn-wedcontest is-green w-full" href="{{route('user.create')}}">@lang('contestants.addNew')</a> --}}
	</div>
</div>
@endsection    