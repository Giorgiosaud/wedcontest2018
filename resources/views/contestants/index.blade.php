@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url({{$contest->intro_image}})">
    <div class="text-2xl" data-depth="0.6">Drawing Contest {{$contest->year}}</div>
    <div class="text-5xl mb-4" data-depth="0.2">{{ $contest->topic }}</div>
    <a class="btn btn-wedcontest" href="{{route('contestant.create')}}">@lang('registration.newParticipant')</a>
</div>
<div class="container">
    <contestants-list :contestants="{{$contestants}}"></contestant-registration-form>
    </div>
@endsection    