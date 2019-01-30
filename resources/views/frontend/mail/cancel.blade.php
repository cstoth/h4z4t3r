@include('frontend.includes.mail-header')

<p class="upper">@lang('mails.cancel.upper')</p><br>
<a href="{{ route('frontend.advertise.reserve', $advertise->id) }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.cancel.image'))) }}" alt="@lang('mails.cancel.button')"></a><br>
<p style="font-size:1em">@lang('mails.cancel.lower')</p><br>

@include('frontend.includes.mail-footer')

