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
                @if(Auth::user()->id == $advertise->user_id)
                    <!-- Sofőr értéklei az utasait -->
                    <input type="hidden" name="_mode" value="driver">
                    @foreach($advertise->reserves as $reserve)
                        @include('frontend.datasets.advertise.includes.driver-rate')
                    @endforeach
                @else
                    <!-- Utas értékeli a sofőrt -->
                    <input type="hidden" name="_mode" value="passanger">
                    @include('frontend.datasets.advertise.includes.passanger-rate')
                @endif
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{route('frontend.user.driver.menu')}}" class="btn btn-info">{{__('buttons.general.return')}}</a>
                </div><!--col-->

                <div class="col text-right">
                    <button id="rate-save" type="submit" class="btn btn-success pull-right">{{__('buttons.general.crud.save')}}</button>
                </div><!--col-->                
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
@endsection

