@component('mail::message')
{{-- Greeting --}}
# @lang('reset.salutation')

{{-- Intro Lines --}}
@lang('reset.message')

{{-- Action Button --}}

@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
@lang('reset.button')
@endcomponent
@endisset

{{-- Outro Lines --}}
@lang('reset.outro')

{{-- Salutation --}}
@lang('reset.regards'),<br>WED CONTEST TEAM

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
@lang(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser: [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl
    ]
)
@endcomponent
@endisset
@endcomponent
