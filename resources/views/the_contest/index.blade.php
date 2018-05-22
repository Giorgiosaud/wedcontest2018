@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-100vh align-items-center justify-content-center text-light" style="background-image:url({{$contest->intro_image}})">
    <div class="text-2xl" data-depth="0.6">Drawing Contest {{$contest->year}}</div>
    <div class="text-5xl mb-4" data-depth="0.2">{{ $contest->topic }}</div>
    <div class="d-flex flex-column">
        @if (auth()->check())
        @if(auth()->user()->confirmed)
        <a class="btn btn-wedcontest is-green w-full" href="{{route('contestant.create')}}">Add New Participant</a>

        @else
        <p class="border-dashed border-light p-3">@lang('contests.confirm_email')</p>
        @endif
        @else
        <a class="btn btn-primary btn-wedcontest mb-2" href="{{route("login")}}">@lang('contests.login_button')</a>
        <a class="btn btn-primary btn-wedcontest" href="{{route("register")}}" >@lang('contests.register_button')</a>
        @endif
    </div>

</div>
@endsection