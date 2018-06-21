

@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url'),'logo'=>$logo])
        @endcomponent
    @endslot

    {{-- Body --}}
    - The representant {{$user->name}} {{$user->last_name}} registered an contestant
    - Representant Data
    - email: {{$user->email}}
    - telephone: {{$user->phone}}
    - from: {{$user->country}}
    - type of referral: {{$user->referred}} @if($user->referred_specify){{$user->referred_specify}}@endif 
    - preferred language {{$user->language}}
    # Datos de Concursante Registrado
    {{$contestant->name}} {{$contestant->last_name}}
    email: {{$contestant->email}}
    dob:{{$contestant->dob}}
    @if($contestant->motivo)
    motivo: {{$contestant->motivo}}
    @endif
    categoria: {{$contestant->categories->last()->name}}

Gracias,<br>
WED CONTEST TEAM

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent