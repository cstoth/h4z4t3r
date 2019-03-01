@extends('frontend.layouts.app')

@section('title', __('labels.backend.datasets.advertise.management') . ' | ' . __('labels.backend.datasets.advertise.rate'))

@section('content')
<form method="POST" action="{{route('frontend.datasets.advertise.close', $advertise)}}" autocomplete="off" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.datasets.advertise.management')
                        <small class="text-muted">@lang('labels.backend.datasets.advertise.rate')</small>
                    </h4>
                </div><!--col-->
                <div class="col-sm-6 text-right align-middle">
                    <span class="badge badge-pill badge-light">Hirdetés állapota: </span>
                    <span class="badge badge-dark">lezárt</span>
                </div><!--col-->
            </div><!--row-->
            <hr />

            <div class="row mt-4">
                <div class="col">
                <h5>{!! $advertise->route_label !!}</h5>
                @if(Auth::user()->id == $advertise->user_id)
                    <!-- Sofőr értéklei az utasait -->
                    @foreach($advertise->reserves as $reserve)
                        @include('frontend.datasets.advertise.includes.user-rate', [
                            'uid' => $reserve->user_id,
                            'name' => $reserve->user->full_name
                        ])
                    @endforeach
                @else
                    @if($advertise->hasUser(Auth::user()->id))
                        <!-- Utas értékeli a sofőrt -->
                        @include('frontend.datasets.advertise.includes.user-rate', [
                            'uid' => $advertise->user_id,
                            'name' => $advertise->user->full_name
                        ])
                    @else
                        <p>Ön nem volt utas ezen az úton!</p>
                    @endif
                @endif
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <!-- <a href="{{route('frontend.user.driver.menu')}}" class="btn btn-info">{{__('buttons.general.return')}}</a> -->
                    <a href="{{ URL::previous() }}" class="btn btn-info">{{__('buttons.general.return')}}</a>
                </div><!--col-->

                <div class="col text-right">
                    @if(!\App\Helpers\Hazater::isRated($advertise->id) && ($advertise->user_id == Auth::user()->id || $advertise->hasUser(Auth::user()->id)))
                    <button id="rate-save" type="submit" class="btn btn-success pull-right">{{__('buttons.general.crud.save')}}</button>
                    @endif
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
@endsection

