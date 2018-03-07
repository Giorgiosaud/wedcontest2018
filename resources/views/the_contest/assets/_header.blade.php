@section('intro')
    <div id="IntroSection" style="background-image:url('{{$contest->intro_image}}')"
         class="flex-col flex font-serif h-screen items-center justify-center text-white bg-cover"
    >
        <div class="font-hairline text-5xl" data-depth="0.2">{{$contest->year}} World Enviroment Day</div>
        <div class="font-hairline text-3xl" data-depth="0.6">Drawing Contest</div>
    </div>
@endsection