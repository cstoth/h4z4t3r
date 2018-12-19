@extends('frontend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.datasets.advertise.management'))

@section('content')
<div class="card">
    <div class="card-body">
        @include('frontend.datasets.includes.submenu', ['main_menu' => 1, 'sub_menu' => 2,])

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                {{-- <th>@lang('labels.backend.datasets.advertise.table.user_id')</th> --}}
                                <th>@lang('labels.backend.datasets.advertise.table.route')</th>
                                {{-- <th>@lang('labels.backend.datasets.advertise.table.brand')</th> --}}
                                <th>@lang('labels.backend.datasets.advertise.table.startend')</th>
                                {{-- <th>@lang('labels.backend.datasets.advertise.table.color')</th>
                                <th>@lang('labels.backend.datasets.advertise.table.year')</th> --}}
                                <th>@lang('labels.backend.datasets.advertise.table.seats')</th>
                                {{-- <th>@lang('labels.backend.datasets.advertise.table.smoke')</th>
                                <th>@lang('labels.backend.datasets.advertise.table.cooler')</th>
                                <th>@lang('labels.backend.datasets.advertise.table.pet')</th>
                                <th>@lang('labels.backend.datasets.advertise.table.bag')</th> --}}
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cars as $car)
                            <tr>
                                {{-- <td>{!! $car->user_label !!}</td> --}}
                                <td>{!! $car->route_label !!}</td>
                                {{-- <td>{{ $car->brand }}</td> --}}
                                <td>{!! $car->dates_label !!}</td>
                                {{-- <td>{{ $car->color }}</td>
                                <td>{{ $car->year }}</td> --}}
                                <td>{{ $car->seats }}</td>
                                {{-- <td>{!! $car->getBoolItem($car->smoke) !!}</td>
                                <td>{!! $car->getBoolItem($car->cooler) !!}</td>
                                <td>{!! $car->getBoolItem($car->pet) !!}</td>
                                <td>{!! $car->getBoolItem($car->bag) !!}</td> --}}
                                <td>{!! $car->action_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{ trans_choice('labels.backend.datasets.total', $cars->total()) }} {!! $cars->total() !!}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $cars->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
