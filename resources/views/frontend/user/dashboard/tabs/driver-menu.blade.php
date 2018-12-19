<div class="driver-menu">

    <ul class="nav nav-pills nav-pills-underline" id="driver-menu">
        <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#driver-menu1">{{ __("dashboard.driver.submit-ad.Title") }}</a></li>
        <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#driver-menu2">{{ __("dashboard.driver.advertises.Title") }}</a></li>
        <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#driver-menu3">{{ __("dashboard.driver.passengers.Title") }}</a></li>
        <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#driver-menu4">{{ __("dashboard.driver.cars.Title") }}</a></li>
    </ul>

    <div class="tab-content mt-3" id="driver-menu-content">
        <div id="driver-menu1" class="tab-pane fade active show">
            @include('frontend.user.dashboard.driver.submit-ad')
        </div>
        <div id="driver-menu2" class="tab-pane fade">
            @include('frontend.user.dashboard.driver.advertises')
        </div>
        <div id="driver-menu3" class="tab-pane fade">
            @include('frontend.user.dashboard.driver.passangers')
        </div>
        <div id="driver-menu4" class="tab-pane fade">
            @include('frontend.user.dashboard.driver.cars')
        </div>
    </div>

</div>
