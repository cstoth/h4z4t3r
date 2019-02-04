<div class="row mt-4">
    <div class="col">
        @if($hunters->count() > 0)
            <div class="table-responsive">
                <table class="table" id="passangersTable">
                    <thead>
                        <tr>
                            <th class="col-hidden">id</th>
                            <th>Indulási hely</th>
                            <th>Érkezési hely</th>
                            <!-- <th>Utazás napja</th> -->
                            {{-- <th>Állapot</th> --}}
                            <th class="action_buttons">@lang('labels.general.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hunters as $data)
                            <tr class="table-row">
                                <td class="col-hidden">{{ $data->id }}</td>
                                <td>{!! $data->start_city_label !!}</td>
                                <td>{!! $data->end_city_label !!}</td>
                                {{-- <td>{!! $data->days_label !!}</td> --}}
                                {{-- <td>{!! $data->status_label !!}</td> --}}
                                <td>{!! $data->frontend_action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <em>Önnek jelenleg nincsen egyetlen hirdetésfigyelője sem!</em>
        @endif
    </div><!--col-->
</div><!--row-->

