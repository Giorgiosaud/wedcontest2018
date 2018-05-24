@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url({{$contest->intro_image}})">
    <div class="container text-center">
        <img src="images/plastico.jpg" width="200" alt="Reinventando el Plástico">
        <div class="separator-wedcontest"></div>
        <h1>@lang('contests.login_button')</h1>
        <p>@lang('registration.contestname')</p>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
                <div class="card-body">
                <login></login>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
