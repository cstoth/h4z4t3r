@include('frontend.includes.mail-header')

<p class="upper">@lang('mails.update.upper')</p><br>
<a href="{{ route('frontend.advertise.reserve', $advertise->id) }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.update.image'))) }}" alt="@lang('mails.update.button')"></a><br>
<p style="font-size:1em">@lang('mails.update.lower')</p><br>

@include('frontend.includes.mail-footer')
