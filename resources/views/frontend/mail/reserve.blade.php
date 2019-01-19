@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.reserve.upper')</p><br>
<a class="button" href="{{ route('frontend.advertise.reserve', $advertise->id) }}">@lang('mails.reserve.button')</a>
<p style="font-size:1em">@lang('mails.reserve.lower')</p><br>

@include('frontend.includes.mail-footer')

