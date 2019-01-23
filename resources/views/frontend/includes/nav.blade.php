<nav class="navbar navbar-expand-lg navbar-light bg-navbar">
    <a href="{{ route('frontend.index') }}" class="navbar-brand">
        <img class="navbar-brand-full" src="{{ asset('img/frontend/hazater.logo.mini.png') }}" alt="HazaTér">
        {{-- {{ app_name() }} --}}
    </a>
    <img class="navbar-brand-full" src="{{ asset('img/frontend/EU_zaszlo_CMYK.mini.png') }}">

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ml-auto">
                <li class="nav-item"><a href="{{route('frontend.search')}}" class="nav-link nav-main">@lang('navs.frontend.search-driver')</a></li>
                {{-- <li class="nav-item"><a href="{{route('frontend.user.advertise.add')}}" class="nav-link nav-main">@lang('navs.frontend.route-upload')</a></li> --}}
                <li class="nav-item"><a href="{{route('frontend.user.driver.menu')}}" class="nav-link nav-main">@lang('navs.frontend.driver-menu')</a></li>
                <li class="nav-item"><a href="{{route('frontend.user.passanger.menu')}}" class="nav-link nav-main">@lang('navs.frontend.passanger-menu')</a></li>
                <li class="nav-item"><a href="{{route('frontend.howitworks')}}" class="nav-link nav-main">@lang('navs.frontend.how-it-works')</a></li>
                <li class="nav-item"><a href="{{route('frontend.contact')}}" class="nav-link nav-main">@lang('navs.frontend.contact')</a></li>
                <li class="nav-item"><a href="{{route('frontend.terms')}}" class="nav-link nav-main">@lang('navs.frontend.terms')</a></li>
            </ul>

            <ul class="navbar-nav">
                {{-- teszt --}}
            {{-- @if(config('locale.status') && count(config('locale.languages')) > 1)
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">@lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</a>

                    @include('includes.partials.lang')
                </li>
            @endif --}}

            @auth
                {{-- <li class="nav-item"><a href="{{route('frontend.user.dashboard')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}">@lang('navs.frontend.dashboard')</a></li> --}}
            @endauth

            @guest
                @if(config('access.registration'))
                    <li class="nav-item"><a href="{{route('frontend.auth.register')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.register')) }}">@lang('navs.frontend.register')</a></li>
                @endif

                <li class="nav-item"><a href="{{route('frontend.auth.login')}}" class="btn btn-outline-info {{ active_class(Active::checkRoute('frontend.auth.login')) }}">@lang('navs.frontend.login')</a></li>
            @else
                <li class="nav-item dropdown">

                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                       <img src="{{ $logged_in_user->picture }}" class="img-avatar" alt="{{ $logged_in_user->email }}">
                       <span class="d-md-down-none">{{ $logged_in_user->name }}</span>
                    </a>

                    <div class="dropdown-menu user-menu" aria-labelledby="navbarDropdownMenuUser">
                        @can('view backend')
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item"><i class="fa fa-home"></i> @lang('navs.frontend.user.administration')</a>
                        @endcan

                        <a href="{{ route('frontend.user.driver.menu') }}" class="dropdown-item"><i class="fa fa-car"></i> @lang('navs.frontend.user.menu.driver')</a>
                        <a href="{{ route('frontend.user.passanger.menu') }}" class="dropdown-item"><i class="fa fa-suitcase"></i> @lang('navs.frontend.user.menu.passanger')</a>
                        <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Active::checkRoute('frontend.user.account')) }}"><i class="fa fa-user"></i> @lang('navs.frontend.user.account')</a>
                        <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item"><i class="fas fa-lock"></i> @lang('navs.general.logout')</a>
                    </div>
                </li>
            @endguest

            {{-- <li class="nav-item"><a href="{{route('frontend.contact')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.contact')) }}">@lang('navs.frontend.contact')</a></li> --}}
        </ul>
    </div>
</nav>
