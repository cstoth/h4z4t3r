{{ html()->modelForm($logged_in_user, 'PATCH', route('frontend.user.profile.update'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
{{-- <form id="profile-update" class="form-horizontal" method="PATCH" action="{{route('frontend.user.profile.update')}}" enctype="multipart/form-data"> --}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.avatar'))->for('avatar') }}

                <div>
                    <input type="radio" name="avatar_type" value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} /> {{ __('validation.attributes.frontend.Gravatar') }}
                    <input type="radio" name="avatar_type" value="storage" class="ml-3" {{ $logged_in_user->avatar_type == 'storage' ? 'checked' : '' }} /> {{ __('validation.attributes.frontend.Upload') }}

                    @foreach($logged_in_user->providers as $provider)
                        @if(strlen($provider->avatar))
                            <input type="radio" name="avatar_type" value="{{ $provider->provider }}" {{ $logged_in_user->avatar_type == $provider->provider ? 'checked' : '' }} /> {{ ucfirst($provider->provider) }}
                        @endif
                    @endforeach
                </div>
            </div><!--form-group-->

            <div class="form-row">
                <div class="form-group hidden" id="avatar_location">
                    {{ html()->file('avatar_location')->class('form-control') }}
                </div><!--form-group-->
                <i class="ml-3" style="margin-top: 0.5rem;">Képméret: max. 1024 KB</i>
            </div>
        </div><!--col-->
        <div class="col-md-6">
            <!-- <div class="row" id="avatar_image"> -->
                <img src="{{ $logged_in_user->picture }}" class="user-profile-image" />
            <!-- </div> -->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

                {{ html()->text('first_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.first_name'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="row">
        <div class="col">
            <div class="form-group">
                {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

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
                {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }}
                <div class="phone-template">(Pl.: +36301234567)</div>

                {{ html()->text('phone')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.phone'))
                    ->attribute('maxlength', 32)
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    @if ($logged_in_user->canChangeEmail())
        <div class="row">
            <div class="col">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> @lang('strings.frontend.user.change_email_notice')
                </div>

                <div class="form-group">
                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                    {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    @endif

    <div class="row">
        <div class="col text-right">
            <div class="form-group mb-0 clearfix">
                {{ form_submit(__('labels.general.buttons.update')) }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
{{ html()->closeModelForm() }}

@push('after-scripts')
    <script>
        $(function() {
            var avatar_location = $("#avatar_location");

            if ($('input[name=avatar_type]:checked').val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }

            $('input[name=avatar_type]').change(function() {
                if ($(this).val() === 'storage') {
                    avatar_location.show();
                } else {
                    avatar_location.hide();
                }
            });
        });
    </script>
@endpush
