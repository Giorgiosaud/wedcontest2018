@extends('layouts.app')
@section('content')
<div class="flex mt-4">
	<div class="w-1/4">
		<a href="/my-participants">My Participants</a>
	</div>
	<div class="w-3/4"><h1>@lang('profile.my_profile')</h1>
		@if(auth())
		<my-profile :profile="{{ auth()->user()}}"></my-profile>
		@endif
	</div>
</div>
@endsection