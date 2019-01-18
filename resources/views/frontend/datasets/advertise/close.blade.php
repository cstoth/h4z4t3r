@extends('frontend.layouts.app')

@section('title', __('labels.backend.datasets.advertise.management') . ' | ' . __('labels.backend.datasets.advertise.close'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.datasets.advertise.management')
                        <small class="text-muted">@lang('labels.backend.datasets.advertise.close')</small>
                    </h4>
                </div><!--col-->
                <div class="col-sm-6 text-right align-middle">
                    <span class="badge badge-pill badge-light">Hirdetés állapota: </span>
                    <span class="badge badge-dark">lezárt</span>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    <h1>A hirdetést sikeresen lezártuk!</h1>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{route('frontend.user.driver.menu')}}" class="btn btn-info">{{__('buttons.general.return')}}</a>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection

