<nav class="navbar navbar-expand-md navbar-dark bg-wedcontest fixed-top">
    <a class="navbar-brand" href="/">
        <img src="/images/logo.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="http://wedcontest2018.diproinduca.com/en/">
                Tema 2018
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="LearningCenterDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Learning Center</a>
            <div class="dropdown-menu" aria-labelledby="LearningCenterDD">
                <a href="http://wedcontest2018.diproinduca.com/en/centro-de-aprendizaje/#Categories" class="dropdown-item">
                    Categorias
                </a>
                <a href="http://wedcontest2018.diproinduca.com/en/centro-de-aprendizaje/#Articles" class="dropdown-item">
                    Artículos
                </a>
                <a href="http://wedcontest2018.diproinduca.com/en/centro-de-aprendizaje/#Links" class="dropdown-item">
                    Enlaces
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="aboutTheContestDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About The Contest</a>
            <div class="dropdown-menu" aria-labelledby="aboutTheContestDD">
                <a href="http://wedcontest2018.diproinduca.com/en/inicio/" class="dropdown-item"> 
                    History
                </a>
                <a href="http://wedcontest2018.diproinduca.com/en/reglas-2/" class="dropdown-item">
                    Rules
                </a>
                <a href="http://wedcontest2018.diproinduca.com/en/winners/" class="dropdown-item">
                    Winners 2017
                </a>
                <a href="http://wedcontest2018.diproinduca.com/en/winners/" class="dropdown-item">
                    Judges
                </a>

            </div>
        </li>

        @if (auth()->check())
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }} {{ Auth::user()->last_name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('contestants.index')}}">My Participants</a>
                <a class="dropdown-item" href="{{ route('contestant.create') }}" class="link">Add Participant</a><logout-button route="{{ route('logout') }}" class="dropdown-item">Logout</logout-button>
            </div>
        </li>
        @endif
        <li class="nav-item d-flex align-items-center">

            <a class="n-link" href="{{route('lang.switch',[\Request::route()->getName(),app()->getLocale()])}}">
                @if(__('contests.otherLang')=="Español")
                <img src="/images/flags/ES.png" alt="@lang('contests.otherLang')">
                @else
                <img src="/images/flags/US.png" alt="@lang('contests.otherLang')">
                @endif
            </a>
        </li>
    </ul>
</div>
</nav>