@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="container">
    <contestants-list :contestants="{{$contestants}}"></contestant-registration-form>
    </div>
@endsection    