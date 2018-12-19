@extends('frontend.layouts.app')

@section('title', __('labels.backend.datasets.car.management') . ' | ' . __('labels.backend.datasets.car.edit'))

@section('content')
{{ html()->modelForm($car, 'PATCH', route('frontend.datasets.car.update', $car))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.datasets.car.management')
                        <small class="text-muted">@lang('labels.backend.datasets.car.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    @include('frontend.datasets.car.includes.form-controls')
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('frontend.user.driver.cars'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
