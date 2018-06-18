@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="pt-6">
   <div class="content">
   <artwork-edit-form :contestant="{{$contestant}}"
    :artwork="{{$artwork}}"
   ></artwork-edit-form>
   </div>
</div>
@endsection
