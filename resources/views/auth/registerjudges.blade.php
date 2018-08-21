@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url({{$contest->background_image}});    background-attachment: fixed;">
	<div class="container text-center">
        <img src="/storage/{{$contest->logo_image}}" width="300" alt="Reinventando el Plástico">
        <h2 class="cabecera text-light">@lang('lang.registerJudges')</h2>
    </div>
</div>
<div class="container my-4">
    <judges-registration-form  post-to="{{ route('registerjudge') }}"></judges-registration-form>
</div>
@endsection
