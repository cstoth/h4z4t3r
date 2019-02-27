@extends('frontend.layouts.app')

@push('after-styles')
    <style>
        .phone-template {
            display: inline;
            font-style: italic;
        }
    </style>
@endpush

@section('content')

@if($user)
<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>@lang('labels.frontend.user.profile.avatar')</th>
            <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.name')</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            {{-- <th>@lang('labels.frontend.user.profile.phone')</th> --}}
            <th>@lang('validation.attributes.frontend.phone')</th>
            <td>{{ $user->phone }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.email')</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.rate')</th>
            <td><div class="form-row justify-content-center align-items-center text-center">
                @php $rating = $user->rate; @endphp
                @foreach(range(1,5) as $i)
                    <span class="fa-stack" style="width:1em;color:#f2b600">
                        <i class="far fa-star fa-stack-1x"></i>
                        @if($rating >0)
                            @if($rating >0.5)
                                <i class="fas fa-star fa-stack-1x"></i>
                            @else
                                <i class="fas fa-star-half fa-stack-1x"></i>
                            @endif
                        @endif
                        @php $rating--; @endphp
                    </span>
                @endforeach
                <span>&nbsp;({{$user->rate}})</span>
            </div></td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.created_at')</th>
            <td>{{ \App\Helpers\Hazater::formatDate($user->created_at) }} ({{ $user->created_at->diffForHumans() }})</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.last_updated')</th>
            <td>{{ \App\Helpers\Hazater::formatDate($user->updated_at) }} ({{ $user->updated_at->diffForHumans() }})</td>
        </tr>
    </table>
</div>

<div class="row">
    <div class="col">
        <div class="form-group mb-0 clearfix">
        </div><!--form-group-->
    </div><!--col-->
    <div class="col text-right">
    </div><!--col-->
</div>
@else
<p>Felhasználó nem található!</p>
@endif

@endsection
