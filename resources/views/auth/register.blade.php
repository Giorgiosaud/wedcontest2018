@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url({{$contest->background_image}})">
	<div class="container text-center">
        <img src="/storage/{{$contest->logo_image}}" width="200" alt="Reinventando el Plástico">
        <div class="separator-wedcontest"></div>
        <h1>@lang('registration.register')</h1>
        <p>@lang('registration.contestname')</p>
    </div>
</div>
@if ($errors)
@foreach($errors as $error)
{{$error->first}}
@endforeach
@endif
<div class="container my-4">
    <representant-registration-form></representant-registration-form>
</div>
@endsection
