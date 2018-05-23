@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-100vh align-items-center justify-content-center text-light" style="background-image:url({{$contest->intro_image}})">
	<div class="text-2xl" data-depth="0.6">Drawing Contest {{$contest->year}}</div>
	<div class="text-5xl mb-4" data-depth="0.2">{{ $contest->topic }}</div>
</div>
<div class="py-4 d-flex flex-wrap">
	@include ('contests._list')
</div>

@endsection

