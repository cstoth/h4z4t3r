@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('styles')
    <style>
        #fb-button {
            background-color: #4267B2;
            border-color: #4267B2;
        }
        #fb-button:hover {
            background-color: #ffffff;
            color: #4267B2;
        }
    </style>
@endsection


@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 align-self-center">
            <div class="card">
                <div class="card-header">
                    <a class="boxclose" id="boxclose" href="{{ url()->previous() }}"></a>
                    <strong>
                        @lang('labels.frontend.auth.register_box_title')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <strong class="col-md-12">
                                        @lang('labels.frontend.auth.question_register')
                                    </strong>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <span class="col-md-12">
                                        @lang('labels.frontend.auth.registration_description')
                                    </span>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <a id="fb-button" href="{{route('frontend.auth.social.login', 'facebook')}}" class='btn btn-primary col-md-12'><i class='fab fa-facebook'></i>  @lang('labels.frontend.auth.register_with', ['social_media' => 'Facebook'])</a>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <span class="col-md-12">
                                        @lang('labels.frontend.auth.or_with_email')
                                    </span>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

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
                                    {{-- {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }} --}}

                                    {{ html()->text('first_name')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.first_name'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--col-->
                            </div><!--row-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{-- {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }} --}}

                                    {{ html()->text('last_name')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.last_name'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{-- {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }} --}}

                                    {{ html()->text('phone')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.phone'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-left text-muted">
                                    <em>A mobilszám formátuma: +36301234567</em>
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

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{-- {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }} --}}

                                    {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-left text-muted">
                                    <em>{{__('auth.password_rules')}}</em>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" id="terms" name="terms">
                                    <label for="terms">A regisztrációval elfogadom a <a href="{{ route('frontend.terms') }}" target="_blank">felhasználási feltételeket!</a></label>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        @if(config('access.captcha.registration'))
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {!! Captcha::display() !!}
                                        {{ html()->hidden('captcha_status', 'true') }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    {{-- {{ form_submit(__('labels.frontend.auth.register_button')) }} --}}
                                    <button id="submit-button" type="submit" class="btn btn-success pull-right col-md-12">@lang('labels.frontend.auth.register_button')</button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}

                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-md-8 -->
    </div><!-- row -->
@endsection

@push('after-scripts')
    @if(config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
    {{-- <script>
        $('input').on('change', function(e) {
            console.log(e);
            var flag = $('#email').val().trim().length > 0;
            console.log(flag);
            flag &= $('#first_name').val().trim().length > 0;
            console.log(flag);
            flag &= $('#last_name').val().trim().length > 0;
            console.log(flag);
            flag &= $('#password').val().trim().length > 0;
            console.log(flag);
            flag &= $('#password_confirmation').val().trim().length > 0;
            console.log(flag);
            flag &= $('#terms').is(':checked');
            console.log(flag);
            $('#submit-button').attr('disabled', !flag);
        });
    </script> --}}
@endpush
