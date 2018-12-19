{{ html()->hidden('user_id', Auth::user()->id) }}
{{ html()->hidden('active', 0) }}

<div class="form-row mb-3">
    <div class="col-6">
        <label for="start_city">{{ __('labels.backend.datasets.hunter.form.start_city_id') }}</label>
        <input type="hidden" id="start_city_id" name="start_city_id" value="{{$hunter->start_city_id}}">
        <input class="form-control typeahead typeahead-start-city" id="start_city" name="start_city" value="{{$hunter->start_city_label}}" placeholder="{{ __('dashboard.driver.submit-ad.Start Place') }}" type="text" autocomplete="off" required>
    </div>
</div>

<div class="form-row mb-3">
    <div class="col-6">
        <label for="end_city">{{ __('labels.backend.datasets.hunter.form.end_city_id') }}</label>
        <input type="hidden" id="end_city_id" name="end_city_id" value="{{$hunter->end_city_id}}">
        <input class="form-control typeahead typeahead-end-city" id="end_city" name="end_city" value="{{$hunter->end_city_label}}" placeholder="{{ __('dashboard.driver.submit-ad.Target Place') }}" type="text" autocomplete="off" required>
    </div>
</div>

<div class="form-row mb-3">
    <div class="col-12">
        <label for="days">{{ __('labels.backend.datasets.hunter.form.days') }}</label>
        <input type="hidden" id="days" name="days" value="{{ $hunter->days }}" required>
        <br>
        <div>
        <input id="day_0" name="day_0" type="checkbox"><label class="checkbox-inline ml-1 mr-3">@lang('dashboard.driver.submit-ad.All Days')   </label>
        <input id="day_1" name="day_1" type="checkbox"><label class="checkbox-inline ml-1 mr-3">@lang('dashboard.driver.submit-ad.Monday')     </label>
        <input id="day_2" name="day_2" type="checkbox"><label class="checkbox-inline ml-1 mr-3">@lang('dashboard.driver.submit-ad.Tuesday')    </label>
        <input id="day_3" name="day_3" type="checkbox"><label class="checkbox-inline ml-1 mr-3">@lang('dashboard.driver.submit-ad.Wednesday')  </label>
        <input id="day_4" name="day_4" type="checkbox"><label class="checkbox-inline ml-1 mr-3">@lang('dashboard.driver.submit-ad.Thursday')   </label>
        <input id="day_5" name="day_5" type="checkbox"><label class="checkbox-inline ml-1 mr-3">@lang('dashboard.driver.submit-ad.Friday')     </label>
        <input id="day_6" name="day_6" type="checkbox"><label class="checkbox-inline ml-1 mr-3">@lang('dashboard.driver.submit-ad.Saturday')   </label>
        <input id="day_7" name="day_7" type="checkbox"><label class="checkbox-inline ml-1 mr-3">@lang('dashboard.driver.submit-ad.Sunday')     </label>
        </div>
    </div>
</div>

@push('after-scripts')
<script type="text/javascript">
console.log("hunter-1");

function setCityAutocomplete(control, city, city_id) {
    //console.log(control);
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

setCityAutocomplete($('.typeahead-start-city'), $('#start-city'), $('#start_city_id'));
setCityAutocomplete($('.typeahead-end-city'), $('#end-city'), $('#end_city_id'));

$(function() {
    initDays();
});

function initDays() {
    //console.log("initDays");
    var days = $("#days").val();
    //console.log(days);
    for (var i = 0; i < 8; i++) {
        $('#day_'+i+':checkbox').prop('checked', days & Math.pow(2, i));
    }
}
function calcDays() {
    var days = 0;
    for (var i = 0; i < 8; i++) {
        if($('#day_'+i+':checkbox').is(":checked")) {
            days += Math.pow(2, i);
        }
    }
    $("#days").val(days);
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

console.log("hunter-2");
</script>
@endpush
