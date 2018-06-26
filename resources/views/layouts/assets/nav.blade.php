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
                <a class="nav-link" href="@lang('navbar.topic_link')">
                    @lang('navbar.topic')
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="LearningCenterDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('navbar.learning_center')</a>
                <div class="dropdown-menu" aria-labelledby="LearningCenterDD">
                    <a href="@lang('navbar.categories_link')" class="dropdown-item">
                        @lang('navbar.categories')
                    </a>
                    <a href="@lang('navbar.articles_link')" class="dropdown-item">
                        @lang('navbar.articles')
                    </a>
                    <a href="@lang('navbar.link_links')" class="dropdown-item">
                        @lang('navbar.links')
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="aboutTheContestDD" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('navbar.about')</a>
                <div class="dropdown-menu" aria-labelledby="aboutTheContestDD">
                    <a href="@lang('navbar.history_link')" class="dropdown-item"> 
                        @lang('navbar.history')
                    </a>
                    <a href="@lang('navbar.rules_link')" class="dropdown-item">
                        @lang('navbar.rules')
                    </a>
                    <a href="@lang('navbar.winners_link')" class="dropdown-item">
                        @lang('navbar.winners')
                    </a>
                    <a href="@lang('navbar.judges_link')" class="dropdown-item">
                        @lang('navbar.judges')
                    </a>

                </div>
            </li>
            

            @if (auth()->check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->name }} {{ auth()->user()->last_name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('mycontestants.index')}}">@lang('contestants.myParticipants')</a>
                    <a class="dropdown-item" href="{{ route('mycontestant.create') }}" class="link">@lang('contestants.addNew')</a>
                    <div class="dropdown-divider"></div>
                    
                    @if(auth()->user()->isAdmin())
                    {{-- <a class="dropdown-item" href="{{ route('contest.create') }}" class="link">Add Contest</a> --}}
                    <a class="dropdown-item" href="{{ route('users.index') }}" class="link">List Of Representants and Contestants</a>
                    <a href="{{route('gallery.index')}}" class="dropdown-item">@lang('lang.gallery')</a>
                    
                    <div class="dropdown-divider"></div>
                    @endif
                    <logout-button route="{{ route('logout') }}" class="dropdown-item">@lang('contests.logout')</logout-button>

                </div>
            </li>

            @endif
            <li class="nav-item d-flex align-items-center">

                <a class="n-link" href="{{route('lang.switch',[\Request::route()->getName(),app()->getLocale()])}}">
                    @if(__('contests.otherLang')=="Español")
                    <img src="/images/flags/ES.png" alt="@lang('navbar.contests.otherLang')">
                    @else
                    <img src="/images/flags/US.png" alt="@lang('navbar.contests.otherLang')">
                    @endif
                </a>
            </li>
        </ul>
    </div>
</div>
</nav>