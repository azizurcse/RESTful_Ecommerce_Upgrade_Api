@component('mail::message')
# Hello {{$user->name}}

Thank you for registration.please verify the account.

@component('mail::button', ['url' => route('verify',$user->verification_token)])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent