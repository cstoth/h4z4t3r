<div class="row mt-4">
    <div class="col">
        <div class="table-responsive">
            <table class="table" id="passangersTable">
                <thead>
                    <tr>
                        <th class="col-hidden">id</th>
                        <th>Utas adatai</th>
                        <th>Út adatai</th>
                        <th class="action_buttons">@lang('labels.general.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($passangers as $data)
                    <tr class="table-row">
                        <td class="col-hidden">{{ $data->id }}</td>
                        <td>{!! $data->user_link_label !!}</td>
                        <td data-field="route" data-key="{{$data->id}}">{!! $data->advertise->route_label !!}</td>
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
        console.log("passangers-1");

// function prepareHtmlPassanger(data, readonly = '') {
//     var html =  '<input id="passanger-id" type="hidden" value="'+data.id+'">';
//     html +=     '<input id="passanger-to_user_id" type="hidden" value="'+data.to_user_id+'">';
//     html +=     '<input id="passanger-advertise_id" type="hidden" value="'+data.advertise_id+'">';
//     html +=     '<label for="passanger-advertise" class="swal-label">Kapcsolódó út</label>' +
//                 '<input id="passanger-advertise" class="swal-input" value="'+data.route_label+'" readonly>';
//     html +=     '<label for="passanger-subject" class="swal-label">Tárgy</label>' +
//                 '<input id="passanger-subject" class="swal-input" value="'+data.subject+'" '+readonly+'>';
//     html +=     '<label for="passanger-text" class="swal-label">Üzenet</label>' +
//                 '<textarea id="passanger-text" class="swal-input h-25" '+readonly+'>'+data.message+'</textarea>';
//     return html;
// }

// function storeDataPassanger(param) {
//     console.log(param);
//     var request = {
//             '_token': '{{ csrf_token() }}',
//             'data': {
//                 id: param.value[0],
//                 to_user_id: param.value[1],
//                 advertise_id: param.value[2],
//                 subject: param.value[3],
//                 message: param.value[4],
//             }
//         };
//         console.log(request);
//     $.ajax({
//         url: "messages/set",
//         type: "POST",
//         data: request,
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

// function formEditPassanger(data, title) {
//     swal({
//         title: title,
//         html: prepareHtmlPassanger(data, ''),
//         showCancelButton: true,
//         focusConfirm: false,
//         preConfirm: () => { return [
//             document.getElementById('passanger-id').value,
//             document.getElementById('passanger-to_user_id').value,
//             document.getElementById('passanger-advertise_id').value,
//             document.getElementById('passanger-subject').value,
//             document.getElementById('passanger-text').value,
//         ]},
//     }).then((res)=>{
//         storeDataPassanger(res);
//     });
// }

// $('[id^=passanger-edit-]').on('click', function(e) {
//     $.ajax({url: "passanger/get/" + $(this).data("key"), success: function(response) {
//         formEditPassanger(response, "Üzenet szerkesztése");
//     }});
// });

// $("[id^=passanger-message-]").on('click', function(e) {
//     var user_id = $(this).data("user");
//     var advertise_id = $(this).data("advertise");
//     var route_label = $(this).data("route");
//     console.log(route_label);
//     formEditPassanger({
//         to_user_id: user_id,
//         advertise_id: advertise_id,
//         route_label: route_label,
//         subject: '',
//         message: '',
//     }, "Üzenet küldése");
// });

        console.log("passangers-2");
    </script>
@endpush
