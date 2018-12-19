@extends('frontend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.datasets.car.management'))

@section('content')
<div class="card">
    <div class="card-body">
        @include('frontend.datasets.includes.submenu', ['main_menu' => 1, 'sub_menu' => 3,])
        {{-- <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.datasets.car.management')
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('frontend.datasets.car.includes.header-buttons')
            </div><!--col-->
        </div><!--row--> --}}

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                {{-- <th>@lang('labels.backend.datasets.car.table.user_id')</th> --}}
                                <th>@lang('labels.backend.datasets.car.table.license')</th>
                                {{-- <th>@lang('labels.backend.datasets.car.table.brand')</th> --}}
                                <th>@lang('labels.backend.datasets.car.table.type')</th>
                                {{-- <th>@lang('labels.backend.datasets.car.table.color')</th>
                                <th>@lang('labels.backend.datasets.car.table.year')</th> --}}
                                <th>@lang('labels.backend.datasets.car.table.seats')</th>
                                {{-- <th>@lang('labels.backend.datasets.car.table.smoke')</th>
                                <th>@lang('labels.backend.datasets.car.table.cooler')</th>
                                <th>@lang('labels.backend.datasets.car.table.pet')</th>
                                <th>@lang('labels.backend.datasets.car.table.bag')</th> --}}
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cars as $car)
                            <tr>
                                {{-- <td>{!! $car->user_label !!}</td> --}}
                                <td>{{ $car->license }}</td>
                                {{-- <td>{{ $car->brand }}</td> --}}
                                <td>{{ $car->type }}</td>
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
