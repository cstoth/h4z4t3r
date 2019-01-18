@include('frontend.includes.mail-header')

<div class="content">
<h3 style="text-align:left">Üdvözöljük!</h3>
<p style="text-align:justify">@lang('strings.emails.driver.email_body')</p><br>
<a class="button" href="{{ route('frontend.datasets.advertise.close', $advertise->id) }}">@lang('strings.emails.driver.email_button')</a>
</div>

@include('frontend.includes.mail-footer')