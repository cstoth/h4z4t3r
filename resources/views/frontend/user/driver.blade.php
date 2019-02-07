@extends('frontend.layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center mb-3">
        <div class="col col-12 align-self-center">

            @include('frontend.user.pages.includes.submenu', ['main_menu' => 1])
            <div role="drivertabpanel mt-2">
                <ul class="nav nav-pills nav-pills-underline" role="tablist" id="driver-menu">
                    <li class="nav-item"><a href="#submit-ad" class="nav-link {{$tab==1?'active':''}}" aria-controls="submit-ad" role="tab" data-toggle="tab">@lang('dashboard.driver.submit-ad.Title')</a></li>
                    <li class="nav-item"><a href="#advertises" class="nav-link {{$tab==2?'active':''}}" aria-controls="advertises" role="tab" data-toggle="tab">@lang('dashboard.driver.advertises.Title')</a></li>
                    {{-- @if($logged_in_user->canChangePassword()) --}}
                    <li class="nav-item"><a href="#passangers" class="nav-link {{$tab==3?'active':''}}" aria-controls="passangers" role="tab" data-toggle="tab">@lang('dashboard.driver.passengers.Title')</a></li>
                    {{-- @endif --}}
                    <li class="nav-item"><a href="#cars" class="nav-link {{$tab==4?'active':''}}" aria-controls="cars" role="tab" data-toggle="tab">@lang('dashboard.driver.cars.Title')</a></li>
                </ul>

                <div class="tab-content">
                    <div role="drivertabpanel" class="driver-menu tab-pane fade show {{$tab==1?'active':''}} pt-3" id="submit-ad" aria-labelledby="submit-tab">
                        @if (count($cars) > 0)
                            @include('frontend.datasets.advertise.create')
                        @else
                            @lang('dashboard.driver.submit-ad.NoCarRegistered')
                        @endif
                    </div><!--tab panel profile-->

                    <div role="drivertabpanel" class="driver-menu tab-pane fade show {{$tab==2?'active':''}} pt-3" id="advertises" aria-labelledby="advertises-tab">
                        @include('frontend.user.pages.driver.advertises')
                    </div><!--tab panel profile-->

                    <div role="drivertabpanel" class="driver-menu tab-pane fade show {{$tab==3?'active':''}} pt-3" id="passangers" aria-labelledby="passangers-tab">
                        @include('frontend.user.pages.driver.passangers')
                    </div><!--tab panel change password-->

                    <div role="drivertabpanel" class="driver-menu tab-pane fade show {{$tab==4?'active':''}} pt-3" id="cars" aria-labelledby="cars-tab">
                        @include('frontend.user.pages.driver.cars')
                    </div><!--tab panel profile-->
                </div><!--tab content-->
            </div><!-- role -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection

@push('after-scripts')
    <script>
        console.log("driver-1");

        @if (isset($_SESSION['DRIVER_TAB']))
            const driver_tab = "{{ $_SESSION['DRIVER_TAB'] }}";
            console.log("SESSION_TAB: " + driver_tab);
            //$('a[href="localhost"]').click();
            //$('a[href="'+driver_tab+'"]').click();
        @endif

        $('#driver-menu a').on('click', function (e) {
            //Ez azért kell mert nem mindíg rajzolja a térkép tartalmát
            setTimeout(function(){
                var h = $('#mapContainerForm').height();
                $('#mapContainerForm').height(h-1);
                mapAdvertiseForm.getViewPort().resize();
                setTimeout(function(){
                    $('#mapContainerForm').height(h);
                    mapAdvertiseForm.getViewPort().resize();
                }, 100);
            }, 100);
            $.get("tab/set", {tab: 'DRIVER_TAB', hash: e.target.hash},
                function(e) {
                    console.log(e);
                }
            );
        });

        console.log("driver-2");
    </script>
@endpush
