<div class="row mt-4">
    <div class="col">
        <div class="table-responsive">
            <table class="table" id="advertisesTable">
                <thead>
                    <tr class="status9">
                        <th class="col-hidden">id</th>
                        <th class="form-inline">
                            <select id="status" class="form-control form-control-sm ml-2" title="Állapot">
                                <option value="0">inaktív</option>
                                <option value="1" selected>aktív</option>
                                <option value="2">törlendő</option>
                                <option value="3">folyamatban</option>
                                <option value="4">lejárt</option>
                                <option value="5">lezárt</option>
                                <!-- <option>törölt</option> -->
                                <option value="9">összes</option>
                            </select>
                        </th>
                        <th>Út adatai</th>
                        <th>Indulás-Érkezés</th>
                        <th>Szabad helyek</th>
                        <th class="action_buttons">@lang('labels.general.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($advertises as $data)
                    <tr class="table-row status{{ $data->status }}">
                        <td class="col-hidden">{{ $data->id }}</td>
                        <td>{!! $data->status_label !!}</td>
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

        function filterTableRows(status) {
            if (status == 9) {
                $("#advertisesTable tr.table-row").show();
            } else {
                $("#advertisesTable tr.table-row").hide();
                $("#advertisesTable tr.table-row.status"+status).show();
            }
        }

        $("#status").change(function() {
            filterTableRows($(this).val());
        });

        filterTableRows(1);
        
        console.log("advertises-2");
    </script>
@endpush
