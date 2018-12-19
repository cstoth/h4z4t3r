@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
    <div class="row justify-content-center">
        <div class="col col-12 align-self-center">
        
            <div class="card">
                {{ html()->form('POST', route('frontend.contact.send'))->open() }}
                <div class="card-header">
                    <strong>
                        @lang('labels.frontend.contact.box_title')
                    </strong>
                </div><!--card-header-->

                <hr>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.name'))->for('name') }}

                                {{ html()->text('name', optional(auth()->user())->name)
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                {{ html()->email('email', optional(auth()->user())->email)
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.email'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }}

                                {{ html()->text('phone', optional(auth()->user())->phone)
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.phone'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.message'))->for('message') }}

                                {{ html()->textarea('message')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.frontend.message'))
                                    ->autofocus()
                                    ->attribute('rows', 3) }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-body-->

                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0 clearfix">
                               {{ form_submit(__('labels.frontend.contact.button')) }}
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-footer-->
                {{ html()->form()->close() }}

            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
