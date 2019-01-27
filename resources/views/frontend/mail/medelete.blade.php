@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.medelete.upper')</p><br>
<a href="{{ route('frontend.datasets.advertise.create') }}"><img src="{{ asset('img/frontend/email/' . __('mails.medelete.image')) }}" alt="@lang('mails.medelete.button')"></a><br>
<p style="font-size:1em">@lang('mails.medelete.lower')</p><br>

@include('frontend.includes.mail-footer')

