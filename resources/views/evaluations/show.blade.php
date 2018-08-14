@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
@foreach($contest->categories as $category)
<div class="container ">
	<div class="col-4 mx-auto my-4">
		<a class="btn btn-wedcontest btn-block" href="{{route('evaluation.make',[$contest->slug,$category->id])}}">{{$category->name}}</a>
	</div>
</div>
@endforeach
@endsection