@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
@endforeach
@endif
<div class="container my-4">
    <representant-registration-form  post-to="{{ route('register') }}"></representant-registration-form>
</div>
@endsection
