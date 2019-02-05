@include('frontend.includes.mail-header')

<p class="upper">@lang('mails.hunter.upper')</p><br>

<p><strong>Honnan:</strong> {{ $advertise->start_city_label }}</p>
<p><strong>Hova:</strong> {{ $advertise->end_city_label }}</p>
<p><strong>Indulás:</strong> {{ $advertise->start_date }}</p>
<p><strong>Érkezés:</strong> {{ $advertise->end_date }}</p>

<a href="{{ route('frontend.advertise.reserve', $advertise->id) }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.hunter.image'))) }}" alt="@lang('mails.hunter.button')"></a><br>

@include('frontend.includes.mail-footer')
