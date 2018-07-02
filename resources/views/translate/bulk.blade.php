@extends('layouts.app')
@section('content')
@include('layouts.assets.noTextHeaderStandart')
<div class="pt-4">
   <div class="content">
   	<translations :artworks="{{ $artworks }}"></translations>
   </div>
</div>
@endsection
