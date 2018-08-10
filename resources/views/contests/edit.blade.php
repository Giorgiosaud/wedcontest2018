@extends('layouts.app')

@section('content')

<article>
    <div class="pt-4 pb-4">
        <h2>Editar</h2>
    </div>
    <contest-edit :contest="{{$contest}}" />
</article>

@endsection