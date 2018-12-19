<div class="row">
    <ul class="nav nav-tabs" id="main-menu">
        <li class="nav-item"><a class="nav-link {{ $main_menu==1 ? 'active' : '' }}" href="{{ route('frontend.datasets.advertise.create') }}">{{ __('dashboard.driver-menu') }}</a></li>
        <li class="nav-item"><a class="nav-link {{ $main_menu==2 ? 'active' : '' }}" href="#passenger">{{ __('dashboard.passenger-menu') }}</a></li>
        <li class="nav-item"><a class="nav-link {{ $main_menu==3 ? 'active' : '' }}" href="{{ route('frontend.user.account') }}">{{ __('dashboard.profile-menu') }}</a></li>
        {{-- <li class="nav-item"><a class="nav-link {{ $main_menu==4 ? 'active' : '' }}" href="{{ route('frontend.datasets.message.index') }}">{{ __('dashboard.messages-menu') }}</a></li> --}}
    </ul>
</div><!--row-->

<div class="row mb-4">
    <div class="tab-content" id="main-menu-content">
        <div id="driver" class="tab-pane fade {{ $main_menu==1 ? 'active show' : '' }}">
            <ul class="nav nav-pills nav-pills-underline" id="driver-menu">
                <li class="nav-item"><a data-toggle="tab" class="nav-link {{ $sub_menu==1 ? 'active' : '' }}" href="#driver-menu1">{{ __("dashboard.driver.submit-ad.Title") }}</a></li>
                <li class="nav-item"><a data-toggle="tab" class="nav-link {{ $sub_menu==2 ? 'active' : '' }}" href="#driver-menu2">{{ __("dashboard.driver.advertises.Title") }}</a></li>
                <li class="nav-item"><a data-toggle="tab" class="nav-link {{ $sub_menu==3 ? 'active' : '' }}" href="#driver-menu3">{{ __("dashboard.driver.passengers.Title") }}</a></li>
                <li class="nav-item"><a data-toggle="tab" class="nav-link {{ $sub_menu==4 ? 'active' : '' }}" href="#driver-menu4">{{ __("dashboard.driver.cars.Title") }}</a></li>
            </ul>
        </div>
        <div id="passenger" class="tab-pane fade {{ $main_menu==2 ? 'active show' : '' }}">
            <ul class="nav nav-pills nav-pills-underline" id="passenger-menu">
                <li class="nav-item"><a data-toggle="tab" class="nav-link {{ $sub_menu==1 ? 'active' : '' }}" href="#passanger-menu1">{{ __("dashboard.passenger.Reservation") }}</a></li>
                <li class="nav-item"><a data-toggle="tab" class="nav-link {{ $sub_menu==2 ? 'active' : '' }}" href="#passanger-menu2">{{ __("dashboard.passenger.Ad Monitor") }}</a></li>
            </ul>
        </div>
        <div id="profile" class="tab-pane fade {{ $main_menu==3 ? 'active show' : '' }}">
            {{-- <ul class="nav nav-pills nav-pills-underline" id="profile-menu">
                <li class="nav-item"><a data-toggle="tab" class="nav-link {{ $sub_menu==1 ? 'active' : '' }}" href="#profile-menu1">{{ __("dashboard.profile.datas.Title") }}</a></li>
                <li class="nav-item"><a data-toggle="tab" class="nav-link {{ $sub_menu==2 ? 'active' : '' }}" href="#profile-menu2">{{ __("dashboard.profile.settings.Title") }}</a></li>
            </ul> --}}
        </div>
        {{-- <div id="messages" class="tab-pane fade {{ $main_menu==4 ? 'active show' : '' }}"> --}}
            {{-- @include('frontend.user.dashboard.tabs.messages-menu') --}}
        {{-- </div> --}}
    </div>
</div><!--row-->
