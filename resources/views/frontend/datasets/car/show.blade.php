@extends('frontend.layouts.app')

@section('title', __('labels.backend.datasets.car.management') . ' | ' . __('labels.backend.datasets.car.show'))

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.datasets.car.management')
                        <small class="text-muted">@lang('labels.backend.datasets.car.show')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    @include('frontend.datasets.car.includes.show-controls')
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <!-- <a href="{{route('frontend.user.driver.cars')}}" class="btn btn-info">{{__('buttons.general.return')}}</a> -->
                    <a href="{{ URL::previous() }}" class="btn btn-info">{{__('buttons.general.return')}}</a>
                </div><!--col-->

                <div class="col text-right">
                    <a href="{{route('frontend.datasets.car.edit', $car)}}" class="btn btn-success">{{__('buttons.general.crud.edit')}}</a>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection
