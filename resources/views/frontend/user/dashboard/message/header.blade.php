<div class="col-sm-9 form-inline">
    {{ html()->form('POST', route('frontend.messages.search'))->open() }}
        <div class="btn-toolbar float-left" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
            <button class="btn btn-info ml-1" data-toggle="tooltip" title="@lang('labels.general.buttons.search')">
                <i class="fas fa-search mr-1"></i>
                {{ __('labels.general.buttons.search') }}
            </button>
            <input id="message-search" name="message-search" type="text" class="form-control ml-2 mr-5" placeholder="" value="{{$messages['filter'] ?? ''}}">
        </div>
    {{ html()->form()->close() }}
</div><!--col-->

<div class="col-sm-3">
    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
        {{-- href="{{ route('admin.auth.user.create') }}" --}}
        {{-- <a class="btn btn-info ml-1" data-toggle="tooltip" title="Új üzenet küldése">
            <i class="fas fa-plus-circle"></i>
            Új üzenet
        </a> --}}
        Összes üzenet: <span class='font-weight-bold text-info ml-1 mr-1'>{{ $messages['count'] }}</span> ebből olvasatlan
        <span class='font-weight-bold text-danger ml-1 mr-1'>{{ $messages['unreads'] }}</span>
    </div>
</div><!--col-->
