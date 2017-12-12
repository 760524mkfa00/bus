@component('mail::message')
    # Hello {{ $user->first_name . ' ' . $user->last_name }}

    At this time we do not have a seat available for {{ $child->first_name . ' ' . $user->last_name }}

    We have placed them on a wait list.

    Blah blah blah....

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
