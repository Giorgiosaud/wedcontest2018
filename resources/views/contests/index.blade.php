@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url('/images/defaultBg.jpg')">
	<div class="text-5xl" data-depth="0.6">@lang('contests.list')</div>
</div>

<div class="py-4 d-flex flex-wrap">
	@include ('contests._list')
</div>

@endsection

