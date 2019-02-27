@extends('frontend.layouts.app')

@section('title', __('labels.backend.datasets.message.management') . ' | ' . __('labels.backend.datasets.message.show'))

@section('content')
    {{-- <div class="card">
        <div class="card-body"> --}}
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.datasets.message.management')
                        <small class="text-muted">@lang('labels.backend.datasets.message.show')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    @include('frontend.datasets.message.includes.show-controls')
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <!-- {{ form_cancel(route('frontend.datasets.message.index'), __('buttons.general.return')) }} -->
                    {{ form_cancel(URL::previous(), __('buttons.general.return')) }}
                </div><!--col-->

                <div class="col text-right">
                </div><!--col-->
            </div><!--row-->
        {{-- </div><!--card-footer-->
    </div><!--card--> --}}
@endsection
