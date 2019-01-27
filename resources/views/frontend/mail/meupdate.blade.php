@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.meupdate.upper')</p><br>
<a href="{{ route('frontend.advertise.reserve', $advertise->id) }}"><img src="{{ asset('img/frontend/email/' . __('mails.meupdate.image')) }}" alt="@lang('mails.meupdate.button')"></a><br>
<p style="font-size:1em">@lang('mails.meupdate.lower')</p><br>

@include('frontend.includes.mail-footer')
