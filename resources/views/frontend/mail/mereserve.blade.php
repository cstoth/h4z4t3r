@include('frontend.includes.mail-header')

<p class="upper">@lang('mails.mereserve.upper')</p><br>
<a href="{{ route('frontend.advertise.reserve', $advertise->id) }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.mereserve.image'))) }}" alt="@lang('mails.mereserve.button')"></a><br>
<p style="font-size:1em">@lang('mails.mereserve.lower')</p><br>

@include('frontend.includes.mail-footer')

