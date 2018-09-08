@extends('layouts.plain')
@section('content')
<div class="pt-6">
   <div class="content py-4">
   	<gallery-plain :contest="{{$contest}}">
   	</gallery-plain>
   </div>
</div>
@endsection
