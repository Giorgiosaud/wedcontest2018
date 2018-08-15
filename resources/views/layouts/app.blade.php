<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="fb:app_id" content="235445060630804" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Styles -->
    <link href="//fonts.googleapis.com/css?family=Nixie+One|PT+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">



    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <!-- Scripts -->
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            'locale'=> LaravelLocalization::getCurrentLocale()
            ]) !!};
        </script>

        <script src='https://www.google.com/recaptcha/api.js'></script>

        @yield('head')
    </head>

    <body>
        <div id="fb-root"></div>
        <div id="app">
            @include ('layouts.assets.nav')
            @yield('content')
            <flash message="{{ session('flash') }}"></flash>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
        <footer class="py-2 bg-dark">
            <div class="row">
                <div class="container text-center text-light">
                    <small>Copyright ® <a href="http://wedcontest2018.diproinduca.com/" style="color:inherit">Diproinduca</a>  |  All Rights Reserved</small>
                </div>
            </div>
        </footer>
    </body>
    </html>