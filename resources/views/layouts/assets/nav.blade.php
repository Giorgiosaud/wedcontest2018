<nav class="navbar navbar-expand-md navbar-dark bg-wedcontest fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/images/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="@lang('topic_link')">
                    @lang('topic')
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="LearningCenterDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Learning Center</a>
                <div class="dropdown-menu" aria-labelledby="LearningCenterDD">
                    <a href="@lang('categories_link')"" class="dropdown-item">
                        @lang('categories')
                    </a>
                    <a href="@lang('articles_link')" class="dropdown-item">
                        @lang('articles')
                    </a>
                    <a href="@lang('link_links')" class="dropdown-item">
                        @lang('links')
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="aboutTheContestDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('about')</a>
                <div class="dropdown-menu" aria-labelledby="aboutTheContestDD">
                    <a href="@lang('history_link')" class="dropdown-item"> 
                        @lang('history')
                    </a>
                    <a href="@lang('rules_link')" class="dropdown-item">
                        @lang('rules')
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
                    {{ auth()->user()->name }} {{ auth()->user()->last_name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('contestants.index')}}">My Participants</a>
                    <a class="dropdown-item" href="{{ route('contestant.create') }}" class="link">Add Participant</a>
                    <div class="dropdown-divider"></div>
                    
                    @if(auth()->user()->isAdmin())
                    <a class="dropdown-item" href="{{ route('contest.create') }}" class="link">Add Contest</a>
                    <div class="dropdown-divider"></div>
                    @endif
                    <logout-button route="{{ route('logout') }}" class="dropdown-item">Logout</logout-button>

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
</div>
</nav>