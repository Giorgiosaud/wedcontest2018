@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-100vh align-items-center justify-content-center text-light" style="background-image:url({{$contest->intro_image}})">
    <div class="container text-center">
        <img src="images/plastico.jpg" alt="Reinventando el Plástico">
        <div class="separator-wedcontest"></div>
        <h1>@lang('registration.registration')</h1>
        <h2>@lang('registration.contestname')</h2>
    </div>
    <div class="d-flex justify-content-around container">

        @if (auth()->check())
        @if(auth()->user()->confirmed)
        <a class="btn btn-wedcontest is-green w-full" href="{{route('contestant.create')}}">Add New Participant</a>

        @else
        <p class="border-dashed border-light p-3">@lang('contests.confirm_email')</p>
        @endif
        @else
        <a class="btn btn-primary btn-wedcontest" href="{{route("login")}}">@lang('contests.login_button')</a>
        <a class="btn btn-primary btn-wedcontest" href="{{route("register")}}" >@lang('contests.register_button')</a>
        @endif
    </div>
    <div class="d-flex justify-content-around container mt-4">
        <a class="btn btn-primary btn-wedcontest-2" href="#">@lang('contests.FAQ')</a>

    </div>

</div>
@endsection