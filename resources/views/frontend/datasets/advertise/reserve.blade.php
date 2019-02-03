@extends('frontend.layouts.app')

@section('title', __('labels.backend.datasets.advertise.management') . ' | ' . __('labels.backend.datasets.advertise.reserve'))

@section('content')
<div class="row justify-content-center">
    <div class="col col-12 align-self-center">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title mb-0">Helyfoglalás</h4>
                    </div><!--col-->
                    <div class="col-sm-6 text-right align-middle">
                        <span class="badge badge-pill badge-light">Hirdetés állapota: </span>
                        <span>{!! $advertise->status_label !!}</span>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4">
                    <div class="col">
                        @include('frontend.datasets.advertise.includes.reserve-controls')
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('frontend.find') }}" class="btn btn-info">{{__('buttons.general.return')}}</a>
                    </div><!--col-->

                    <div class="col text-right">
                        @if ($reserved)
                            @if ($advertise->isDeletable())
                                {{ html()->form('GET', route('frontend.user.advertise.resign'))->class('form-horizontal resign-form')->open() }}
                                    <input type="hidden" name="advertise_id" value="{{$advertise->id}}">
                                    <button type="submit" class="btn btn-danger">Visszamondás</button>
                                {{ html()->form()->close() }}
                            @endif
                        @else
                            @if ((!Auth::user() || Auth::user()->id != $advertise->user->id) && ($advertise->free_seats > 0) && ($advertise->status == 1))
                                {{ html()->form('POST', route('frontend.user.reserve.store'))->class('form-horizontal')->open() }}
                                    <input type="hidden" name="advertise_id" value="{{$advertise->id}}">
                                    <button type="submit" class="btn btn-success">Helyfoglalás</button>
                                {{ html()->form()->close() }}
                            @endif
                        @endif
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->

    </div><!--col-->
</div><!--row-->
@endsection
