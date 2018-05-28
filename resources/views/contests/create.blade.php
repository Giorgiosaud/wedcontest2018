@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url('/images/defaultBg.jpg')">
	<div class="text-5xl" data-depth="0.6">@lang('contests.new_contest')</div>
</div>
<div class="container py-4">
	<article>
		@include('contests.assets.form')
	</article>
</div>
@endsection    