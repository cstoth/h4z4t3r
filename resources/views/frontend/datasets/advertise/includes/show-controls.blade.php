<div class="col col-12">

    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.1 Car Datas') }}</span>

    <div class="form-row">
        <div class="col-md-4">
            <div class="form-row">
                <div class="col-md-12">
                    <label for="car_id">{{ __('dashboard.driver.submit-ad.License Number') }}</label>
                    <input class="form-control" id="car_id" name="car_id" type="text" value="{!! $advertise->car_label !!}" readonly>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col-md-12">
                    <label for="ules">{{ __('dashboard.driver.submit-ad.Free Seats') }}</label>
                    <input class="form-control" id="free_seats" name="free_seats" type="text" value="{!! $advertise->free_seats !!}" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-4  justify-content-center align-items-center">
            @if($advertise->car->image)
                <img src="{{ $advertise->car->picture }}" class="user-profile-image" style="max-width:200px;max-height:100px"/>
            @endif
        </div>
        <div class="col-md-4  justify-content-center align-items-center">
            @if($advertise->car->image2)
                <img src="{{ $advertise->car->picture2 }}" class="user-profile-image" style="max-width:200px;max-height:100px"/>
            @endif
        </div>
    </div>

    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.2 Route, Date') }}</span>

    <div class="form-row">
        <div class="col-md-6">
            <div class="form-row">
                <div class="col-md-8">
                    <label for="start_city">{{ __('dashboard.driver.submit-ad.Start Place') }}</label>
                    <input class="form-control" id="start_city" name="start_city" type="text" value="{!! $advertise->start_city_label !!}" readonly>
                </div>
                <div class="col-md-4">
                    <label for="start_date">{{ __('dashboard.driver.submit-ad.Start Date') }}</label>
                    <div class='input-group'>
                        <input type='text' id="start_date" name="start_date" class="form-control" value="{!! App\Helpers\Hazater::formatDate($advertise->start_date) !!}" readonly>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row mt-2 mb-2">
                <div class="col">
                    @if (count($midpoints) > 0)
                        <label for="midpoints">Köztes megállóhelyek</label>
                    @endif
                    <table id="midpoints" class="col-12"><tr><th width="100%"></th></tr></table>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-8">
                    <label for="end_city">{{ __('dashboard.driver.submit-ad.Target Place') }}</label>
                    <input class="form-control" id="end_city" name="end_city" type="text" value="{!! $advertise->end_city_label !!}" readonly>
                </div>

                <div class="col-md-4">
                    <label for="end_date">{{ __('dashboard.driver.submit-ad.Target Date') }}</label>
                    <div class='input-group'>
                        <input type='text' id="end_date" name="end_date" class="form-control" value="{!! App\Helpers\Hazater::formatDate($advertise->end_date) !!}" readonly>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row mt-2 mb-2">
                <div class="col">
                    {{ html()->checkbox('retour', $advertise->retour, 1)->disabled() }} Oda-vissza út
                </div>
            </div>

            <div class="form-row mt-2 mb-2">
                <div class="col">
                    <label for="description">Megjegyzés</label><em>&nbsp;(pl. egyéb fontos információk, indulási helyszín)</em>
                    {{ html()->textarea('description', $advertise->description)->class("form-control")->attribute('readonly', 'readonly')->style('resize:none;') }}
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-lg-6">
            Ajánlott útvonal<span style="float:right"><input type="checkbox" id="highway" name="highway" {{$advertise->highway ? "checked" : ""}} disabled>Autópálya</span>
            <div class="panel panel-default map-panel" style="width: 100%; height: 330px" id="mapContainerShow"></div>
            <div id="route-summary"></div>
        </div>
    </div>

    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.3 Publish Ad') }}</span>

    <div class="form-row" id="radio-tab">
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="publish_options" id="publish-regular" value="regular" {{($advertise->regular?'checked':'')}} disabled>
                <label class="form-check-label" for="regular">{{ __('dashboard.driver.submit-ad.Regular Route') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="publish_options" id="publish-unique" value="unique" {{($advertise->regular?'':'checked')}} disabled>
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

            <input type="hidden" name="regular" id="regular" value="{{ $advertise->regular }}">

            <div class="form-row">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="day_0" name="day_0" disabled>
                        <label class="form-check-label" for="day_0">{{ __('dashboard.driver.submit-ad.All Days') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="day_1" name="day_1" disabled>
                        <label class="form-check-label" for="day_1">{{ __('dashboard.driver.submit-ad.Monday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="day_2" name="day_2" disabled>
                        <label class="form-check-label" for="day_2">{{ __('dashboard.driver.submit-ad.Tuesday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="day_3" name="day_3" disabled>
                        <label class="form-check-label" for="day_3">{{ __('dashboard.driver.submit-ad.Wednesday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="day_4" name="day_4" disabled>
                        <label class="form-check-label" for="day_4">{{ __('dashboard.driver.submit-ad.Thursday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="day_5" name="day_5" disabled>
                        <label class="form-check-label" for="day_5">{{ __('dashboard.driver.submit-ad.Friday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="day_6" name="day_6" disabled>
                        <label class="form-check-label" for="day_6">{{ __('dashboard.driver.submit-ad.Saturday') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="day_7" name="day_7" disabled>
                        <label class="form-check-label" for="day_7">{{ __('dashboard.driver.submit-ad.Sunday') }}</label>
                    </div>
                </div>
            </div>

        </div>
        <div id="unique-tab" class="tab-pane fade">
            <div class="form-row">
                <div class="col-md-2">
                    <table id="dates" class="col-12">
                        <tr><th width="100%"></th><th></th></tr>
                        @foreach($dates as $date)
                        <tr>
                            <td><input class="form-control mb-2" type="text" value="{{ \App\Helpers\Hazater::formatDate2($date->date) }}" readonly></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user() && (Auth::user()->id == $advertise->user->id))
        <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.4 Passangers') }}</span>

        <div class="form-row">
            <div class="col">
                @if($passangers->count() > 0)
                <div class="table-responsive">
                    <table class="table" id="passangersTable">
                        <thead>
                            <tr>
                                <th class="col-hidden">id</th>
                                <th>Utas</th>
                                <th>Telefonszám</th>
                                <th>Email</th>
                                {{-- <th class="action_buttons">@lang('labels.general.actions')</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($passangers as $data)
                                <tr class="table-row">
                                    <td class="col-hidden">{{ $data->id }}</td>
                                    <td>{!! $data->user_name_label !!}</td>
                                    <td>{!! $data->user_phone_label !!}</td>
                                    <td>{!! $data->user_email_label !!}</td>
                                    {{-- <td>{!! $data->action_buttons !!}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <em>Még nem jelentkeztek erre a hirdetésre.</em>
                @endif
            </div>
        </div>
    @endif

    <div class="col">
        <div class="form-group row mt-4">
            <label for="price" class="col-form-label mr-2">Úti költség</label>
            <input type="number" class="form-control mr-2 col-md-1" id="price" name="price" value="{{$advertise->price}}" readonly>
            <span class="col-form-label">Ft/fő</span>
        </div>
    </div>
    <div class="col">
        <div class="form-group row mt-4">
            <label for="hours" class="col-form-label mr-2">Út lemondása</label>
            <input type="number" class="form-control mr-2 col-md-1" id="hours" name="hours" value="{{$advertise->hours}}" readonly>
            <span class="col-form-label mr-3">óra</span>
            <em class="col-form-label">(Megadhatja, hogy az utas az indulás előtt mennyivel mondhatja még le az utat.)</em>
        </div>
    </div>
</div>

@push('after-scripts')
<script type="text/javascript">

console.log("advertise-show-1");

var regular_options = "{{ $regular_options }}";
console.log(regular_options);
if (regular_options == "unique") {
    $('#unique-tab').addClass('active show');
    $('#regular-tab').removeClass('active show');
}

function initDays() {
    console.log("initDays");
    var days = $("#regular").val();
    if (days) {
        if (days == 0) {
            $('#day_0:checkbox').prop('checked', true);
        } else {
            for (var i = 0; i < 7; i++) {
                $('#day_'+(i+1)+':checkbox').prop('checked', days & Math.pow(2, i));
            }
        }
    } else {
        console.log("days: null");
    }
}
function calcDays() {
    var days = 0;
    for (var i = 0; i < 8; i++) {
        if($('#day_'+i+':checkbox').is(":checked")) {
            days += Math.pow(2, i);
        }
    }
    $("#regular").val(days);
    //console.log(days);
}
function checkBoxDaysChanged() {
    var flag = ($("[id^=day]:checked").length > 0);
    $('#day_0:checkbox').attr('disabled', flag);
    calcDays();
}
$('#day_0:checkbox').change(function (e) {
    const flag = e.currentTarget.checked;
    for (var i = 1; i < 8; i++) {
        $('#day_'+i+':checkbox').attr('disabled', flag);
    }
    calcDays();
});
$('#day_1:checkbox').change(function (e) {
    checkBoxDaysChanged();
});
$('#day_2:checkbox').change(function (e) {
    checkBoxDaysChanged();
});
$('#day_3:checkbox').change(function (e) {
    checkBoxDaysChanged();
});
$('#day_4:checkbox').change(function (e) {
    checkBoxDaysChanged();
});
$('#day_5:checkbox').change(function (e) {
    checkBoxDaysChanged();
});
$('#day_6:checkbox').change(function (e) {
    checkBoxDaysChanged();
});
$('#day_7:checkbox').change(function (e) {
    checkBoxDaysChanged();
});
$(function() {
    initDays();
});

function makeMidpointTableRow(id, name) {
    return '<tr id="midpoint-'+id+'">'
        +'<td><input type="hidden" name="midpoints[]" value="'+id+'">'
        +'<input class="form-control mb-2 col-8" type="text" name="midpointnames[]" value="'+name+'" readonly></td>'
        +'</tr>';
}

var midPoints = [];
@foreach($midpoints as $midpoint)
    midPoints.push({
        id: {{$midpoint->city_id}},
        name: "{{$midpoint->city->name}}",
        x: {{$midpoint->city->y}},
        y: {{$midpoint->city->x}},
    });
    $('#midpoints').append(makeMidpointTableRow({{$midpoint->city_id}}, "{{$midpoint->city->name}}"));
@endforeach

var mapAdvertiseShow = makeMap('mapContainerShow', mapInitCenter);

var x1 = {{ $advertise->startCity->y ?? "null" }};
var y1 = {{ $advertise->startCity->x ?? "null" }};
var x2 = {{ $advertise->endCity->y ?? "null" }};
var y2 = {{ $advertise->endCity->x ?? "null" }};

calcRoute(mapAdvertiseShow, x1, y1, x2, y2, midPoints, $('#route-summary'), $("#highway").is(':checked'));

console.log("advertise-show-2");

</script>
@endpush
