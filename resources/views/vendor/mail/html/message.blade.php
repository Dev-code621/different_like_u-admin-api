@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{asset('images/sacki-logo.png')}}" class="logo" alt="Sacki Logo" width="253" style="height: auto !important;max-height: initial !important;width: 253px !important;margin-top: 20px;">
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Please do not reply to this email. Emails sent to this address will not be answered.
<br>
Copyright {{ date('Y')-1 }} - {{ date('Y') }} Sacki,LLC @lang(', 14455 N. Hayden Rd, Ste. 219, Scottsdale, AZ 85260 USA. All rights reserved.')
@endcomponent
@endslot
@endcomponent
