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
            /* min-height: 320px; */
            background-size: cover;
            /* -webkit-animation: slide 0.5s forwards;
            -webkit-animation-delay: 1s;
            animation: slide 0.5s forwards;
            animation-delay: 1s; */
        }

        #searchForm {
            /* position: absolute;
            left: 380px;
             */
            top: 304px;
        }
    </style>
@endsection


<div class="search-panel">
    <div class="form-row pt-3 pb-1 flex-row justify-content-center text-white">
        <h1><strong><i>HazaTér</i></strong></h1>
    </div>
    <div class="form-row mt-1 mb-5 flex-row justify-content-center text-white">
        <h4 class="text-center">„Lépés-Váltás az Észak-Hegyháton - közös utakon”</h4>
    </div>

    <form id="searchForm" action="{{ route('frontend.search') }}" class="form-inline search-form flex-row justify-content-center" autocomplete="off">
        <div class="form-row mt-5 mb-5">
            <div class="input-group mr-2 mb-2">
                <input id="searchStartCity" name="searchStartCity" class="form-control typeahead typeahead-start-city" data-provide="typeahead" autocomplete="anyrandomstring" type="text" placeholder="Indulási hely" >
                <div class="input-group-append">
                    <div class="input-group-text"><img class="addon-image" src="img/frontend/hazater.icon.start.png"></div>
                </div>
            </div>
            <div class="input-group mr-2 mb-2">
                <input id="searchEndCity" name="searchEndCity" class="form-control typeahead typeahead-end-city" data-provide="typeahead" autocomplete="anyrandomstring2" type="text" placeholder="Érkezési hely" >
                <div class="input-group-append">
                    <div class="input-group-text"><img class="addon-image" src="img/frontend/hazater.icon.finish.png"></div>
                </div>
            </div>
            <div class="input-group mr-2 mb-2">
                <input id="searchDate" name="searchDate" class="form-control datum" autocomplete="off" type="text" placeholder="Dátum" >
                <div class="input-group-append">
                    <div class="input-group-text"><img class="addon-image" src="img/frontend/hazater.icon.date.png"></div>
                </div>
            </div>
            <div class="input-group mr-2 mb-2">
                <button id="searchButton" class="btn btn-primary col-12 col-md-12 col-xl-12">{{ __("labels.general.buttons.search") }}</button>
            </div>
        </div>
    </form>
</div>

@section('scripts')
    <script>
            $(".datum").datepicker($.datepicker.regional["hu"]);

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

            // $('#searchButton').on('click', function (e) {
            //     console.log(e);
            //     console.log($('#searchStartCity').value());
            //     console.log($('#searchEndCity').value());
            //     console.log($('#searchDate').value());
            // });

            // $("#searchForm").submit(function(event) {
            //     event.preventDefault(); // cancels the form submission
            //     // console.log($(".result-panel"));
            //     $(".result-panel").empty();
            //     $.ajax({
            //         type: "GET",
            //         url: "{{ route('frontend.search.advertise') }}",
            //         data: {
            //             startCity: $("#searchStartCity").val(),
            //             endCity: $("#searchEndCity").val(),
            //             date: $("#searchDate").val(),
            //         },
            //         success: function(response) {
            //             console.log(response);
            //             // var fromCoord = { data.from.x, data.from.y };
            //             // console.log(fromCoord);
            //             // var toCoord = { data.to.x, data.to.y };
            //             // console.log(toCoord);
            //             // var fromMarker = new H.map.Marker(fromCoord);
            //             // map.addObject(fromMarker);
            //             // var toMarker = new H.map.Marker(toCoord);
            //             // map.addObject(toMarker);
            //             for (var key in response) {
            //                 var result = response[key];
            //                 console.log(result);
            //                 var dates = result.start_date+' - '+result.end_date;
            //                 $(".result-panel").append('<div class="row box">'+dates+'</div>');

            //                 $("#step-1, #step-2").connections("update");
            //                 $("#step-2, #step-3").connections("update");
            //             }
            //         },
            //         error: function(error) {
            //             console.log(error);
            //         }
            //     });
            // });

    </script>
@endsection
