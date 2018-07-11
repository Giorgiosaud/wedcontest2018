@extends('layouts.app')
@section('content')
@include('layouts.assets.noTextHeaderStandart')
<div class="pt-6">
   <div class="content">
   <artwork-upload-form :contestant="{{$contestant}}"
   ></artwork-upload-form>
   </div>
</div>
@endsection
