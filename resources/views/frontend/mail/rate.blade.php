@include('frontend.includes.mail-header')

<p style="text-align:justify">@lang('mails.rate.upper')</p><br>
<a href="{{ route('frontend.datasets.advertise.rate', $advertise->id) }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.rate.image'))) }}" alt="@lang('mails.rate.button')"></a><br>
<p style="font-size:1em">@lang('mails.rate.lower')</p><br>

@include('frontend.includes.mail-footer')