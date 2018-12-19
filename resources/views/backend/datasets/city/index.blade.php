@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.datasets.cities.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.datasets.cities.management')
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.datasets.city.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.datasets.cities.table.megye')</th>
                                <th>@lang('labels.backend.datasets.cities.table.irsz')</th>
                                <th>@lang('labels.backend.datasets.cities.table.name')</th>
                                <th>@lang('labels.backend.datasets.cities.table.kshkod')</th>
                                <th>@lang('labels.backend.datasets.cities.table.x')</th>
                                <th>@lang('labels.backend.datasets.cities.table.y')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td>{{ $city->megye }}</td>
                                <td>{{ $city->irsz }}</td>
                                <td>{{ ucwords($city->name) }}</td>
                                <td>{{ $city->kshkod }}</td>
                                <td>{{ $city->x }}</td>
                                <td>{{ $city->y }}</td>
                                <td>{!! $city->action_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{ trans_choice('labels.backend.datasets.total', $cities->total()) }} {!! $cities->total() !!}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $cities->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
