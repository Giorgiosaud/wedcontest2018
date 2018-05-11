@extends('layouts.app')

@section('content')
<div class="pt-6">
    <contestants-list :contestants="{{$contestants}}"></contestant-registration-form>
    </div>
    <div class="pt-6">
        <a class="btn btn-block is-green w-full" href="{{route('contestant.create')}}">@lang('registration.newParticipant')</a>
    </div>
@endsection
    