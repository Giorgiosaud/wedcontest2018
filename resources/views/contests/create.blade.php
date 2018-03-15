@extends('layouts.app')

@section('content')

<article>
    <div class="pt-4 pb-4">
        <h2>@lang('contests.new_contest')</h2>
    </div>
    @include('contests.assets.form')
</article>

@endsection
