@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('styles')
    <style>
        .result-panel {
            display: block;
            /* background-color: lightgray; */
            padding: 1rem;
        }

        .result-row {
            display: block;
            /* background-color: green; */
            /* border: 1px solid; */
            margin: 1rem;
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            height: 64px;
            cursor: pointer;
        }

        .result-row:hover {
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            border: 1px solid;
        }

        .box {
            position: relative;
            /* display: block;
            height: 64px; */
            text-decoration: none;
            color: inherit;
            background-color: #ddd;
            border-radius: 5px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            margin: 1rem;
            cursor: pointer;
        }

        .box::after {
            content: "";
            border-radius: 5px;
            position: absolute;
            z-index: -1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            opacity: 0;
            -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .box:hover {
            text-decoration: none;
            -webkit-transform: scale(1.05, 1.25);
            transform: scale(1.05, 1.25);
        }

        .box:hover::after {
            opacity: 1;
        }

        .search-panel {
            background-image: url("img/frontend/hazater.head.bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            height: 550px;
            /* min-height: 320px; */
            /* -webkit-animation: slide 0.5s forwards;
            -webkit-animation-delay: 1s;
            animation: slide 0.5s forwards;
            animation-delay: 1s; */
        }

        #searchForm {
            /* position: absolute;
            left: 380px;
             */
            /* top: 304px; */
            margin-top: 6rem!important
        }

        .welcome-panel-old {
            background-image: url("img/frontend/hazater.welcome.bg.png");
            background-repeat: no-repeat;
            /* min-height: 260px; */
            background-size: cover;
        }

        .easyuse-panel-old {
            background-image: url("img/frontend/hazater.easyuse.bg.png");
            background-repeat: no-repeat;
            /* min-height: 320px; */
            background-size: cover;
        }

        .step-1, .step-2, .step-3 {
            background-repeat: no-repeat;
            background-size: cover;
        }

        .step-1 {
            background-image: url("img/frontend/hazater.step-1.png");
        }

        .step-2 {
            background-image: url("img/frontend/hazater.step-2.png");
        }

        .step-3 {
            background-image: url("img/frontend/hazater.step-3.png");
        }

        connection {
            border: 5px dashed #6CAEC4;
            border-radius: 0;
        }

        .map-panel {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 0px!important;
            padding-left: 0px!important;
        }

        img.centered {
            display: block;
            margin: auto auto;
        }

        .loader {
            display: none;
            width: 100%;
            height: 100%;
        }

        .loading {
            height: 80px;
            width: 80px;
            background: url(../images/loading.gif);
            background-repeat: no-repeat;
            background-position: center center;
        }
    </style>
@endsection

{{-- <div id="loader" class="loader">
    <div class="loading"></div>
</div> --}}

@section('search')
    <!-- SEARCH -->
    <div class="search-panel">
        <div class="form-row pt-5 pb-1 flex-row justify-content-center text-white">
            <h1 class="outline" style="padding-top: 3em;"><strong><i>HazaTér</i></strong></h1>
        </div>
        <div class="form-row mt-1 mb-5 flex-row justify-content-center text-white">
            <h4 class="text-center outline">„Lépés-Váltás az Észak-Hegyháton - közös utakon”</h4>
        </div>

        <form id="searchForm" method="POST" action="{{ route('frontend.find') }}" class="form-inline search-form flex-row justify-content-center" autocomplete="off">
            <div class="form-row mt-5 mb-5">
                <div class="input-group mr-2 mb-2">
                    <input id="searchStartCity" name="searchStartCity" class="form-control typeahead typeahead-start-city" data-provide="typeahead" type="text" placeholder="Indulási hely" value="{{isset($search)?$search['start_city']:''}}" autocomplete="anyrandomstring">
                    <div class="input-group-append">
                        <div class="input-group-text"><img class="addon-image" src="img/frontend/hazater.icon.start.png"></div>
                    </div>
                </div>
                <div class="input-group mr-2 mb-2">
                    <input id="searchEndCity" name="searchEndCity" class="form-control typeahead typeahead-end-city" data-provide="typeahead" type="text" placeholder="Érkezési hely" value="{{isset($search)?$search['end_city']:''}}" autocomplete="anyrandomstring2">
                    <div class="input-group-append">
                        <div class="input-group-text"><img class="addon-image" src="img/frontend/hazater.icon.finish.png"></div>
                    </div>
                </div>
                <div class="input-group mr-2 mb-2">
                    <input id="searchDate" name="searchDate" class="form-control datum" type="text" placeholder="Dátum" value="{{isset($search) ? \App\Helpers\Hazater::formatDate2($search['date'], 1) : ''}}" autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text"><img class="addon-image" src="img/frontend/hazater.icon.date.png"></div>
                    </div>
                </div>
                <div class="input-group mr-2 mb-2">
                    <input id="searchName" name="searchName" class="form-control typeahead typeahead-name" data-provide="typeahead" type="text" placeholder="Név" value="{{isset($search)?$search['name']:''}}" autocomplete="anyrandomstring2">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>
                </div>
                <div class="input-group mr-2 mb-2">
                    {!! csrf_field() !!}
                    <button id="searchButton" class="btn btn-info col-12 col-md-12 col-xl-12">{{ __("labels.general.buttons.search") }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <!-- RESULT -->
    <div class="result-panel justify-content-center">
        @php
            setlocale(LC_ALL,'hu_HU');
            $last_date = null;
        @endphp
        @forelse ($results as $result)
            @php
                $date = strftime("%Y %B %d, %A", strtotime($result->start_date));
                $dateTime = new DateTime($result->start_date);
                $date = IntlDateFormatter::formatObject($dateTime, "Y MMMM d, eeee", "hu_HU");
            @endphp

            @if ($date != $last_date)
                <b>{{$date}}</b>
                @php
                    $last_date = $date;
                @endphp
            @endif

            <!-- RESULT -->
                <div class="row box pl-3 pr-3">
                    <div class="col-xs-12 col-md-7" onclick="window.location='{{route('frontend.advertise.reserve', $result->id)}}';">{!! $result->dates_label !!}&nbsp;<i>({!! $result->highway_label !!})</i><br>{!! $result->cities_label !!}</div>
                    <div class="col-xs-12 col-md-1 align-middle">
                        @if($result->mode > 0)
                        <a class="bus" data-key="{{ $result->id }}" data-mode="{{ $result->mode }}" title="Tömegközlekedés"><img class="centered align-middle" src="{{ asset('img/frontend/hazater.icon.bus.png') }}">Tömegközlekedés</a>
                        @endif
                    </div>
                    <div class="col-xs-12 col-md-1" onclick="window.location='{{route('frontend.advertise.reserve', $result->id)}}';">{!! $result->free_seats !!} hely</div>
                    @if(1==2)
                        <div class="col-xs-12 col-md-1" onclick="window.location='{{route('frontend.advertise.reserve', $result->id)}}';">
                            @if($result->user->picture)
                            <img src="{{ $result->user->picture }}" class="img-avatar" height="48px">
                            @endif
                        </div>
                    @endif
                    <div class="col-xs-12 col-md-3" onclick="window.location='{{route('frontend.advertise.reserve', $result->id)}}';">{{ $result->user->rated_name }}<br>{!! $result->car_label !!}</div>
                </div>
        @empty
            <em>{{ __("strings.frontend.no_results_found")}}</em>
        @endforelse

        @if ($results)
            {{ $results->links() }}
        @endif
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {
            //$(".datum").datepicker($.datepicker.regional["hu"]);
            $("#searchDate").bootstrapMaterialDatePicker({
                format: 'YYYY.MM.DD HH:mm',
                lang: 'hu',
                weekStart: 1,
                cancelText: 'Mégsem',
                clearText: 'Törlés',
                minDate: dateToday,
                //switchOnClick: true,
                clearButton: true,
                time: false,
            }).on('change', function(e, d) {
                //console.log(d);
                var date = new Date(d);
                var year = date.getFullYear();
                var month = zeroPad(date.getMonth() + 1, 2);
                var day = zeroPad(date.getDate(), 2);
                // var hour = date.getHours();
                // var min = date.getMinutes();
                if (isNaN(date)) {
                    date = "";
                } else {
                    date = year + "." + month + "." + day;
                }
                $('#searchDate').val(date);
            });

            $('.typeahead-start-city').typeahead({
                source: function (query, process) {
                    return $.get("{{ route('frontend.search.city') }}", {query: query}, function (data) {
                        return process(data);
                    }).fail(function (error){console.log(error)});
                }
            });
            $('.typeahead-end-city').typeahead({
                source: function (query, process) {
                    return $.get("{{ route('frontend.search.city') }}", {query: query}, function (data) {
                        return process(data);
                    }).fail(function (error){console.log(error)});
                }
            });
            $('.typeahead-name').typeahead({
                source: function (query, process) {
                    if ((''+query).length >= 2) {
                        return $.get("{{ route('frontend.search.name') }}", {query: query}, function (data) {
                            return process(data);
                        }).fail(function (error){console.log(error)});
                    }
                }
            });
            // $(document).ajaxStart(function() {
            //     $("#loader").css("display", "block");
            // }).ajaxStop(function() {
            //     $("#loader").css("display", "none");
            // });
            $('.bus').click(function() {
                swal({
                    title: 'Lekérdezés folyamatban...',
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        swal.showLoading();
                        $.get("{{ route('frontend.search.transport') }}", {
                            advertise: $(this).data("key"),
                            mode: $(this).data("mode"),
                            startCity: $('#searchStartCity')[0].value,
                            endCity: $('#searchEndCity')[0].value,
                        }, function (data) {
                            //console.log(data);
                            swal.hideLoading();
                            var res = JSON.parse(data)[0];
                            var route = res.data.Res.Connections.Connection[0];
                            console.log(route);
                            swal({
                                type: 'success',
                                title: res.name,
                                html: hereRouteToHtml(route),
                            });
                            //showInfo(route, 'Tömegközlekedés');
                        }).fail(function (error) {
                            swal.hideLoading();
                            showError(error)
                        });
                    },
                });
            });
            //$('#searchButton').click();
        });
    </script>
@endsection
