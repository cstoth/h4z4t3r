@extends('backend.layouts.app')

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
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    @include('backend.datasets.car.includes.show-controls')
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                </div><!--col-->

                <div class="col text-right">
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection
