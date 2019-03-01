@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>CRON</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <button id="hunterButton" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Hunter:Check running...">Run Hunter:Check</button>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@section('scripts')
<script>
    console.log('admin.cron.index - start');

    $('#hunterButton').on('click', function() {
        console.log(this);
        var $this = $(this);
        $this.button('loading');
        $this.attr('disabled','disabled');
        $.get("{{ route('admin.cron.hunter') }}", {}, function (data) {
            console.log(data);
            $this.removeAttr('disabled');
            $this.button('reset');
        }).fail(function (error) {
            swal({
                type: 'error',
                title: 'Hoppá...',
                text: error.message,
            });
            console.log(error.message);
            $this.removeAttr('disabled');
            $this.button('reset');
        });
    });

    console.log('admin.cron.index - end');
</script>
@endsection

