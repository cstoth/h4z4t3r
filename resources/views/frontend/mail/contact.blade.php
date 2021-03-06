@include('frontend.includes.mail-header')

<p>@lang('strings.emails.contact.email_body_title')</p>

<p><strong>@lang('validation.attributes.frontend.name'):</strong> {{ $request->name }}</p>
<p><strong>@lang('validation.attributes.frontend.email'):</strong> {{ $request->email }}</p>
<p><strong>@lang('validation.attributes.frontend.phone'):</strong> {{ $request->phone or "N/A" }}</p>
<p><strong>@lang('validation.attributes.frontend.message'):</strong> {{ $request->message }}</p>

@include('frontend.includes.mail-footer')
