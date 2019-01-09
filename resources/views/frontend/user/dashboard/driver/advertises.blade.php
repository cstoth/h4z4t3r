@push('after-styles')
    <style>
    </style>
@endpush

<div class="row mt-4">
    <div class="col">
        <div class="table-responsive">
            <table class="table" id="advertisesTable">
                <thead>
                    <tr>
                        <th class="col-hidden">id</th>
                        <th>Út adatai</th>
                        <th>Indulás-Érkezés</th>
                        <th>Szabad helyek száma</th>
                        <th class="action_buttons">@lang('labels.general.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($advertises['datas'] as $data)
                    <tr class="table-row">
                        <td class="col-hidden">{{ $data->id }}</td>
                        <td>{!! $data->from_to_label !!}</td>
                        <td>{!! $data->dates_label !!}</td>
                        <td>{!! $data->seats_label !!}</td>
                        <td>{!! $data->action_buttons !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!--col-->
</div><!--row-->

@push('after-scripts')
    <script>
        console.log("advertises-1");

// function prepareHtmlAdvertise(data, readonly = '') {
//     var html =  '<div class="col">';
//     html +=     '<input id="advertise-id" type="hidden" class="col-6" value="'+data.id+'">';
//     html +=     '<input id="advertise-user_id" type="hidden" class="col-6" value="'+data.user_id+'">';
//     html +=     '<label for="advertise-car_id" class="swal-label">Gépjármű</label>' +
//                 '<input id="advertise-car_id" class="swal-input" value="'+data.car_label+'" '+readonly+'>';
//     // html +=     '<label for="advertise-template" class="swal-label">Sablon</label>' +
//     //             '<input id="advertise-template" class="swal-input" value="'+data.template+'" '+readonly+'>';
//     html +=     '<label for="advertise-start_city_id" class="swal-label">Kezdőpont</label>' +
//                 '<input id="advertise-start_city_id" class="swal-input" value="'+data.start_city_label+'" '+readonly+'>';
//     html +=     '<label for="advertise-end_city_id" class="swal-label">Végpont</label>' +
//                 '<input id="advertise-end_city_id" class="swal-input" value="'+data.end_city_label+'" '+readonly+'>';
//     html +=     '<label for="advertise-start_date" class="swal-label">Indulás</label>' +
//                 '<input id="advertise-start_date" class="swal-input" value="'+data.start_date+'" '+readonly+'>';
//     html +=     '<label for="advertise-end_date" class="swal-label">Érkezés</label>' +
//                 '<input id="advertise-end_date" class="swal-input" value="'+data.end_date+'" '+readonly+'>';
//     html +=     '<label for="advertise-free_seats" class="swal-label">Szabad ülések száma</label>' +
//                 '<input id="advertise-free_seats" class="swal-input" value="'+data.free_seats+'" '+readonly+'>';

//     if (readonly !== '') {
//         readonly = 'disabled';
//     }

//     html +=     '<div class="checkbox text-left"><label><input id="advertise-retour" type="checkbox" '+readonly+' '+(data.retour?'checked':'')+'>Oda-vissza</label></div>';
//     html +=     '<div class="checkbox text-left"><label><input id="advertise-regular" type="checkbox" '+readonly+' '+(data.regular?'checked':'')+'>Rendszeres út</label></div>';

//     return html + "</div>";
// }

// function storeDataAdvertise(param) {
//     console.log(param);
//     $.ajax({
//         url: "car/set",
//         type: "POST",
//         data: {
//             '_token': '{{ csrf_token() }}',
//             'data': {
//                 id: param.value[0],
//                 user_id: param.value[1],
//                 template: param.value[2],
//                 regular: param.value[3],
//                 start_city_id: param.value[4],
//                 end_city_id: param.value[5],
//                 start_date: param.value[6],
//                 end_date: param.value[7],
//                 free_seats: param.value[8],
//                 retour: param.value[9],
//                 description: param.value[10],
//             }
//         },
//         success: function(response) {
//             console.log(response);
//             //showSuccess("Az adatok rögzítése sikerült!");
//             //location.reload();
//         },
//         error: function (error) {
//             showError(error.responseText);
//         }
//     });
// }

// function formEditAdvertise(result, title) {
//     swal({
//         title: title,
//         html: prepareHtmlAdvertise(result, ''),
//         showCancelButton: true,
//         focusConfirm: false,
//         preConfirm: () => { return [
//             document.getElementById('advertise-id').value,
//             document.getElementById('advertise-user_id').value,
//             document.getElementById('advertise-template').value,
//             document.getElementById('advertise-regular').checked ? 1 : 0,
//             document.getElementById('advertise-start_city_id').value,
//             document.getElementById('advertise-end_city_id').value,
//             document.getElementById('advertise-start_date').value,
//             document.getElementById('advertise-end_date').value,
//             document.getElementById('advertise-free_seats').value,
//             document.getElementById('advertise-retour').checked ? 1 : 0,
//             document.getElementById('advertise-description').value,
//         ]},
//     }).then((res)=>{
//         storeDataCar(res);
//     });
// }

// // $("#advertise-show")
// $('[id^=advertise-show-]').on('click', function(e) {
//     $.ajax({url: "advertise/get/" + $(this).data("key"), success: function(response) {
//         console.log(response);
//         swal({ title: "Hirdetés megtekintése", html: prepareHtmlAdvertise(response, "readonly") });
//     }});
// });

// $('[id^=advertise-edit-]').on('click', function(e) {
//     $.ajax({url: "advertise/get/" + $(this).data("key"), success: function(response) {
//         formEditAdvertise(response, "Hirdetés szerkesztése");
//     }});
// });

// $("#advertise-add").on('click', function(e) {
//     formEditAdvertise({
//         user_id: '{{ Auth::user()->id }}',
//         template: '',
//         regular: '',
//         start_city_id: '',
//         end_city_id: '',
//         start_date: '{{date('Y.m.d')}}',
//         end_date: '{{date('Y.m.d')}}',
//         free_seats: '',
//         retour: '',
//         description: '',
//     }, "Hirdetés feladás");
// });

        console.log("advertises-2");
    </script>
@endpush
