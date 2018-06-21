@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="pt-6">
	<div class="content">
		@if(auth()->user()->confirmed)
		<contestant-registration-form post-to="{{ route('mycontestant.store') }}" :categories="{{$categories}}"></contestant-registration-form>
		@else
		<div class="container">
			<div class="col-6-offset-3">
				<p class="border-dashed border-light p-3">@lang('contests.confirm_email')</p>
			</div>
		</div>
		@endif

	</div>
</div>
@endsection
