@include('frontend.includes.mail-header')

<p class="upper">@lang('mails.mecancel.upper')</p><br>
<a href="{{ route('frontend.advertise.reserve', $advertise->id) }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.mecancel.image'))) }}" alt="@lang('mails.mecancel.button')"></a><br>
<p style="font-size:1em">@lang('mails.mecancel.lower')</p><br>

@include('frontend.includes.mail-footer')

