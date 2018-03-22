@extends('layouts.app')

@section('content')

    <article>
        <div class="flex items-center justify-left">
            <h2>{{$contest->topic}}</h2>
            <div class="flex items-center justify-end flex-1 mt-4 px-4 text-xs">
                <div class="bg-blue-lighter hover:bg-blue-light text-white font-light mr-2 py-2 px-4 rounded-full">
                    {{$contest->year}}
                </div>
                @if($contest->active)
                    <div class="bg-blue hover:bg-blue-dark text-white font-light py-2 px-4 rounded-full">
                        Active
                    </div>
                @else
                    <div class="bg-red hover:bg-red-dark text-white font-bold py-2 px-4 rounded-full">
                        Inactive
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-4">
            {!!$contest->description!!}
        </div>


    </article>
    <ul>
        @foreach($contest->categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center">{{$category->name}}
                <span class="badge badge-primary badge-pill">
                                {{$category->max_age}}
                            </span>
            </li>
        @endforeach
    </ul>

@endsection
