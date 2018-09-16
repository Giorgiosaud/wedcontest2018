<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base target="_parent">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="fb:app_id" content="235445060630804" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Styles -->
    <link href="//fonts.googleapis.com/css?family=Nixie+One|PT+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">



    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            'roles' => Auth::check()?Auth::user()->roles->pluck('name'):null,
            'locale'=> LaravelLocalization::getCurrentLocale()
            ]) !!};
        </script>

        <style>
        body{
            background: #fff;
        }
    </style>

    <script src='https://www.google.com/recaptcha/api.js'></script>

    @yield('head')
</head>

<body>
    <div id="fb-root"></div>
    <div id="app">
        @yield('content')
        <flash message="{{ session('flash') }}"></flash>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    <script>
         window.addEventListener("message", receiveMessage, false);
         var parentMessageEvent;

         function receiveMessage(event) {
             if (event.origin.indexOf('diproinduca')===-1) {
               return;
           }
           var object = JSON.parse(event.data);
           parentMessageEvent = event;
           sendResizeToParentWindow();
       }
       function sendResizeToParentWindow() {
         if (parentMessageEvent != undefined) {
            parentMessageEvent.source.postMessage(JSON.stringify({
             event: 'resize',
             height: $('.artworks .row').eq(0).height()
         }), parentMessageEvent.origin);
        }
    };
</script>
</body>
</html>
