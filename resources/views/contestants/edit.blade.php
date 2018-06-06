@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="pt-6">
   <div class="content">
   <contestant-edit-form post-to="{{ route('mycontestants.update') }}" :contestant="{{ $contestant }}" :categories="{{$categories}}"></contestant-edit-form>
   </div>
</div>
@endsection
