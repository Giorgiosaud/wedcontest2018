@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url({{$contest->intro_image}})">
    <div class="text-2xl" data-depth="0.6">Drawing Contest {{$contest->year}}</div>
    <div class="text-5xl mb-4" data-depth="0.2">{{ $contest->topic }}</div>
</div>
<div class="pt-6">
   <div class="content">
   <contestant-registration-form :categories="{{$categories}}"></contestant-registration-form>
   </div>
</div>
@endsection
