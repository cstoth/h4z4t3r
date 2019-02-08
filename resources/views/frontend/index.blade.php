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
            display: block;
            height: 64px;
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
            -webkit-transform: scale(1.1, 1.25);
            transform: scale(1.1, 1.25);
        }

        .box:hover::after {
            opacity: 1;
        }

        .search-panel {
            background-image: url("img/frontend/hazater.head.bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            height: 550px;
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
            /*margin-top: 6rem!important*/
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

        #index-map {
            background-image: url("img/frontend/map_bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            padding-top: 4em;
            padding-bottom: 4em;
        }

        .circle {
            z-index: 10;
        }
        .circle-label {
            background-color: #F8F9FA;
        }
    </style>
@endsection

@section('search')
    <!-- SEARCH -->
    <div class="search-panel pt-lg-5 pt-sm-5 pt-md-5">
        <div class="form-row pt-lg-5 pt-sm-5 pt-md-5 pb-1 flex-row justify-content-center text-white">
            <h1 class="outline pt-lg-5"><strong><i>HazaTér</i></strong></h1>
        </div>
        <div class="form-row mt-1 mb-5 flex-row justify-content-center text-white">
            <h4 class="text-center outline">„Lépés-Váltás az Észak-Hegyháton - közös utakon”</h4>
        </div>

        <form id="searchForm" method="POST" action="{{ route('frontend.find') }}" class="form-inline search-form flex-row justify-content-center p-3" autocomplete="off">
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
                    <input id="searchName" name="searchName" class="form-control typeahead typeahead-name" data-provide="typeahead" type="text" placeholder="Név" value="{{isset($search)?$search['name']:''}}" autocomplete="anyrandomstring">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>
                </div>
                <div class="input-group mr-2 mb-2">
                    {!! csrf_field() !!}
                    <button id="searchButton" class="btn btn-info col-12 col-md-12 col-xl-12 search-button">{{ __("labels.general.buttons.search") }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
<!-- <div class="container"> -->
    <!-- RESULT -->
    {{-- <div class="result-panel justify-content-center">
    </div> --}}

    <!-- WELCOME -->
    <div class="welcome-panel">
        <div class="form-row pt-0 flex-row welcome-panel justify-content-center text-info">
            <h5 class="text-center">Köszöntünk a <strong><i>HazaTér</i></strong> közösségi közlekedés-támogató rendszerén!</h5>
        </div>
        <div class="form-row pt-1 pb-1 flex-row welcome-panel justify-content-center text-info">
            <p class="text-justify">A <strong><i>HazaTér</i></strong> egy interaktív közösségi közlekedés-támogató rendszer. Célja, hogy a segítségével az Észak-Hegyháti térségben az egyéni és a közösségi közlekedés összehangolásával emeljük a Falubusz kihasználtságát, a szolgáltatás színvonalát, az utazási élményt, valamint az utazási költségek csökkentése mellett a környezeti károsanyag kibocsájtás csökkentését is elősegítsük.</p>
        </div>
        <div class="form-row pt-1 pb-1 flex-row welcome-panel text-info">
            <p class="text-justify">A rendszer a HazaTér- közös utakon; EFOP-1.5.3-16-2017-00070  "Lépés-Váltás az Észak-Hegyháton”  projekt keretében került mergvalósításra.</p>
        </div>
        <div class="form-row pt-1 pb-5 flex-row welcome-panel justify-content-center text-info">
            <h5 class="text-center">Kellemes utazást kívánunk!</h5>
        </div>
        <hr style="border-top: 2px solid #6CAEC4">
    </div>

    <!-- EASYUSE -->
    <div class="row bg-light">
        <div class="col">
            <div class="form-row pt-1 flex-row easyuse-panel justify-content-center">
                <h5><strong>Használd egyszerűen!</strong></h5>
            </div>
            <div class="form-row pt-1 ml-1 mr-1 flex-row justify-content-center">

                <div class="col-xs-12 col-lg-3 circle">
                    <div class="form-row justify-content-center mb-1">
                        <img id="step-1" src="img/frontend/hazater.step-1.png">
                    </div>
                    <div class="form-row justify-content-center circle-label text-info">
                        1. lépés
                    </div>
                    <div class="form-row justify-content-center circle-label">
                        Regisztrálj honlapunkon
                    </div>
                    <div class="form-row justify-content-center pb-5">
                    </div>
                </div>

                <div class="col-xs-12 col-lg-1"></div>

                <div class="col-xs-12 col-lg-3 circle">
                    <div class="form-row justify-content-center mb-1">
                        <img id="step-2" src="img/frontend/hazater.step-2.png">
                    </div>
                    <div class="form-row justify-content-center circle-label text-info">
                        2. lépés
                    </div>
                    <div class="form-row justify-content-center circle-label">
                        Keress a meghirdetett utak között
                    </div>
                    <div class="form-row justify-content-center pb-5">
                    </div>
                </div>

                <div class="col-xs-12 col-lg-1"></div>

                <div class="col-xs-12 col-lg-3 circle">
                    <div class="form-row justify-content-center mb-1">
                        <img id="step-3" src="img/frontend/hazater.step-3.png">
                    </div>
                    <div class="form-row justify-content-center circle-label text-info">
                        3. lépés
                    </div>
                    <div class="form-row justify-content-center circle-label">
                        Foglalj helyet és utazzatok együtt!
                    </div>
                    <div class="form-row justify-content-center pb-5">
                    </div>
                </div>

            </div>
        </div><!--col-->
    </div><!--row-->

    <!-- MAP -->
    <div class="row">
        <!-- <div class="col"> -->
            <div id="index-map" class="col map-panel">
                <div style="width: 100%; height: 480px" id="mapContainerIndex"></div>
            </div>
        <!-- </div>col -->
    </div><!--row-->
<!-- </div>container -->

@endsection

@section('scripts')
    <script>
        var x1 = null;
        var y1 = null;
        var x2 = null;
        var y2 = null;

        $(function () {
            $(window).on('resize', function() {
                $("#step-1, #step-2").connections("update");
                $("#step-2, #step-3").connections("update");
            });

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
        });

        var mapIndex = makeMap('mapContainerIndex', mapInitCenter);

        function setSearchPoint(coord, input) {
            geocodingService.reverseGeocode({
                prox: '' + coord.lat + ',' + coord.lng + ',0',
                mode: 'retrieveAddresses',
                maxresults: 1,
            },
            function(result) {
                var city = result.Response.View[0].Result[0].Location.Address.City;
                if (input == 'start') {
                    console.log('Kezdőpont', city, coord);
                    $('#searchStartCity').val(city);
                    x1 = coord.lat;
                    y1 = coord.lng;
                } else {
                    console.log('Célpont', city, coord);
                    $('#searchEndCity').val(city);
                    x2 = coord.lat;
                    y2 = coord.lng;
                }
                calcRoute(mapIndex, x1, y1, x2, y2);
            },
            function(error) {
                console.log(error.message);
            });
        }

        mapIndex.addEventListener('contextmenu', function(e) {
            var index_map_coord = mapIndex.screenToGeo(e.viewportX, e.viewportY);
            //console.log(index_map_coord);

            e.items.push(new H.util.ContextItem({
                label: 'Kezdőpont innen',
                callback: function() {
                    setSearchPoint(index_map_coord, 'start');
                },
            }));
            // e.items.push(new H.util.ContextItem({
            //     label: 'Köztes megálló itt',
            //     callback: function() { console.log('Megálló'); }
            // }));
            e.items.push(new H.util.ContextItem({
                label: 'Célpont ide',
                callback: function() {
                    setSearchPoint(index_map_coord, 'end');
                },
            }));
            e.items.push(H.util.ContextItem.SEPARATOR);
            e.items.push(new H.util.ContextItem({
                label: 'Nagyítás',
                callback: function(evt) {
                    mapIndex.setCenter(index_map_coord, true);
                    mapIndex.setZoom(mapIndex.getZoom() + 1, true);
                }
            }));
            e.items.push(new H.util.ContextItem({
                label: 'Kicsinyítés',
                callback: function() {
                    mapIndex.setCenter(index_map_coord, true);
                    mapIndex.setZoom(mapIndex.getZoom() - 1, true);
                }
            }));
        });

        // Ez legyen a végén!
        $("#step-1, #step-2").connections();
        $("#step-2, #step-3").connections();
    </script>
@endsection
