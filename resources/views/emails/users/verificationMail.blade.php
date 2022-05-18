@component('mail::message')
# Verification Email

Hi, {{$user->name}}.

Thank you for becoming a part of an awesome team. Please verify your email through this link.
@component('mail::button', ['url' => url('/').'/verify_email?token='.$user->slug])
Verify Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
