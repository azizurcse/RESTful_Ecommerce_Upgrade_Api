@component('mail::message')
# Hello {{$user->name}}

You changed your mail.so please confirm new mail.

@component('mail::button', ['url' => route('verify',$user->verification_token)])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent