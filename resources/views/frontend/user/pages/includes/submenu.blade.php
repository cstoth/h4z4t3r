<div class="row">
    <ul class="nav nav-tabs" id="main-menu">
        <li class="nav-item">
            <a class="nav-link {{ $main_menu==1 ? 'active' : '' }}" href="{{ route('frontend.user.driver.menu') }}">{{ __('dashboard.driver-menu') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $main_menu==2 ? 'active' : '' }}" href="{{ route('frontend.user.passanger.menu') }}">{{ __('dashboard.passenger-menu') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $main_menu==3 ? 'active' : '' }}" href="{{ route('frontend.user.account') }}">{{ __('dashboard.profile-menu') }}</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ $main_menu==4 ? 'active' : '' }}" href="{{ route('frontend.user.messages.list') }}">{{ __('dashboard.messages-menu') }}</a>
        </li> --}}
    </ul>
</div><!--row-->
