@component('mail::message')
#Account Activation Email.

Hi, Thank you for registering your account with us. Please use the link below to set up your account password.

@component('mail::button', ['url' =>  url('/').'/set_password?token='.$user->slug])
Set Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
