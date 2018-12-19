@extends('frontend.layouts.app')

@push('after-styles')
    <style>
    .col-hidden {display: none;}
    </style>
@endpush

@section('content')

<div class="row justify-content-center align-items-center mb-3">
    <div class="col col-12 align-self-center">
        @include('frontend.user.pages.includes.submenu', ['main_menu' => 4])

<div class="row mt-3">
    @include('frontend.user.dashboard.message.header')
</div><!--row-->

<div class="row mt-4">
    <div class="col">
        <div class="table-responsive">
            <table class="table" id="message-table">
                <thead>
                    <tr>
                        <th class="col-hidden">id</th>
                        <th>Küldő</th>
                        <th>Üzenethez kapcsolódó út</th>
                        <th>Időpont</th>
                        <th>Állapot</th>
                        <th class="action_buttons"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages['datas'] as $data)
                    <tr class="table-row" data-table="message" data-id="{{ $data->id }}">
                        <td class="table-data col-hidden">{{ $data->id }}</td>
                        <td>{!! $data->from_user_label !!}</td>
                        <td>{!! $data->advertise_label !!}</td>
                        <td>{!! $data->created_at !!}</td>
                        <td>{!! $data->readed_label !!}</td>
                        <td>{!! $data->action_buttons !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!--col-->
</div><!--row-->

{{-- <div class="form-row mb-3">
    <div class="col text-center mt-3">
        <a class="btn btn-info" data-toggle="tooltip" title="Új üzenet küldése" id="message-add">
            <i class="fas fa-plus-circle mr-1"></i>Új üzenet küldése
        </a>
    </div>
</div> --}}

</div><!-- col-xs-12 -->
</div><!-- row -->
@endsection


@push('after-scripts')
<script>

console.log("messages-1");

function prepareHtmlMessage(data, readonly = '', users) {
    var html =  '<input id="id" type="hidden" value="'+data.id+'">';
    html += '<input id="to_user_id" type="hidden" value="'+data.to_user_id+'">';
    html += '<label for="message-userid" class="swal-label">Címzett</label>';
    if (readonly !== '') {
        html += '<input id="message-userid" class="swal-input" value="'+data.to_user.full_name+'" '+readonly+'>';
    } else {
        html += '<select id="message-userid" class="swal-input" '+readonly+'>';
        for (user of users) {
            var selected = '';
            if (user.id == data.to_user_id) {
                selected = "selected";
            }
            html += "<option value='"+user.id+"' "+selected+">"+user.full_name+"</option>";
        }
        html += '</select>';
    }
    html += '<label for="message-advertise" class="swal-label">Kapcsolódó út</label>' +
            '<input id="message-advertise" class="swal-input" value="'+data.route_label+'" '+readonly+'>';
    if (readonly !== '') {
        html += '<label for="message-date" class="swal-label">Feladás dátuma</label>' +
                '<input id="message-date" class="swal-input" value="'+data.created_at+'" '+readonly+'>';
    }
    html += '<label for="message-subject" class="swal-label">Tárgy</label>' +
            '<input id="message-subject" class="swal-input" value="'+data.subject+'" '+readonly+'>' +
            '<label for="message-text" class="swal-label">Üzenet</label>' +
            '<textarea id="message-text" class="swal-input h-25" '+readonly+'>'+data.message+'</textarea>';
    // console.log(html);
    return html;
}

function setMessageReaded(id) {
    var image = $('#message-view-'+id);
    image.fadeOut(1000, function() {
        var imgsrc = image.attr('src').replace('closed', 'open');
        image.attr("src", imgsrc);
    }).fadeIn(1000);
}

function storeDataMessage(param) {
    console.log(param);
    $.ajax({
        url: "/messages/set",
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
            //location.reload();
        },
        error: function (error) {
            showError(error.responseText);
        }
    });
}

function formEditMessage(result, title) {
    $.ajax({url: "/user/list", success: function(users) {
        swal({
            title: title,
            html: prepareHtmlMessage(result, '', users),
            showCancelButton: true,
            focusConfirm: false,
            preConfirm: () => { return [
                document.getElementById('id').value,
                document.getElementById('message-userid').value,
                document.getElementById('message-subject').value,
                document.getElementById('message-text').value,
            ]},
        }).then((res)=>{
            storeDataMessage(res);
        });
    }});
}

// $("#message-show")
$('[id^=message-show-]').on('click', function(e) {
    var key = $(this).data("key");
    $.ajax({url: "/messages/read/" + key, success: function(response) {
        console.log(response);
        swal({
            title: "Üzenet megtekintése",
            html: prepareHtmlMessage(response, "readonly", [response.to_user]),
        }).then((res)=>{
            //console.log(res);
            if (res) {
                setMessageReaded(key);
                //location.reload();
            }
        });
    }});
});

$('[id^=message-edit-]').on('click', function(e) {
    var key = $(this).data("key");
    $.ajax({url: "/messages/get/" + key, success: function(response) {
        formEditMessage(response, "Üzenet szerkesztése");
    }});
});

$("#message-add").on('click', function(e) {
    formEditMessage({
        to_user_id: '',
        subject: '',
        message: '',
    }, "Üzenet küldése");
});

console.log("messages-2");

</script>
@endpush
