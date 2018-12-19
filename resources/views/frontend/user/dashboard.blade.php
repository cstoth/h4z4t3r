@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <div class="row mb-4">
        <div class="col">

            <ul class="nav nav-tabs" id="main-menu">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#driver">{{ __('dashboard.driver-menu') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#passenger">{{ __('dashboard.passenger-menu') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">{{ __('dashboard.profile-menu') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages">{{ __('dashboard.messages-menu') }}</a></li>
            </ul>

            <div class="tab-content" id="main-menu-content">
                <div id="driver" class="tab-pane fade active show">
                    @include('frontend.user.dashboard.tabs.driver-menu')
                </div>
                <div id="passenger" class="tab-pane fade">
                    @include('frontend.user.dashboard.tabs.passenger-menu')
                </div>
                <div id="profile" class="tab-pane fade">
                    @include('frontend.user.dashboard.tabs.profile-menu')
                </div>
                <div id="messages" class="tab-pane fade">
                    @include('frontend.user.dashboard.tabs.messages-menu')
                </div>
            </div>

        </div><!-- row -->
    </div><!-- row -->
@endsection

@push('after-scripts')
    <script>
        console.log("dashboard-1");

        @if (isset($_SESSION['MAIN_MENU_ID']))
            console.log("{{$_SESSION['MAIN_MENU_ID']}}");
            const main_menu_id = "{{ $_SESSION['MAIN_MENU_ID'] }}";
            $("#main-menu > .nav-item > .nav-link.active").removeClass("active");
            $('a[href="'+ main_menu_id +'"]').addClass("active show");

            $("#main-menu-content > .tab-pane.active").removeClass("active show");
            $(main_menu_id).addClass("active show");
        @endif

        $(function() {
            function gotoHashTab(customHash) {
                var hash = customHash || location.hash || "#driver";
                var id = hash.split('?')[0];

                $("#main-menu > .nav-item > .nav-link.active").removeClass("active");
                $('a[href="'+ id +'"]').addClass("active show");

                $("#main-menu-content > .tab-pane.active").removeClass("active show");
                $(id).addClass("active show");
            }

            // onready go to the tab requested in the page hash
            gotoHashTab();

            // when the nav item is selected update the page hash
            $('#main-menu a').on('active', function (e) {
                console.log(e.target.hash);
                window.location.hash = e.target.hash;
            });

            $('.nav-pills-underline').on('active', function (e) {
                console.log(e.target.hash);
                window.location.hash = e.target.hash;
            });

            $('.nav-link a').on('shown', function (e) {
                console.log(e.target.hash);
                window.location.hash = e.target.hash;
            });

            // when a link within a tab is clicked, go to the tab requested
            $('#main-menu > .nav-item > .nav-link').click(function (e) {
                window.location.hash = e.target.hash;
                console.log(e.target.hash);
                // if (event.target.hash) {
                //     gotoHashTab(event.target.hash);
                // }
            });
        });

        console.log("dashboard-2");
    </script>
@endpush
