Hello {{$user->name}}

You changed your mail.so please confirm new mail.
{{route('verify',$user->verification_token)}}