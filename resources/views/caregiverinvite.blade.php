component('mail::message')
# Invite to be a caregiver

You have been invited on Tunza app by test to be a caregiver for test. Please login to the application to accept the invite.

@component('mail::button', ['url' => 'http://127.0.0.1'])
Download Tunza
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
