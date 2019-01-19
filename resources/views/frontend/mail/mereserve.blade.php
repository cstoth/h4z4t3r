@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.mereserve.upper')</p><br>
<a class="button" href="{{ route('frontend.advertise.reserve', $advertise->id) }}">@lang('mails.mereserve.button')</a>
<p style="font-size:1em">@lang('mails.mereserve.lower')</p><br>

@include('frontend.includes.mail-footer')

