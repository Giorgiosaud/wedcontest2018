

@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url'),'logo'=>$logo])
        @endcomponent
    @endslot

    {{-- Body --}}
    # One more step

    We just need you to confirm your email address to prove that you're a human.
    You get it, right? Cool.
@component('mail::button',  ['url' => url('/register/confirm?token=' . $user->confirmation_token)])
Please confirm your email
@endcomponent

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