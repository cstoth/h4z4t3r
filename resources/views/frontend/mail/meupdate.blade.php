@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.meupdate.upper')</p><br>
<a class="button" href="{{ route('frontend.advertise.reserve', $advertise->id) }}">@lang('mails.meupdate.button')</a>
<p style="font-size:1em">@lang('mails.meupdate.lower')</p><br>

@include('frontend.includes.mail-footer')
