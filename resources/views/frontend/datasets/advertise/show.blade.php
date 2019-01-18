@extends('frontend.layouts.app')

@section('title', __('labels.backend.datasets.advertise.management') . ' | ' . __('labels.backend.datasets.advertise.show'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.datasets.advertise.management')
                        <small class="text-muted">@lang('labels.backend.datasets.advertise.show')</small>
                    </h4>
                </div><!--col-->
                <div class="col-sm-6 text-right align-middle">
                    <span class="badge badge-pill badge-light">Hirdetés állapota: </span>
                    <span>{!! $advertise->status_label !!}</span>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    @include('frontend.datasets.advertise.includes.show-controls')
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{route('frontend.user.driver.menu')}}" class="btn btn-info">{{__('buttons.general.return')}}</a>
                </div><!--col-->

                <div class="col text-right">
                    @if(Auth::user() && (Auth::user()->id == $advertise->user_id) && ($advertise->isEditable()))
                        <a href="{{route('frontend.datasets.advertise.edit',$advertise)}}" class="btn btn-success">{{__('buttons.general.crud.edit')}}</a>
                    @endif
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection

