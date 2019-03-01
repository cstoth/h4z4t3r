@include('frontend.includes.mail-header')

<p class="upper">@lang('mails.merevoke.upper')</p><br>
<a href="{{ route('frontend.advertise.reserve', $advertise->id) }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.medelete.image'))) }}" alt="@lang('mails.medelete.button')"></a><br>
<p style="font-size:1em">@lang('mails.merevoke.lower')</p><br>

@include('frontend.includes.mail-footer')

