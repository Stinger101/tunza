@component('mail::message')
# Invite to be a caregiver

You have been invited on Tunza app by {{$user->name}} to be a caregiver for {{$invite->child->name}}. Please login to the application to accept the invite.

@component('mail::button', ['url' => ''])
Download Tunza
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
