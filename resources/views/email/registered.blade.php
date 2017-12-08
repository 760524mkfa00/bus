@component('mail::message')

# Hello {{ $user->first_name . ' ' . $user->last_name }}

Thank you for registering. You can now register your students for busing.

When you log in you will be able to manage your balance and check the status of you child registration.

Button to log in....etc etc, pull data from user form.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
