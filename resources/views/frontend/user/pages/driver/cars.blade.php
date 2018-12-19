<div class="row mt-4">
    <div class="col">
        <div class="table-responsive">
            <table class="table" id="carsTable">
                <thead>
                    <tr>
                        <th class="col-hidden">id</th>
                        <th>Rendszám</th>
                        <th>Gyártnány</th>
                        <th>Típus</th>
                        <th>Szabad ülések száma</th>
                        <th class="action_buttons">@lang('labels.general.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $data)
                    <tr class="table-row">
                        <td class="col-hidden">{{ $data->id }}</td>
                        <td>{{ $data->license }}</td>
                        <td>{{ $data->brand }}</td>
                        <td>{{ $data->type }}</td>
                        <td>{{ $data->seats }}</td>
                        <td>{!! $data->my_action_buttons !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!--col-->
</div><!--row-->

<div class="form-row">
    <div class="col text-center mt-3">
        <a class="btn btn-info" data-toggle="tooltip" title="Új gépjármű felvitele" id="car-add" href="{{route('frontend.datasets.car.create')}}">
            <i class="fas fa-plus-circle mr-1"></i>Új gépjármű felvitele
        </a>
    </div>
</div>

@push('after-scripts')
<script>
console.log("cars-1");

// function prepareHtmlCar(data, readonly = '') {
//     var html =  '<form><input id="car-id" type="hidden" value="'+data.id+'">';
//     html +=     '<input id="car-user_id" type="hidden" value="'+data.user_id+'">';
//     html +=     '<label for="car-license" class="swal-label">Gépjármű rendszám</label>' +
//                 '<input id="car-license" class="swal-input" value="'+data.license+'" '+readonly+' required>';
//     html +=     '<label for="car-brand" class="swal-label">Gyártmány</label>' +
//                 '<input id="car-brand" class="swal-input" value="'+data.brand+'" '+readonly+' required>';
//     html +=     '<label for="car-type" class="swal-label">Típus</label>' +
//                 '<input id="car-type" class="swal-input" value="'+data.type+'" '+readonly+' required>';
//     html +=     '<label for="car-color" class="swal-label">Szín</label>' +
//                 '<input id="car-color" class="swal-input" value="'+data.color+'" '+readonly+' required>';
//     html +=     '<label for="car-year" class="swal-label">Évjárat</label>' +
//                 '<input id="car-year" class="swal-input" value="'+data.year+'" '+readonly+' required>';
//     html +=     '<label for="car-seats" class="swal-label">Szabad ülések száma</label>' +
//                 '<input id="car-seats" class="swal-input" value="'+data.seats+'" '+readonly+' required>';
//     html +=     '<label for="car-image" class="swal-label">Kép feltöltés</label>' +
//                 '<input id="car-image" class="swal-input" value="'+data.image+'" '+readonly+'>';

//     if (readonly !== '') {
//         readonly = 'disabled';
//     }

//     html +=     '<div class="checkbox text-left"><label><input id="car-smoke" type="checkbox" '+readonly+' '+(data.smoke?'checked':'')+'>Dohányzó</label></div>';
//     html +=     '<div class="checkbox text-left"><label><input id="car-cooler" type="checkbox" '+readonly+' '+(data.cooler?'checked':'')+'>Klíma van</label></div>';
//     html +=     '<div class="checkbox text-left"><label><input id="car-pet" type="checkbox" '+readonly+' '+(data.pet?'checked':'')+'>Kisállat szállítás</label></div>';
//     html +=     '<div class="checkbox text-left"><label><input id="car-bag" type="checkbox" '+readonly+' '+(data.bag?'checked':'')+'>Csomag szállítás</label></div>';

//     return html+"</from>";
// }

// function storeDataCar(param) {
//     console.log(param);
//     $.ajax({
//         url: "/car/set",
//         type: "POST",
//         data: {
//             '_token': '{{ csrf_token() }}',
//             'data': {
//                 id: param.value[0],
//                 user_id: param.value[1],
//                 license: param.value[2],
//                 brand: param.value[3],
//                 type: param.value[4],
//                 color: param.value[5],
//                 year: param.value[6],
//                 seats: param.value[7],
//                 image: param.value[8],
//                 smoke: param.value[9],
//                 cooler: param.value[10],
//                 pet: param.value[11],
//                 bag: param.value[12],
//             }
//         },
//         success: function(response) {
//             console.log(response);
//             //showSuccess("Az adatok rögzítése sikerült!");
//             location.reload();
//         },
//         error: function (error) {
//             showError(error.responseText);
//         }
//     });
// }

// function formEditCar(result, title) {
//     swal({
//         title: title,
//         html: prepareHtmlCar(result, ''),
//         showCancelButton: true,
//         focusConfirm: false,
//         inputValidator: (value) => {
//             console.log(value);
//             return fale;
//         },
//         preConfirm: () => { return [
//             document.getElementById('car-id').value,
//             document.getElementById('car-user_id').value,
//             document.getElementById('car-license').value,
//             document.getElementById('car-brand').value,
//             document.getElementById('car-type').value,
//             document.getElementById('car-color').value,
//             document.getElementById('car-year').value,
//             document.getElementById('car-seats').value,
//             document.getElementById('car-image').value,
//             document.getElementById('car-smoke').checked ? 1 : 0,
//             document.getElementById('car-cooler').checked ? 1 : 0,
//             document.getElementById('car-pet').checked ? 1 : 0,
//             document.getElementById('car-bag').checked ? 1 : 0,
//         ]},
//     }).then((res)=>{
//         storeDataCar(res);
//     });
// }

// $("#car-show")
// $('[id^=car-show-]').on('click', function(e) {
//     $.ajax({url: "/car/get/" + $(this).data("key"), success: function(response) {
//         console.log(response);
//         swal({ title: "Jármű megtekintése", html: prepareHtmlCar(response, "readonly") });
//     }});
// });

// $('[id^=car-edit-]').on('click', function(e) {
//     $.ajax({url: "/car/get/" + $(this).data("key"), success: function(response) {
//         formEditCar(response, "Jármű szerkesztése");
//     }});
// });
/*
$("#car-add").on('click', function(e) {
    formEditCar({
        user_id: {{ Auth::user()->id }},
        license: '',
        brand: '',
        type: '',
        color: '',
        year: '',
        seats: '',
        image: '',
        smoke: '',
        cooler: '',
        pet: '',
        bag: '',
    }, "Jármű küldése");
});*/

console.log("cars-2");
</script>
@endpush
