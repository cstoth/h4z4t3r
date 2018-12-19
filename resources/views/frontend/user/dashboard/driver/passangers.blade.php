@push('after-styles')
    <style>
    </style>
@endpush

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
                    @foreach($passangers['datas'] as $data)
                    <tr class="table-row">
                        <td class="col-hidden">{{ $data->id }}</td>
                        <td>{!! $data->user_label !!}</td>
                        <td>{!! $data->route_label !!}</td>
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

function prepareHtmlPassanger(data, readonly = '') {
    var html =  '<input id="id" type="hidden" value="'+data.id+'">';
    html +=     '<input id="to_user_id" type="hidden" value="'+data.to_user_id+'">';
    html +=     '<label for="passanger-subject" class="swal-label">Tárgy</label>' +
                '<input id="passanger-subject" class="swal-input" value="'+data.subject+'" '+readonly+'>' +
                '<label for="passanger-text" class="swal-label">Üzenet</label>' +
                '<textarea id="passanger-text" class="swal-input h-25" '+readonly+'>'+data.message+'</textarea>';
    return html;
}

function storeDataPassanger(param) {
    console.log(param);
    $.ajax({
        url: "car/set",
        type: "POST",
        data: {
            '_token': '{{ csrf_token() }}',
            'data': {
                id: param.value[0],
                to_user_id: param.value[1],
                subject: param.value[2],
                message: param.value[3],
            }
        },
        success: function(response) {
            console.log(response);
            //showSuccess("Az adatok rögzítése sikerült!");
            location.reload();
        },
        error: function (error) {
            showError(error.responseText);
        }
    });
}

function formEditPassanger(result, title) {
    swal({
        title: title,
        html: storeDataPassanger(result, ''),
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => { return [
            document.getElementById('id').value,
            document.getElementById('passanger-userid').value,
            document.getElementById('passanger-subject').value,
            document.getElementById('passanger-text').value,
        ]},
    }).then((res)=>{
        storeDataMessage(res);
    });
}

$('[id^=passanger-edit-]').on('click', function(e) {
    $.ajax({url: "passanger/get/" + $(this).data("key"), success: function(response) {
        formEditPassanger(response, "Hirdetés szerkesztése");
    }});
});

$("[id^=passanger-message-]").on('click', function(e) {
    var user_id = $(this).data("user");
    var advertise_id = $(this).data("advertise");
    formEditPassanger({
        user_id: '{{ Auth::user()->id }}',
        to_user_id: user_id,
        to_advertise_id: advertise_id,
        subject: '',
        message: '',
    }, "Üzenet küldése");
});

        console.log("passangers-2");
    </script>
@endpush
