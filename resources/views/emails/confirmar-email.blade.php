@component('mail::message')
    # Un Ultimo Paso

    Solo necesitamos confirmar que tu correo no le pertenece a un Robot y que los recibes bien.
    ¿Nos entiendes cierto? , Cool.
@component('mail::button',  ['url' => url('/register/confirm?token=' . $user->confirmation_token)])
Confirma tu Correo
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
