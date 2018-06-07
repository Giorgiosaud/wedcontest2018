@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-100vh align-items-center justify-content-center text-light" style="background-image:url({{$contest->background_image}})">
    <div class="container text-center my-4">
        <img src="/storage/{{$contest->logo_image}}" alt="{{$contest->topic}}" style="max-width:300px">
        @if (auth()->check())
            @if(auth()->user()->confirmed)
                <h1 class="my-4">@lang('navbar.header_confirmed')</h1>
            @else
                <h1 class="my-4">@lang('navbar.unconfirmed_1')</br>@lang('navbar.unconfirmed_2')</h1>  
            @endif            
        @else
            <h1 class="my-4">@lang('navbar.header')</h1>
        @endif
        

    </div>
    <div class="d-flex justify-content-center">

        @if (auth()->check())
        @if(auth()->user()->confirmed)
        <a class="btn btn-wedcontest is-green w-full" href="{{route('contestant.create')}}">@lang('contestants.addNew')</a>

        @else
        <p class="border-dashed border-light p-3">@lang('contests.confirm_email')</p>
        @endif
        @else
        <a class="btn btn-primary btn-wedcontest mr-4" href="{{route("login")}}">@lang('contests.login_button')</a>
        <a class="btn btn-primary btn-wedcontest mr-4" href="{{route("register")}}" >@lang('contests.register_button')</a>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        <a class="btn btn-wedcontest-2 mt-4" href="@lang('contests.faqlink')">@lang('contests.FAQ')</a>
    </div>

</div>
@endsection