@include('frontend.includes.mail-header')

<p class="upper">@lang('mails.confirm.upper')</p><br>
<a href="{{ route('frontend.auth.account.confirm', $user->confirmation_code) }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.confirm.image'))) }}" alt="@lang('mails.confirm.button')"></a><br>
<p style="font-size:1em">@lang('mails.confirm.lower')</p><br>

@include('frontend.includes.mail-footer')

