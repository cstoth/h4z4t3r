<div class="col">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>@lang('labels.backend.datasets.city.table.megye')</th>
                    <td>{!! $city->megye !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.city.table.irsz')</th>
                    <td>{{ $city->irsz }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.city.table.name')</th>
                    <td>{{ $city->name }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.city.table.kshkod')</th>
                    <td>{!! $city->kshkod !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.city.table.x')</th>
                    <td>{!! $city->x !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.city.table.y')</th>
                    <td>{{ $city->y }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.general.table.created_at')</th>
                    <td>
                        @if($city->created_at)
                            {{ timezone()->convertToLocal($city->created_at) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('labels.general.table.updated_at')</th>
                    <td>
                        @if($city->updated_at)
                            {{ timezone()->convertToLocal($city->updated_at) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div><!--table-responsive-->
