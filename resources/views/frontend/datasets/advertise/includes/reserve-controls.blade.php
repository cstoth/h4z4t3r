<div class="row">
    <div class="col-xs-12 col-md-6">
        <span class="d-block p-2 bg-group text-black mt-3 mb-3">Sofőr adatai</span>
        <div class="form-row">
            <div class="col-md-6 justify-content-center align-items-center text-center">
                <a href="#" alt="Sofőr felhasználói adatai">
                    <img src="{{ $advertise->user->picture }}" class="user-profile-image"/>
                </a>
            </div>
            <div class="col-md-6">
                <label for="user_name">{{ __('labels.frontend.user.profile.name') }}</label>
                <input type="text" id="user_name" name="user_name" value="{!!$advertise->user->full_name!!}" class="form-control" readonly>
                @guest
                <a href="{{route('frontend.auth.login')}}"><label for="" class="please-login mt-2">További információk megtekintéséhez jelentkezzen be a rendszerbe!</label></a>
                @else
                <label for="user_phone">{{ __('validation.attributes.frontend.phone') }}</label>
                <input type="text" id="user_phone" name="user_phone" value="{!!$advertise->user->phone!!}" class="form-control" readonly>
                <label for="user_email">{{ __('labels.frontend.user.profile.email') }}</label>
                <input type="text" id="user_email" name="user_email" value="{!!$advertise->user->email!!}" class="form-control" readonly>
                @endguest
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <span class="d-block p-2 bg-group text-black mt-3 mb-3">Jármű adatai</span>

        <div class="form-row">
            <div class="col-md-6">
                <label for="car_license">{{ __('dashboard.driver.submit-ad.License Number') }}</label>
                <input type="text" id="car_license" name="car_license" value="{{$advertise->car->license}}" class="form-control" readonly>
                <label for="car_brand">{{ __('validation.attributes.backend.datasets.car.brand') }}</label>
                <input type="text" id="car_brand" name="car_brand" value="{{$advertise->car->brand}}" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label for="car_seats">{{ __('dashboard.driver.submit-ad.Free Seats') }}</label>
                <input type="number" id="car_seats" name="car_seats" value="{!!$advertise->car->seats!!}" class="form-control" readonly>
                <label for="car_type">{{ __('validation.attributes.backend.datasets.car.type') }}</label>
                <input type="text" id="car_type" name="car_type" value="{{$advertise->car->type}}" class="form-control" readonly>
            </div>
        </div>
        <div class="form-row mt-2">
            <div class="col-md-6 justify-content-center align-items-center">
                @if($advertise->car->image)
                <img src="{{ $advertise->car->picture }}" class="user-profile-image" style="max-width:200px;max-height:100px"/>
                @endif
            </div>
            <div class="col-md-6 justify-content-center align-items-center">
                @if($advertise->car->image2)
                <img src="{{ $advertise->car->picture2 }}" class="user-profile-image" style="max-width:200px;max-height:100px"/>
                @endif
            </div>
        </div>

    </div>
</div>

<span class="d-block p-2 bg-group text-black mt-3 mb-3">Út adatai</span>

<div class="form-row">

    <div class="col-md-6">
        <div class="form-row">
            <div class="col-md-8">
                <label for="start_city">{{ __('dashboard.driver.submit-ad.Start Place') }}</label>
                <input type="hidden" id="start_city_id" name="start_city_id" value="{{$advertise->start_city_id}}">
                <input class="form-control" id="start_city" name="start_city" value="{{$advertise->start_city_label}}" type="text" readonly>
            </div>
            <div class="col-md-4">
                <label for="start_date">{{ __('dashboard.driver.submit-ad.Start Date') }}</label>
                <div class='input-group'>
                    <input type='text' id="start_date" name="start_date" value="{{date('Y.m.d H:i')}}" class="form-control datum" readonly/>
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
                <input type="hidden" id="end_city_id" name="end_city_id" value="{{$advertise->end_city_id}}">
                <input class="form-control" id="end_city" name="end_city" value="{{$advertise->end_city_label}}" type="text" readonly>
            </div>

            <div class="col-md-4">
                <label for="end_date">{{ __('dashboard.driver.submit-ad.Target Date') }}</label>
                <div class='input-group'>
                    <input type='text' id="end_date" name="end_date" value="{{date('Y.m.d H:i')}}" class="form-control datum" readonly/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-row mt-2 mb-2">
            <div class="col">
                {{ html()->checkbox('retour',$advertise->retour)->disabled() }} Oda-vissza út
            </div>
        </div>

        <div class="form-row mt-2 mb-2">
            <div class="col">
                <label for="description">Megjegyzés</label><em>&nbsp;(pl. egyéb fontos információk, indulási helyszín)</em>
                {{ html()->textarea('description',$advertise->description)->attribute("readonly","readonly")->class("form-control") }}
            </div>
        </div>

    </div>

    <div class="col-xs-12 col-lg-6">
        Ajánlott útvonal<span style="float:right"><input type="checkbox" id="highway" name="highway" {{$advertise->highway ? "checked" : ""}} disabled>Autópálya</span>
        <div class="panel panel-default map-panel" style="width: 100%; height: 330px" id="mapContainerReserve"></div>
        <div id="route-summary"></div>
    </div>

</div>

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

@push('after-scripts')
<script type="text/javascript">

console.log("reserve-1");

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

var mapReserve = makeMap('mapContainerReserve', mapInitCenter);

var x1 = {{ $advertise->startCity->y ?? "null" }};
var y1 = {{ $advertise->startCity->x ?? "null" }};
var x2 = {{ $advertise->endCity->y ?? "null" }};
var y2 = {{ $advertise->endCity->x ?? "null" }};

calcRoute(mapReserve, x1, y1, x2, y2, midPoints, $('#route-summary'), $("#highway").is(':checked'));

var confirmed = false;
$(".resign-form").on('submit', function(e) {
    if (!confirmed) {
        var form = $(this);
        e.preventDefault();
        swal({
            title: "Figyelem!",
            text: "Biztosan törölni szeretné a helyfoglalását?",
            type: "question",
            showCancelButton: true,
            confirmButtonText: 'Igen, törlöm!',
            cancelButtonText: "Mégsem",
        }).then(function(result) {
            if (result.value) {
                confirmed = true;
                form.trigger('submit');
            }
        });
    }
});

console.log("reserve-2");

</script>
@endpush