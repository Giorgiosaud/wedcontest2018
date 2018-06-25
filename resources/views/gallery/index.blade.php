@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="pt-6">
   <div class="content">
   	<gallery slug="{{$contest->slug}}">
   		
   	</gallery>
   </div>
</div>
@endsection
