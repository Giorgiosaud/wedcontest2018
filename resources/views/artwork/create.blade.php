@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="pt-6">
   <div class="content">
   <artwork-upload-form 
   post-to="{{ route('mycontestant.store') }}" 
   :categories="{{$categories}}"></artwork-upload-form>
   </div>
</div>
@endsection
