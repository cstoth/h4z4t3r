@lang('strings.emails.hunter.email_body_title')

Honnan: {{ $advertise->start_city_label }}
Hova: {{ $advertise->end_city_label }}
Indulás: {{ $advertise->start_date_label }}
Érkezés: {{ $advertise->end_date_label }}

Használja ezt a linket a hirdetés megtekintéséhez:
{{ route('frontend.advertise.reserve', $advertise->id) }}
