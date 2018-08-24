@extends('layouts.app')
@section('content')
<div class="d-flex flex-column h-mid align-items-center justify-content-center text-light" style="background-image:url({{$contest->background_image}});    background-attachment: fixed;">
	<div class="container text-center">
        <img src="/storage/{{$contest->logo_image}}" width="300" alt="Reinventando el Plástico">
        <h2 class="cabecera text-light">@lang('lang.evaluation')</h2>
    </div>
</div>
<div class="container ">
	<h1 class="text-dark">{{$category->name}}</h1>
	<div class="row">
		

	</div>
	@foreach($artworks as $artwork)

	<div class="row">

		<div class="col">
			{{$artwork->id}}
			<img src="http://contest.diproinduca.com/storage/{{$artwork->url}}" alt="{{$artwork->name}}" class="img-fluid">
		</div>
		<div class="col">
			@if($artwork->answers)
			@foreach($artwork->answers as $answer)
				<h2>{{$answer->user->name}}
				{{$answer->user->last_name}} </h2>
			@foreach($answer->respuestas as $id=>$respuesta)
			@if($questions->firstWhere('id',$id))
				<h3>Question: {{$questions->firstWhere('id',$id)->name}} </h3>
				@endif
				Points: {{$respuesta}} <br>
			@endforeach
			@endforeach
			@endif
		</div>
	</div>
	@endforeach
	
</div>
@endsection