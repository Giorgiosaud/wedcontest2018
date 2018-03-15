@extends('layouts.app')
@section('mainImage')
{{$contest->intro_image}}
@endsection
@section('mainTitle')
{{ $contest->topic }}
@endsection


@section('content')
<div class="pt-6">
    
</div>
    @if (auth()->check())
        @if(auth()->user()->confirmed)
            <button class="btn is-green w-full" @click="$modal.show('new-thread')">Add New Thread</button>
        @else
            <p class="text-xs text-grey-dark font-bold border border-dashed border-grey-dark p-3">@lang('contests.confirm_email')</p>
        @endif
    @else
        <button class="btn is-green w-full tracking-wide" @click="$modal.show('login')">@lang('contests.login_button')</button>
        <button class="btn is-green w-full tracking-wide mt-4" @click="$modal.show('register')">@lang('contests.register_button')</button>
    @endif

    <div v-cloak>
        @include('modals.all')
    </div>
@endsection
