@push('after-styles')
    <style>
        .mylink {
            color: blue;
            cursor: pointer;
        }
        .mylink:hover {
            text-decoration: underline;
        }
        .date-error {
            border-color: red;
        }
        .startDate .error-text {
            visibility: hidden;
            /*width: 200px;*/
            background-color: #f27474;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            top: 22px;
            /*left: 105%;*/
        }
        .startDate .error-text::after {
            content: "";
            position: relative;
            top: 50%;
            right: 100%;
            margin-top: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent #f27474 transparent transparent;
        }
    </style>
@endpush

<span class="d-block p-2 bg-group text-black mt-3 mb-3">{{ __('dashboard.driver.submit-ad.1 Car Datas') }}</span>

<!-- FREE_SEATS -->
<div class="form-row">
    <div class="col-xs-12 col-md-3">
        <label for="car_id">{{ __('dashboard.driver.submit-ad.License Number') }}</label>
        <input type="hidden" id="car_id" name="car_id" value="{{$advertise->car_id ?? $advertise->user->cars[0]->id}}">
        <select class="form-control" id="car" name="car" placeholder="{{ __('dashboard.driver.submit-ad.License Number') }}" required>
            @foreach($advertise->user->cars as $car)
                <option value="{{ $car->id }}" {{$advertise->car_id==$car->id?'selected':''}}>{{ $car->license }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-xs-12 col-md-3">
        <label for="free_seats">{{ __('dashboard.driver.submit-ad.Free Seats') }}</label>
        <select class="form-control" id="free_seats" name="free_seats" placeholder="{{ __('dashboard.driver.submit-ad.Free Seats') }}" required>
            @for($i = $advertise->user->cars[0]->seats; $i >= 0 ; $i--)
                <option {{ isset($advertise->free_seats) ? ($advertise->free_seats == $i ? 'selected' : '') : ($i == $advertise->user->cars[0]->seats ? 'selected' : '') }}>{{$i}}</option>
            @endfor
        </select>
    </div>
</div>

<span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.2 Route, Date') }}</span>
<div class="row">
    <div class="col-xs-12 col-lg-6">

        <!-- START -->
        <div class="form-row">
            <div class="col-md-8">
                <label for="start_city">{{ __('dashboard.driver.submit-ad.Start Place') }}</label>
                <input type="hidden" id="start_city_id" name="start_city_id" value="{{$advertise->start_city_id}}">
                <input class="form-control typeahead typeahead-start-city" id="start_city" name="start_city" value="{{$advertise->start_city_label}}" placeholder="{{ __('dashboard.driver.submit-ad.Start Place') }}" type="text" autocomplete="off" required>
            </div>

            <div class="col-md-4">
                <label for="start_date">{{ __('dashboard.driver.submit-ad.Start Date') }}</label>
                <div class='startDate'>
                    <input type='text' id="start_date" name="start_date" class="form-control date" autocomplete="off" value="{{\App\Helpers\Hazater::formatDate($advertise->start_date)}}" required/>
                    <span id="start-date-error" class="error-text">@lang("alerts.backend.advertise.dates-error")</span>
                    <!-- <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span> -->
                </div>
            </div>
        </div>

        <!-- MIDPOINTS -->
        <div class="form-row mt-2 mb-2">
            <div class="col">
                <table id="midpoints" class="col-12"><tr><th width="100%"></th><th></th></tr></table>
                <a id="koztes-hely" class="disabled-link" href="#">{{ __('dashboard.driver.submit-ad.Add Midpoint') }}</a>
            </div>
        </div>

        <!-- END -->
        <div class="form-row">
            <div class="col-md-8">
                <label for="end_city">{{ __('dashboard.driver.submit-ad.Target Place') }}</label>
                <input type="hidden" id="end_city_id" name="end_city_id" value="{{$advertise->end_city_id}}">
                <input class="form-control typeahead typeahead-end-city" id="end_city" name="end_city" value="{{$advertise->end_city_label}}" placeholder="{{ __('dashboard.driver.submit-ad.Target Place') }}" type="text" autocomplete="off" required>
            </div>

            <div class="col-md-4">
                <label for="end_date">{{ __('dashboard.driver.submit-ad.Target Date') }}</label>
                <div class='input-group'>
                    <input type='text' id="end_date" name="end_date" class="form-control date" autocomplete="off" value="{{\App\Helpers\Hazater::formatDate($advertise->end_date)}}" required/>
                    <!-- <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span> -->
                </div>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="form-row mt-2 mb-2">
            <div class="col">
                <label for="description">Megjegyzés</label><em>&nbsp;(pl. egyéb fontos információk, indulási helyszín)</em>
                {{ html()->textarea('description',$advertise->description)->class("form-control") }}
            </div>
        </div>

        <!-- HIGHWAY -->
        <div class="form-row mt-2 mb-2">
            <div class="col">
                <input type="checkbox" id="highway" name="highway" {{$advertise->highway ? "checked" : ""}}>
                <label for="highway">Autópályán megyek</label>
            </div>
        </div>

    </div>

    <!-- MAP -->
    <div class="col-xs-12 col-lg-6">
        Ajánlott útvonal
        <div class="panel panel-default map-panel" id="mapContainerForm" name="mapContainerForm" style="width: 100%; height: 314px;"></div>
        <div id="route-summary"></div>
    </div>

</div>

<span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.3 Others') }}</span>
<div class="form-col"> <!-- PRICE -->
    <div class="form-group form-row mt-1">
        <label for="price" class="col-form-label col-md-2 mr-2">Úti költség</label>
        <input id="price" name="price" type="number" class="form-control mr-2 col-md-1" min="0" value="{{$advertise->price}}">
        <span class="col-form-label">Ft/fő</span>
    </div>
</div>

<div class="form-col"><!-- HOURS -->
    <div class="form-group form-row mt-1">
        <label for="hours" class="col-form-label col-md-2 mr-2">Út lemondása</label>
        <input id="hours" name="hours" type="number" class="form-control mr-2 col-md-1" min="0" value="{{$advertise->hours}}">
        <span class="col-form-label mr-3">óra</span>
        <em class="col-form-label">(Megadhatja, hogy az utas az indulás előtt mennyivel mondhatja még le az utat.)</em>
    </div>
</div>

@if(Auth::user() && (Auth::user()->id == $advertise->user->id))
    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.driver.submit-ad.4 Passangers') }}</span>

    <div class="form-row">
        <div class="col">
            @php
                $results = \App\Models\Reserve::where('advertise_id', $advertise->id)->orderBy('id')->get()
            @endphp
            @if($results->count() > 0)
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
                        @foreach($results as $data)
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

@push('after-scripts')
<script type="text/javascript">

console.log("advertise-form-1");

var cars = {!! $advertise->user->cars !!};
var x1 = {{ $advertise->startCity->y ?? "null" }};
var y1 = {{ $advertise->startCity->x ?? "null" }};
var x2 = {{ $advertise->endCity->y ?? "null" }};
var y2 = {{ $advertise->endCity->x ?? "null" }};
var midPoints = [];
var dates = [];

function setCityAutocomplete(control, city, city_id) {
    control.typeahead({
        source: function (query, process) {
            return $.get("{{ route('frontend.search.city') }}", {
                query: query
            }, function (data) {
                return process(data);
            }).fail(function (error) {
                console.log(error)
            });
        }
    });
    city.on('change', function (e) {
        $.get("{{ route('frontend.city.query') }}", {
            name: city.val()
        }, function (data) {
            //console.log(data);
            if (data.length > 0) {
                city_id.attr('value', data[0].id);
            }
        }).fail(function (error) {
            console.log(error)
        });
    });
}

$('#publish-regular').click(function(){
    $('#unique-tab').removeClass("active show");
    $('#regular-tab').addClass("active show");
});
$('#publish-unique').click(function(){
    $('#regular-tab').removeClass("active show");
    $('#unique-tab').addClass("active show");
});
$('#save-template').click(function(){
    if($(this).is(':checked')) {
        $('#sablon-save').prop('disabled', false);
    } else {
        $('#sablon-save').prop('disabled', true);
    }
});

function getCar(id) {
    for (var i = 0; i < cars.length; i++) {
        var car = cars[i];
        if (car.id == id) {
            return car;
        }
    }
    return 0;
}
function makeNumList(cnt) {
    var arr = [];
    for (var i = 1; i <= cnt; i++) {
        arr[i] = '<option value="'+i+'">'+i+'</option>';
    }
    return arr.reverse();
}
$('#car').on('change', function(e) {
    var id = $('#car').val();
    $('#car_id').attr('value', id);
    var car = getCar(id);
    if (car) {
        $("#free_seats").empty().append(makeNumList(car.seats));
    }
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

$('#start_city').on('change', function(e) {
    console.log("startCityChange");
    var startCity = $('#start_city').val();
    console.log(startCity);
    $.get("{{ route('frontend.city.query') }}", {name: startCity}, function (data) {
        console.log(data);
        if (data.length > 0) {
            startCity = data[0];
            $('#start_city_id').attr('value', startCity.id);
            x1 = startCity.y;
            y1 = startCity.x;
        } else {
            $('#start_city_id').attr('value', undefined);
            x1 = undefined;
            y1 = undefined;
        }
        callRouteCalculation();
        validateAdvertiseForm();
    }).fail(function (error){console.log(error)});
});
$('#end_city').on('change', function(e) {
    var endCity = $('#end_city').val();
    $.get("{{ route('frontend.city.query') }}", {name: endCity}, function (data) {
        if (data.length > 0) {
            endCity = data[0];
            $('#end_city_id').attr('value', endCity.id);
            x2 = endCity.y;
            y2 = endCity.x;
        } else {
            $('#end_city_id').attr('value', null);
            x2 = undefined;
            y2 = undefined;
        }
        callRouteCalculation();
        validateAdvertiseForm();
    }).fail(function (error){console.log(error)});
});

function deleteMidpoint(id) {
    console.log("deleteMidPoint");
    //console.log($("#midpoint-"+id));
    $("#midpoint-"+id).remove();
    for (var i = 0; i < midPoints.length; i++) {
        var mp = midPoints[i];
        if (mp.id == id) {
            midPoints.splice(i, 1);
            callRouteCalculation();
            return;
        }
    }
}
function makeMidpointTableRow(id, name) {
    return '<tr id="midpoint-'+id+'">'
        +'<td><input type="hidden" name="midpoints[]" value="'+id+'">'
        +'<input class="form-control mb-2" type="text" name="midpointnames[]" value="'+name+'" readonly></td>'
        +'<td><a class="btn btn-outline-danger ml-2 mb-2" onclick="deleteMidpoint('+id+')">Törlés</a></td>'
        +'</tr>';
}
function addMidPointByName(name) {
    $.get("{{ route('frontend.city.query') }}", {name: name}, function (data) {
        if (data.length > 0) {
            //console.log(data[0]);
            midPoints.push({
                id: data[0].id,
                name: data[0].name,
                x: data[0].y,
                y: data[0].x,
            });
            $('#midpoints').append(makeMidpointTableRow(data[0].id, data[0].name));
            callRouteCalculation();
        } else {
            showError("Nem található a megadott település: " + name);
        }
    }).fail(function (error){console.log(error)});
}
$('#koztes-hely').on('click', function() {
    console.log('Köztes megálló hozzáadása...');
    if (x1 && y1 && x2 && y2) {
        swal({
            title: 'Köztes megálló hozzáadása',
            html: '<input type="hidden" id="midpoint_id"><input id="midpoint" class="typeahead typeahead-mid-city form-control" placeholder="Válasszon települést...">',
            onOpen: () => {
                setCityAutocomplete($(".typeahead-mid-city"), $("#midpoint"), $("#midpoint_id"));
            },
            focusConfirm: false,
            preConfirm: () => {
                //var id = document.getElementById('midpoint_id').value;
                var name = document.getElementById('midpoint').value;
                if (name) {
                    return name;
                }
                swal.showValidationMessage(`Adjon meg egy települést!`);
            }
        }).then((res)=>{
            if (res.value) {
                addMidPointByName(res.value);
            }
        });
    } else {
        swal({
            type: 'info',
            title: 'Köztes megálló hozzáadása előtt jelölje ki, hogy honnan, hova szeretne eljutni!',
        });
    }
});

// function getTemplate(id) {
//     for (var i = 0; i < templates.length; i++) {
//         var template = templates[i];
//         if (template.id == id) {
//             return template;
//         }
//     }
//     return null;
// }

// function initDays() {
//     //console.log("initDays");
//     var days = $("#regular").val();
//     if (days) {
//         if (days == 0) {
//             $('#day_0:checkbox').prop('checked', true);
//             for (var i = 1; i < 8; i++) {
//                 $('#day_'+i+':checkbox').attr('disabled', true);
//             }
//         } else {
//             for (var i = 0; i < 7; i++) {
//                 $('#day_'+(i+1)+':checkbox').prop('checked', days & Math.pow(2, i));
//             }
//             checkBoxDaysChanged();
//         }
//     } else {
//         //console.log("days: null");
//     }
//     checkButtons(days);
// }
// function checkButtons(days = null) {
//     var cnt = 0;
//     if ($('#publish-regular').is(":checked")) {
//         for (var i = 0; i < 8; i++) {
//             if ($('#day_'+i+':checkbox').is(":checked")) {
//                 cnt++;
//             }
//         }
//     } else {
//         cnt = 1;
//     }

//     if (cnt > 0) {
//         //console.log("enabled");
//         $('#advertise-create').removeAttr("disabled");
//         $('#advertise-update').removeAttr("disabled");
//     } else {
//         //console.log("disabled");
//         $('#advertise-create').prop("disabled", true);
//         $('#advertise-update').prop("disabled", true);
//     }
// }
// $('#publish-regular').change(function (e) {
//     checkButtons();
// });
// $('#publish-unique').change(function (e) {
//     checkButtons();
// });
// function calcDays() {
//     var days = 0;
//     for (var i = 0; i < 7; i++) {
//         if ($('#day_'+(i+1)+':checkbox').is(":checked")) {
//             days += Math.pow(2, i);
//             //console.log(days);
//         }
//     }
//     $("#regular").val(days);
//     //console.log($("#regular").val());
//     checkButtons(days);
// }
// function checkBoxDaysChanged() {
//     var flag = ($("[id^=day]:checked").length > 0);
//     $('#day_0:checkbox').attr('disabled', flag);
//     calcDays();
// }
// $('#day_0:checkbox').change(function (e) {
//     const flag = e.currentTarget.checked;
//     for (var i = 1; i < 8; i++) {
//         $('#day_'+i+':checkbox').attr('disabled', flag);
//     }
//     calcDays();
// });
// $('#day_1:checkbox').change(function (e) {
//     checkBoxDaysChanged();
// });
// $('#day_2:checkbox').change(function (e) {
//     checkBoxDaysChanged();
// });
// $('#day_3:checkbox').change(function (e) {
//     checkBoxDaysChanged();
// });
// $('#day_4:checkbox').change(function (e) {
//     checkBoxDaysChanged();
// });
// $('#day_5:checkbox').change(function (e) {
//     checkBoxDaysChanged();
// });
// $('#day_6:checkbox').change(function (e) {
//     checkBoxDaysChanged();
// });
// $('#day_7:checkbox').change(function (e) {
//     checkBoxDaysChanged();
// });

var mapAdvertiseForm = makeMap('mapContainerForm', mapInitCenter);
window.addEventListener('resize', function () {
    mapAdvertiseForm.getViewPort().resize();
});
@foreach($midpoints as $midpoint)
    midPoints.push({
        id: {{$midpoint->city_id}},
        name: "{{$midpoint->city->name}}",
        x: {{$midpoint->city->y}},
        y: {{$midpoint->city->x}},
    });
    $('#midpoints').append(makeMidpointTableRow({{$midpoint->city_id}}, "{{$midpoint->city->name}}"));
@endforeach

function deleteDate(id) {
    console.log("deleteDate " + id);
    $("#dates-"+id).remove();
    for (var i = 0; i < dates.length; i++) {
        var d = dates[i];
        if (d.id == id) {
            dates.splice(i, 1);
            return;
        }
    }
}
function makeDateTableRow(id, date) {
    return '<tr id="dates-'+id+'">'
        +'<td><input class="form-control mb-2" type="text" name="dates[]" value="'+date+'" readonly></td>'
        +'<td><a class="btn btn-outline-danger ml-2 mb-2" onclick="deleteDate('+id+')">Törlés</a></td>'
        +'</tr>';
}
var hiddenDate = $("#hidden-date").bootstrapMaterialDatePicker({
    format: 'YYYY.MM.DD HH:mm',
    lang: 'hu',
    weekStart: 1,
    cancelText: 'Mégsem',
    minDate: dateToday,
    //switchOnClick: true,
    time: false,
}).on('change', function(e, d) {
    //console.log(d);
    var date = new Date(d);
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    // var hour = date.getHours();
    // var min = date.getMinutes();
    date = year + "." + month + "." + day;
    var id = dates.length;
    dates.push({
        id: id,
        date: date,
    });
    $('#dates').append(makeDateTableRow(id, date));
});

function callRouteCalculation() {
    console.log("callRouteCalculation");
    calcRoute(mapAdvertiseForm, x1, y1, x2, y2, midPoints, $('#route-summary'), $("#highway").is(':checked'), function(summary) {
        var date1 = $('#start_date').val();
        var date2 = moment(date1.split('.').join('-')).add(summary.travelTime, 'seconds').toDate();
        $('#end_date').val(formattedDate(date2));
        checkDates();
    });
    var startCity = $('#start_city_id').attr('value');
    var endCity = $('#end_city_id').attr('value');
    if (startCity && endCity) {
        $("#koztes-hely").removeClass("disabled-link");
    } else {
        $("#koztes-hely").addClass("disabled-link");
    }
}
$('#highway:checkbox').change(function (e) {
    callRouteCalculation();
});

callRouteCalculation();

//var start_date;
$('#start_date').on('change', function(e) {
    var date1 = $('#start_date').val();
    $('#end_date').bootstrapMaterialDatePicker('setMinDate', date1);
    checkDates();
});
$('#end_date').on('change', function(e) {
    var date2 = $('#end_date').val();
    $('#start_date').bootstrapMaterialDatePicker('setMaxDate', date2);
    checkDates();
});

function initDates() {
    var date1 = $('#start_date').val();
    var date2 = $('#end_date').val();
    if (date2 <= date1) {
        //$('#end_date').val(formattedDate(new Date(date1).addMinutes(1)));
        var d1 = moment(date1.split('.').join('-')).add(1, 'minutes').toDate();
        //console.log(d1);
        $('#end_date').val(formattedDate(d1));
    }
}
function checkDates() {
    $('#start_date').removeClass("date-error");
    $('#start-date-error').css('visibility', 'hidden');
    var date1 = $('#start_date').val();
    var date2 = $('#end_date').val();
    if (date2 <= date1) {
        $('#start_date').addClass("date-error");
        $('#start-date-error').css('visibility', 'visible');
        return false;
    }
    return true;
}

function checkStartEnd() {
    $('button[type="submit"]').prop("disabled", true);
    var startCity = $('#start_city_id').val();
    //console.log(startCity);
    var endCity = $('#end_city_id').val();
    //console.log(endCity);
    if (startCity && endCity) {
        $('button[type="submit"]').removeAttr("disabled");
    }
}

function validateAdvertiseForm() {
    console.log("validate form ");
    checkStartEnd();
    var ret = checkDates();
    setTimeout(function() {
        //$('button[type="submit"]').removeAttr('disabled');
    }, 1000);
    return ret;
}

$(function() {
    // $('#start_date').val("{{ \App\Helpers\Hazater::formatDate($advertise->start_date) }}");
    // $('#end_date').val("{{ \App\Helpers\Hazater::formatDate($advertise->end_date) }}");
    //initDays();
    initDates();
    checkDates();
    validateAdvertiseForm();
});

console.log("advertise-form-2");

</script>
@endpush
