@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.cancel.upper')</p><br>
<a class="button" href="{{ route('frontend.advertise.reserve', $advertise->id) }}">@lang('mails.cancel.button')</a>
<p style="font-size:1em">@lang('mails.cancel.lower')</p><br>

@include('frontend.includes.mail-footer')

