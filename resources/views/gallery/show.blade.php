@extends('layouts.app')
@section('content')
@include('layouts.assets.noTextHeaderStandart')
<div class="pt-6">
   <div class="content py-4">
   	<gallery :contest="{{$contest}}">
   		
   	</gallery>
   </div>
</div>
@endsection
