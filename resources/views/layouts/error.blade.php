<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="//fonts.googleapis.com/css?family=Nixie+One|PT+Sans:400,700" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script>
        window.App = {!! 
            json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            'locale'=> LaravelLocalization::getCurrentLocale()
            ]) 
        !!};
    </script>
            
            <script src='https://www.google.com/recaptcha/api.js'></script>
            
            @yield('head')
        </head>
        
        <body class="font-sans">
            <div id="app">
                @include ('layouts.assets.nav')
                <div class="container mx-auto">
                    <div class="flex">
                        @yield('content')
                    </div>
                </div>
            </div>
            
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}"></script>
            @yield('scripts')
        </body>
        </html>
        