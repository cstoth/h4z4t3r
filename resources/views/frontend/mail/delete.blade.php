@include('frontend.includes.mail-header')

<p class="upper">@lang('mails.delete.upper')</p><br>
<a href="{{ route('frontend.index') }}"><img src="{{ $message->embed(asset('img/frontend/email/' . __('mails.delete.image'))) }}" alt="@lang('mails.delete.button')"></a><br>
<p style="font-size:1em">@lang('mails.delete.lower')</p><br>

@include('frontend.includes.mail-footer')

