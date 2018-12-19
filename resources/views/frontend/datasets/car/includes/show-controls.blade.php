<div class="col">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>@lang('labels.backend.datasets.car.table.user_id')</th>
                    <td>{!! $car->user_label !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.license')</th>
                    <td>{{ $car->license }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.brand')</th>
                    <td>{{ $car->brand }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.type')</th>
                    <td>{!! $car->type !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.color')</th>
                    <td>{{ $car->color }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.year')</th>
                    <td>{!! $car->year !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.seats')</th>
                    <td>{{ $car->seats }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.image')</th>
                    <td>
                        @if($car->image)
                            <img src="{{ $car->picture }}" class="car-image" />
                        @else
                            Nincs kép feltöltve!
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.image2')</th>
                    <td>
                        @if($car->image2)
                            <img src="{{ $car->picture2 }}" class="car-image" />
                        @else
                            Nincs kép feltöltve!
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.smoke')</th>
                    <td>{!! $car->getBoolItem($car->smoke) !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.cooler')</th>
                    <td>{!! $car->getBoolItem($car->cooler) !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.pet')</th>
                    <td>{!! $car->getBoolItem($car->pet) !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.car.table.bag')</th>
                    <td>{!! $car->getBoolItem($car->bag) !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.general.table.created_at')</th>
                    <td>
                        @if($car->created_at)
                            {{ timezone()->convertToLocal($car->created_at) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('labels.general.table.updated_at')</th>
                    <td>
                        @if($car->updated_at)
                            {{ timezone()->convertToLocal($car->updated_at) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div><!--table-responsive-->
