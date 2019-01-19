@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.update.upper')</p><br>
<a class="button" href="{{ route('frontend.advertise.reserve', $advertise->id) }}">@lang('mails.update.button')</a>
<p style="font-size:1em">@lang('mails.update.lower')</p><br>

@include('frontend.includes.mail-footer')
