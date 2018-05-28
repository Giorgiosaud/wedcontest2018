@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url({{$contest->background_image}})">
    <div class="mb-4">Drawing Contest {{$contest->topic}}</div>
    <div class="mb-4">{!! $contest->description !!}</div>
</div>
<div class="pt-6">
   <div class="content">
   <contestant-registration-form :categories="{{$categories}}"></contestant-registration-form>
   </div>
</div>
@endsection
