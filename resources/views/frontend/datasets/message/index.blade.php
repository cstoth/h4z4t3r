@extends('frontend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.datasets.message.management'))

@section('content')
{{-- <div class="card">
    <div class="card-body"> --}}
        @include('frontend.user.pages.includes.submenu', ['main_menu' => 4, 'sub_menu' => 1,])

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.datasets.message.table.from_user_id')</th>
                                {{-- <th>@lang('labels.backend.datasets.message.table.to_user_id')</th> --}}
                                <th>@lang('labels.backend.datasets.message.table.advertise_id')</th>
                                {{-- <th>@lang('labels.backend.datasets.message.table.subject')</th>
                                <th>@lang('labels.backend.datasets.message.table.message')</th> --}}
                                <th>@lang('labels.backend.datasets.message.table.created_at')</th>
                                <th>@lang('labels.backend.datasets.message.table.readed')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{!! $message->from_user_label !!}</td>
                                {{-- <td>{{ $message->to_user_label }}</td> --}}
                                <td>{{ $message->advertise_label }}</td>
                                {{-- <td>{{ $message->subject }}</td>
                                <td>{{ $message->message }}</td> --}}
                                <td>{{ $message->created_at }}</td>
                                <td>{!! $message->readed_label !!}</td>
                                <td>{!! $message->action_buttons !!}</td>
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
                    {{ trans_choice('labels.backend.datasets.total', $messages->total()) }} {!! $messages->total() !!}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $messages->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    {{-- </div><!--card-body-->
</div><!--card--> --}}
@endsection
