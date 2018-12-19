<div class="col">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>@lang('labels.backend.datasets.message.table.from_user_id')</th>
                    <td>{!! $message->from_user_label !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.message.table.to_user_id')</th>
                    <td>{!! $message->to_user_label !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.message.table.advertise_id')</th>
                    <td>{!! $message->advertise_label !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.message.table.subject')</th>
                    <td>{!! $message->subject !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.message.table.message')</th>
                    <td>{!! $message->message !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.datasets.message.table.readed')</th>
                    <td>{!! $message->getBoolItem($message->readed) !!}</td>
                </tr>

                <tr>
                    <th>@lang('labels.general.table.created_at')</th>
                    <td>
                        @if($message->created_at)
                            {{ timezone()->convertToLocal($message->created_at) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>@lang('labels.general.table.updated_at')</th>
                    <td>
                        @if($message->updated_at)
                            {{ timezone()->convertToLocal($message->updated_at) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div><!--table-responsive-->
