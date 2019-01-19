@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.mecancel.upper')</p><br>
<a class="button" href="{{ route('frontend.advertise.reserve', $advertise->id) }}">@lang('mails.mecancel.button')</a>
<p style="font-size:1em">@lang('mails.mecancel.lower')</p><br>

@include('frontend.includes.mail-footer')

