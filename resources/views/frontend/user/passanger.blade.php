@extends('frontend.layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center mb-3">
        <div class="col col-12 align-self-center">

            @include('frontend.user.pages.includes.submenu', ['main_menu' => 2])
            <div role="passangertabpanel mt-2">
                <ul class="nav nav-pills nav-pills-underline" role="tablist" id="passanger-menu">
                    <li class="nav-item"><a href="#reserves" class="nav-link {{$tab==1?'active':''}}" aria-controls="reserves" role="tab" data-toggle="tab">Helyfoglalások</a></li>
                    <li class="nav-item"><a href="#adhunter" class="nav-link {{$tab==2?'active':''}}" aria-controls="adhunter" role="tab" data-toggle="tab">Hirdetésfigyelő</a></li>
                </ul>

                <div class="tab-content">
                    <div role="passangertabpanel" class="passanger-menu tab-pane fade show {{$tab==1?'active':''}} pt-3" id="reserves" aria-labelledby="reserves-tab">
                        @include('frontend.user.pages.passanger.reserves')
                    </div>

                    <div role="passangertabpanel" class="passanger-menu tab-pane fade show {{$tab==2?'active':''}} pt-3" id="adhunter" aria-labelledby="adhunter-tab">
                            @include('frontend.user.pages.passanger.adhunter')
                    </div>
                </div><!--tab panel-->

            </div><!-- role -->
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection

@push('after-scripts')
    <script>
        console.log("passanger-1");

        @if (isset($_SESSION['PASSANGER_TAB']))
            const passanger_tab = "{{ $_SESSION['PASSANGER_TAB'] }}";
            console.log("PASSANGER_TAB: " + passanger_tab);
            $('a[href="'+passanger_tab+'"]').click();
        @endif

        $('#passanger-menu a').on('click', function (e) {
            $.get("tab/set", {tab: 'PASSANGER_TAB', hash: e.target.hash},
                function(e) {
                    console.log(e);
                }
            );
        });

        console.log("passanger-2");
    </script>
@endpush
