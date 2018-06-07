@extends('layouts.app')
@section('content')
@include('layouts.assets.headerStandart')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
                <div class="card-body">
                <login reset-link="{{ route('password.request') }}"></login>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
