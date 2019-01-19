@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.rate.upper')</p><br>
<a class="button" href="{{ route('frontend.datasets.advertise.rate', $advertise->id) }}">@lang('mails.rate.button')</a>
<p style="font-size:1em">@lang('mails.rate.lower')</p><br>

@include('frontend.includes.mail-footer')