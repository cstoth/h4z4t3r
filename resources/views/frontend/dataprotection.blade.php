@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.dataprotection.box_title'))

@section('content')
    <div class="row justify-content-center">
        <div class="col col-12 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        @lang('labels.frontend.dataprotection.box_title')
                    </strong>
                </div><!--card-header-->

                <hr>

                <div class="card-body">
                    @include('frontend.includes.data-content')
                </div><!--card-body-->

                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0 clearfix">
                                {{ button_ok(__('labels.frontend.dataprotection.button'), route('frontend.index')) }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-footer-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
