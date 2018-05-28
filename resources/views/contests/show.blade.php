@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-100vh align-items-center justify-content-center text-light" style="background-image:url({{$contest->background_image}})">
    <div class="mb-4" data-depth="0.6">Drawing Contest {{$contest->topic}}</div>
    <div class="mb-4" data-depth="0.2">{!! $contest->description !!}</div>
</div>

<article class="container">
    <div class="d-flex align-items-center justify-left py-4">
        <h2>{{$contest->topic}}</h2>
        <div class="d-flex align-items-center ml-auto justify-center">
            <a href="{{route('contest.edit',$contest->slug)}}">
                <div class="badge badge-pill badge-warning mx-1">
                    @lang('contests.edit')
                </div>
            </a>
            
            <div class="badge badge-pill badge-primary mx-1">
                {{$contest->year}}
            </div>
            
            @if($contest->active)
            <div class="badge badge-pill badge-primary mx-1">
                Active
            </div>
            @else
            <div class="badge badge-pill badge-warning mx-1">
                Inactive
            </div>
            @endif
        </div>
    </div>
    
    <div class="py-4">
        {!!$contest->description!!}
    </div>
    
    
<ul class="list-group">
    @foreach($contest->categories as $category)
    <li class="list-group-item">{{$category->name}}
        <span class="badge badge-primary badge-pill">
            Max Age {{$category->max_age}}
        </span>
    </li>
    @endforeach
</ul>
</article>


@endsection
