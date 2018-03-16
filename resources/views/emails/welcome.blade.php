Hello {{$user->name}}

Thank you for registration.please verify the account.
{{route('verify',$user->verification_token)}}