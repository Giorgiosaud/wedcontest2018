@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{$contest->topic}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <article>
                            <h4>{{$contest->year}}</h4>
                            <div class="description">{{$contest->description}}</div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="list-group">
                    @foreach($contest->categories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">{{$category->name}}
                            <span class="badge badge-primary badge-pill">
                                {{$category->max_age}}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
