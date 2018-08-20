@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="container my-4">
    <judges-registration-form  post-to="{{ route('registerjudge') }}"></judges-registration-form>
</div>
@endsection
