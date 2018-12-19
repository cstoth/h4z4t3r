<p>@lang('strings.emails.hunter.email_body_title')</p>

<p><strong>Honnan:</strong> {{ $advertise->start_city_label }}</p>
<p><strong>Hova:</strong> {{ $advertise->end_city_label }}</p>
<p><strong>Indulás:</strong> {{ $advertise->start_date_label }}</p>
<p><strong>Érkezés:</strong> {{ $advertise->end_date_label }}</p>

<a href="{{ route('frontend.advertise.reserve', $advertise->id) }}">Ugrás a hirdetésre.</a>
