<div class="profile-menu">

    <ul class="nav nav-pills nav-pills-underline" id="profile-menu">
        <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#profile-menu1">{{ __("dashboard.profile.datas.Title") }}</a></li>
        <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#profile-menu2">{{ __("dashboard.profile.settings.Title") }}</a></li>
    </ul>

    <div class="tab-content mt-3" id="profile-menu-content">
        <div id="profile-menu1" class="tab-pane fade active show">
            @include('frontend.user.dashboard.profile.data-sheet')
        </div>
        <div id="profile-menu2" class="tab-pane fade">
            @include('frontend.user.dashboard.profile.settings')
        </div>
    </div>

</div>
