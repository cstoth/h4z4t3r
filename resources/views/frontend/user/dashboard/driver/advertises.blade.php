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

        console.log("advertises-2");
    </script>
@endpush
