@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="pt-6">
   <div class="content">
   <contestant-registration-form :categories="{{$categories}}"></contestant-registration-form>
   </div>
</div>
@endsection
