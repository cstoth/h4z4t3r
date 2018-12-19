<form id="profile-email" action="email">
    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.profile.settings.Email') }}</span>

    <div class="form-row">
        <div class="col col-md-4">
            <label for="regi-email">{{ __('dashboard.profile.settings.Old Email') }}</label>
            <input class="form-control" id="regi-email" type="text" placeholder="{{ __('dashboard.profile.settings.Old Email') }}">
        </div>
    </div>

    <div class="form-row">
        <div class="col text-center mt-5">
            <button type="submit" class="btn btn-primary">{{ __('dashboard.profile.settings.Email Button') }}</button>
        </div>
    </div>
</form>

<form id="profile-password" action="password">
    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.profile.settings.Password') }}</span>

    <div class="form-row">
        <div class="col col-md-3">
            <label for="regi-jelszo">{{ __('dashboard.profile.settings.Old Password') }}</label>
            <input class="form-control" id="regi-jelszo" type="password" placeholder="{{ __('dashboard.profile.settings.Old Password') }}">
        </div>
    </div>
    <div class="form-row">
        <div class="col col-md-3">
            <label for="uj-jelszo">{{ __('dashboard.profile.settings.New Password') }}</label>
            <input class="form-control" id="uj-jelszo" type="password" placeholder="{{ __('dashboard.profile.settings.New Password') }}">
        </div>
    </div>
    <div class="form-row">
        <div class="col col-md-3">
            <label for="uj-jelszo2">{{ __('dashboard.profile.settings.New Password Again') }}</label>
            <input class="form-control" id="uj-jelszo2" type="password" placeholder="{{ __('dashboard.profile.settings.New Password Again') }}">
        </div>
    </div>

    <div class="form-row">
        <div class="col text-center mt-5">
            <button type="submit" class="btn btn-primary">{{ __('dashboard.profile.settings.Submit Button') }}</button>
        </div>
    </div>
</form>

@push('after-scripts')
    <script type="text/javascript">
        console.log("settings");
    </script>
@endpush
