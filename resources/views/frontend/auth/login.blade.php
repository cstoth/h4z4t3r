@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 align-self-center">
            <div class="card">
                <div class="card-header">
                    <a class="boxclose" id="boxclose" href="{{ route('frontend.index') }}"></a>
                    <strong>
                        @lang('labels.frontend.auth.login_box_title')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{-- {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }} --}}

                                    {{ html()->email('email')
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
                                    {{-- {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }} --}}

                                    {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        {{-- <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="checkbox">
                                        {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row--> --}}

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <a href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        @if(config('access.captcha.login'))
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <!-- {!! Captcha::display() !!} -->
                                        {!! Form::captcha() !!}
                                        {{ html()->hidden('captcha_status', 'true') }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    {{-- {{ form_submit(__('labels.frontend.auth.login_button')) }} --}}
                                    <button type="submit" class="btn btn-success pull-right col-md-12">@lang('labels.frontend.auth.login_button')</button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                    {{ html()->form()->close() }}

                    <div class="row">
                        <div class="col">
                            <div class="form-group text-center">
                                <a href="{{route('frontend.auth.social.login', 'facebook')}}" class='btn btn-outline-info col-md-12'><i class='fab fa-facebook'></i>  @lang('labels.frontend.auth.login_with', ['social_media' => 'Facebook'])</a>
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="form-group text-center">
                                <span class="col-md-12">
                                    @lang('labels.frontend.auth.question_register')
                                </span>
                            </div><!--form-group-->
                        </div><!--col-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <a href="{{route('frontend.auth.register')}}" class="btn btn-info col-md-12 {{ active_class(Active::checkRoute('frontend.auth.register')) }}">@lang('navs.frontend.register')</a>
                            </div>
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card body-->
            </div><!--card-->
        </div><!-- col-md-8 -->
    </div><!-- row -->
@endsection


@push('after-scripts')
    @if(config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@endpush
