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
        // Listen for postMessage events.
        window.addEventListener("message", receiveMessage, false);

// A variable for storing our parent message event so we can
// establish two-way communication.
var parentMessageEvent;

function receiveMessage(event) {
    // Let's make sure the sender of this message is who we think it is.
    if (event.origin !== 'http://wedcontest2018.diproinduca.com') {
      return;
  }
  var object = JSON.parse(event.data);
  appendToLog('Received postMessage.');
  appendToLog('Origin: ' + event.origin);
  appendToLog('Event: ' + object.event);
  appendToLog('Message: ' + object.message);
    // Store parent message event for two-way communication
    parentMessageEvent = event;
    sendResizeToParentWindow();
}

function appendToLog(message) {
    $('#log').append('<p>' + message + '</p>');
}

function sendResizeToParentWindow() {
    if (parentMessageEvent != undefined) {
        // Note: Chrome is fine with sending JSON objects as the message data
        // but some browsers (*glares at IE*) don't like it.  So, to make this
        // work on all browsers I am stringifying my objects and JSON.parsing them
        // on the other side.
        parentMessageEvent.source.postMessage(JSON.stringify({
          event: 'resize',
          height: $(document).height()
      }), parentMessageEvent.origin);
    }
};
</script>
</body>
</html>
