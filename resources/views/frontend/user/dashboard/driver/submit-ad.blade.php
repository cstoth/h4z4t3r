@push('after-styles')
    <style>
    </style>
@endpush

{{ html()->form('POST', route('frontend.advertise'))->open() }}

    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">

    <div class="form-row">
        <div class="col">
            <select disabled class="form-control" id="sablon-load" placeholder="{{ __('dashboard.driver.submit-ad.Template placeholder') }}">
                <option>Sablon 1</option>
                <option>Sablon 2</option>
                <option>Sablon 3</option>
                <option>Sablon 4</option>
                <option>Sablon 5</option>
            </select>
        </div>
        <div class="col">
            <button disabled type="button" class="btn btn-info">{{ __('dashboard.driver.submit-ad.Load Template') }}</button>
        </div>
    </div>

    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.1 Car Datas') }}</span>

    <div class="form-row">
        <div class="col col-md-2">
            <label for="car_id">{{ __('dashboard.driver.submit-ad.License Number') }}</label>
            <select class="form-control" id="car_id" name="car_id" placeholder="{{ __('dashboard.driver.submit-ad.License Number') }}">
                @foreach($cars['datas'] as $data)
                    <option value="{{ $data->id }}">{{ $data->license }}</option>
                @endforeach
            </select>
        </div>
        <div class="col col-md-2">
            <label for="ules">{{ __('dashboard.driver.submit-ad.Free Seats') }}</label>
            {{-- <input class="form-control" type="number" id="ules" value="1" placeholder="{{ __('dashboard.driver.submit-ad.Free Seats') }}"> --}}

            <select class="form-control" id="ules" placeholder="{{ __('dashboard.driver.submit-ad.Free Seats') }}">
                @if (count($cars['datas']) > 0)
                    @for($i = $cars['datas'][0]->seats; $i > 0 ; $i--)
                        <option>{{$i}}</option>
                    @endfor
                @endif
            </select>
        </div>
    </div>

    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.2 Route, Date') }}</span>

    <div class="form-row">

    <div class="col">

    <div class="form-row">
        <div class="col">
            <label for="start_city">{{ __('dashboard.driver.submit-ad.Start Place') }}</label>
            <input class="form-control typeahead typeahead-start-city" id="start_city" name="start_city" placeholder="{{ __('dashboard.driver.submit-ad.Start Place') }}" type="text">
        </div>

        <div class="col">
            <label for="start_date">{{ __('dashboard.driver.submit-ad.Start Date') }}</label>
            <div class='input-group'>
                <input type='text' id="start_date" name="start_date" class="form-control date" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>

    <div class="form-row mt-2 mb-2">
        <div class="col">
            {{-- <label for="koztes-hely">{{ __('dashboard.driver.submit-ad.Midpoints') }}</label> --}}
            <a id="koztes-hely" href="#">{{ __('dashboard.driver.submit-ad.Add Midpoint') }}</a> {{-- class="form-control" --}}
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="end_city">{{ __('dashboard.driver.submit-ad.Target Place') }}</label>
            <input class="form-control typeahead typeahead-end-city" id="end_city" name="end_city" placeholder="{{ __('dashboard.driver.submit-ad.Target Place') }}" type="text">
        </div>

        <div class="col">
            <label for="end_date">{{ __('dashboard.driver.submit-ad.Target Date') }}</label>
            <div class='input-group'>
                <input type='text' id="end_date" name="end_date" class="form-control date" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>

    </div>

    <div class="col">
        <div class="panel panel-default map-panel">
            <div style="width: 100%; height: 240px" id="mapContainerDashboard"></div>
        </div>
    </div>

    </div>

    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.3 Publish Ad') }}</span>

    <div class="form-row" id="radio-tab">
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="publishOptions" id="regular" value="regular" checked>
                <label class="form-check-label" for="regular">{{ __('dashboard.driver.submit-ad.Regular Route') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="publishOptions" id="unique" value="unique">
                <label class="form-check-label" for="unique">{{ __('dashboard.driver.submit-ad.Unique Route') }}</label>
            </div>
        </div>
    </div>

    <div id="radio-tab-content" class="tab-content mt-3">
        <div id="regular-tab" class="tab-pane fade active show">
            <div class="form-row">
                <div class="col">
                    <label>{{ __('dashboard.driver.submit-ad.Regular Description') }}</label>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="regularCheck0" value="0">
                        <label class="form-check-label" for="inlineCheckbox1">{{ __('dashboard.driver.submit-ad.All Days') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="regularCheck1" value="1">
                        <label class="form-check-label" for="inlineCheckbox2">{{ __('dashboard.driver.submit-ad.Monday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="regularCheck2" value="2">
                        <label class="form-check-label" for="inlineCheckbox3">{{ __('dashboard.driver.submit-ad.Tuesday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="regularCheck3" value="3">
                        <label class="form-check-label" for="inlineCheckbox3">{{ __('dashboard.driver.submit-ad.Wednesday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="regularCheck4" value="4">
                        <label class="form-check-label" for="inlineCheckbox3">{{ __('dashboard.driver.submit-ad.Thursday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="regularCheck5" value="5">
                        <label class="form-check-label" for="inlineCheckbox3">{{ __('dashboard.driver.submit-ad.Friday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="regularCheck6" value="6">
                        <label class="form-check-label" for="inlineCheckbox3">{{ __('dashboard.driver.submit-ad.Saturday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="regularCheck7" value="7">
                        <label class="form-check-label" for="inlineCheckbox3">{{ __('dashboard.driver.submit-ad.Sunday') }}</label>
                    </div>
                </div>
            </div>

        </div>
        <div id="unique-tab" class="tab-pane fade">
            <div class="form-row">
                <div class="col col-md-1">
                    <label for="datum">{{ __('dashboard.driver.submit-ad.Date') }}</label>
                </div>

                <div class="col col-md-2">
                    <div class='input-group' id='datum'>
                        <input type='text' class="form-control date" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <a class="" id="datum-add" href="#">{{ __('dashboard.driver.submit-ad.Add Date') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row mt-5">
        <div class="col col-md-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="save-template" value="save-template">
                <label class="form-check-label" for="inlineCheckbox3">{{ __('dashboard.driver.submit-ad.Save as Template') }}</label>
            </div>
        </div>
        <div class="col">
            <input class="form-control" type="text" id="sablon-save" placeholder="{{ __('dashboard.driver.submit-ad.Template placeholder') }}" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="col text-center mt-5">
            <button type="submit" class="btn btn-primary col-md-4">{{ __('dashboard.driver.submit-ad.Submit Button') }}</button>
        </div>
    </div>

{{ html()->form()->close() }}

@push('after-scripts')
<script type="text/javascript">

console.log("submit-ad-1");

const car_count = {{count($cars['datas'])}};
if (car_count < 1) {
    // TODO letiltani a feltöltést !
    swal({
        type: 'error',
        title: 'Út feltöltése',
        text: 'Még nem regisztrált egyetlen fépjárművet sem a rendszerben!',
    }).then((result) => {
        //location.href = "/";
    });
}

$('#regular').click(function(){
    $('#unique-tab').removeClass("active show");
    $('#regular-tab').addClass("active show");
    //$('#regular-tab').tab('show');
});
$('#unique').click(function(){
    $('#regular-tab').removeClass("active show");
    $('#unique-tab').addClass("active show");
    //$('#unique-tab').tab('show');
});
$('#save-template').click(function(){
    if($(this).is(':checked')) {
        $('#sablon-save').prop('disabled', false);
    } else {
        $('#sablon-save').prop('disabled', true);
    }
});

$(".date").datepicker($.datepicker.regional["hu"]);

$("#searchForm").submit(function(event) {
    event.preventDefault(); // cancels the form submission
    console.log($("#fromAddress"));
    $.ajax({
        type: "GET",
        url: "#", // { { route('search') }}",
        data: "from=" + $("#fromAddress").val() + "&to=" + $("#toAddress").val() + "&date=" + $("#date").val(),
        success: function(data) {
            console.log(data);
            // var fromCoord = { data.from.x, data.from.y };
            // console.log(fromCoord);
            // var toCoord = { data.to.x, data.to.y };
            // console.log(toCoord);
            // var fromMarker = new H.map.Marker(fromCoord);
            // map.addObject(fromMarker);
            // var toMarker = new H.map.Marker(toCoord);
            // map.addObject(toMarker);
        }
    });
});

var mapDashboard = makeMap('mapContainerDashboard', mapInitCenter);
// var center = {lat: 46.31357, lng: 18.24538};
// var map = new H.Map(
//     document.getElementById('mapContainer'),
//     defaultLayers.normal.map,
//     {zoom: 12, center: center}
// );
// var ui = H.ui.UI.createDefault(map, defaultLayers); // , 'hu-HU'); //TODO use default language

// var mapSettings = ui.getControl('mapsettings');
// var zoom = ui.getControl('zoom');
// var scalebar = ui.getControl('scalebar');
// var panorama = ui.getControl('panorama');

// // panorama.setAlignment('top-left');
// // mapSettings.setAlignment('top-left');
// // zoom.setAlignment('top-left');
// // scalebar.setAlignment('top-left');

// var mapEvents = new H.mapevents.MapEvents(map);
// map.addEventListener('pointerup', function(evt) {
//     console.log(evt.type, evt.currentPointer.type);
// });

// var behavior = new H.mapevents.Behavior(mapEvents);

// var marker = new H.map.Marker(center);
// map.addObject(marker);

function random(max) {
  return 1 + Math.floor(Math.random() * Math.floor(max));
}

function fillCombo(combo, values) {

}

function makeNumList(cnt) {
    var arr = [];
    for (var i = 1; i < cnt; i++) {
        arr[i] = '<option value="'+i+'">'+i+'</option>';
    }
    //console.log(arr);
    return arr.reverse();
}

$('#car_id').on('change', function() {
    var car_id = $('#car_id').val();
    console.log(car_id);
    $.ajax({url: "car/get/" + car_id, success: function(response) {
        console.log(response);
        $("#ules").empty().append(makeNumList(response.seats));
    }});
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

//console.log($('#ules'));
//fillCombo("#ules", makeNumList(5));
//console.log($('#ules'));

$('#koztes-hely').on('click', function() {
    swal('Köztes megálló hozzáadása');
});

console.log("submit-ad-2");

</script>
@endpush
