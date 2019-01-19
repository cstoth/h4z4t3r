@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.delete.upper')</p><br>
<a class="button" href="{{ route('frontend.index') }}">@lang('mails.delete.button')</a>
<p style="font-size:1em">@lang('mails.delete.lower')</p><br>

@include('frontend.includes.mail-footer')

