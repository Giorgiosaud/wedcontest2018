@extends('layouts.plain')
@section('content')
<style>
	body{
		background: #fff;
	}
</style>
<div class="pt-6">
   <div class="content py-4">
   	<gallery-plain :contest="{{$contest}}">
   	</gallery-plain>
   </div>
</div>
@endsection
