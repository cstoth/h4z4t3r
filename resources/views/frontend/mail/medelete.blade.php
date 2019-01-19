@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.medelete.upper')</p><br>
<a class="button" href="{{ route('frontend.datasets.advertise.create') }}">@lang('mails.medelete.button')</a>
<p style="font-size:1em">@lang('mails.medelete.lower')</p><br>

@include('frontend.includes.mail-footer')

