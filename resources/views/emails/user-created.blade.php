@component('mail::message')
# Your Sunny Day account has been created! 

Your login email is: {{ $user->email }}

Please follow the link below to set your password

@component('mail::button', ['url' => url(route('password.reset', $token))])
Set Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
