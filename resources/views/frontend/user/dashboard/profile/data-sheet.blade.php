<form id="profile-data" action="profile-data">
    <span class="d-block p-2 bg-group text-black mt-5 mb-3">{{ __('dashboard.profile.settings.Email') }}</span>

    <div class="row">
        <div class="col col-md-2 justify-content-center">
            <label for="">{{ __('dashboard.profile.datas.Photo').":" }}</label>
            <img width="100%" src="/img/frontend/teszt-avatar.png" alt="q">
        </div>

        <div class="col h-25">
            <div class="row">
            <div class="col">
                    <label for="vezeteknev">{{ __('dashboard.profile.datas.First Name') }}</label>
                    <input class="form-control" id="vezeteknev" type="text" placeholder="{{ __('dashboard.profile.datas.First Name') }}">
                </div>
                <div class="col">
                    <label for="keresztnev">{{ __('dashboard.profile.datas.Last Name') }}</label>
                    <input class="form-control" id="keresztnev" type="text" placeholder="{{ __('dashboard.profile.datas.Last Name') }}">
                </div>
                <div class="col">
                    <label for="telefon">{{ __('dashboard.profile.datas.Phone Number') }}</label>
                    <input class="form-control bfh-phone" data-format="+1 (ddd) ddd-dddd" id="telefon" type="tel" placeholder="{{ __('dashboard.profile.datas.Phone Number') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <a class="font-weight-bold" href="#">{{ __('dashboard.profile.datas.Delete') }}</a>
    </div>


    <div class="form-row">
        <div class="col text-center mt-5">
            <button type="submit" class="btn btn-primary">{{ __('dashboard.profile.datas.Submit Button') }}</button>
        </div>
    </div>
</form>

@push('after-scripts')
    <script type="text/javascript">
        console.log("data-sheet");
    </script>
@endpush
