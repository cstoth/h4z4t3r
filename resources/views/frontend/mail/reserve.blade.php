@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.reserve.upper')</p><br>
<a href="{{ route('frontend.advertise.reserve', $advertise->id) }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.reserve.image'))) }}" alt="@lang('mails.reserve.button')"></a><br>
<p style="font-size:1em">@lang('mails.reserve.lower')</p><br>

@include('frontend.includes.mail-footer')

