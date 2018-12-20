@extends('frontend.layouts.app')

@section('title', __('labels.backend.datasets.advertise.management') . ' | ' . __('labels.backend.datasets.advertise.edit'))

@section('content')
<!-- {{ html()->modelForm($advertise, 'PATCH', route('frontend.datasets.advertise.update', $advertise))->class('form-horizontal')->attribute("autocomplete","off")->open() }} -->
<form method="POST" action="{{route('frontend.datasets.advertise.update', $advertise)}}" autocomplete="off" class="form-horizontal" onsubmit="return validateAdvertiseForm()">
    <input type="hidden" name="_method" id="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.datasets.advertise.management')
                        <small class="text-muted">@lang('labels.backend.datasets.advertise.edit')</small>
                    </h4>
                </div><!--col-->
                <div class="col-sm-6 text-right align-middle">
                    <span class="badge badge-pill badge-light">Hirdetés állapota: </span>
                    <span>{!! $advertise->status_label !!}</span>
                </div><!--col-->
            </div><!--row-->

            <hr />

            @include('frontend.datasets.advertise.includes.form-controls')
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('frontend.user.driver.menu'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{-- form_submit(__('buttons.general.crud.update')) --}}
                    <button id="advertise-update" type="submit" class="btn btn-success pull-right">{{__('buttons.general.crud.update')}}</button>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
