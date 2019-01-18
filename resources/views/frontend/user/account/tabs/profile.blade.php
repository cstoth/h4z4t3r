<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>@lang('labels.frontend.user.profile.avatar')</th>
            <td><img src="{{ $logged_in_user->picture }}" class="user-profile-image" /></td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.name')</th>
            <td>{{ $logged_in_user->name }}</td>
        </tr>
        <tr>
            {{-- <th>@lang('labels.frontend.user.profile.phone')</th> --}}
            <th>@lang('validation.attributes.frontend.phone')</th>
            <td>{{ $logged_in_user->phone }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.email')</th>
            <td>{{ $logged_in_user->email }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.created_at')</th>
            <td>{{ \App\Helpers\Hazater::formatDate($logged_in_user->created_at) }} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.last_updated')</th>
            <td>{{ \App\Helpers\Hazater::formatDate($logged_in_user->updated_at) }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
        </tr>
    </table>
</div>

<div class="row">
    <div class="col">
        <div class="form-group mb-0 clearfix">
        </div><!--form-group-->
    </div><!--col-->
    <div class="col text-right">
        <a href="{{route('frontend.user.profile.delete', $logged_in_user)}}"
        title="{{__('buttons.general.crud.delete')}}"
        data-key="{{$logged_in_user->id}}"
        data-method="delete"
        data-trans-button-cancel="{{__('buttons.general.cancel')}}"
        data-trans-button-confirm="{{__('buttons.general.crud.delete')}}"
        data-trans-title="{{__('strings.backend.general.are_you_sure')}}"
        class="btn btn-danger">Profil törlése</a>
    </div><!--col-->
</div><!--row-->
