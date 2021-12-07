@component('mail::message')
# Welcome

The body of your message.

@component('mail::button', ['url' => 'https://www.youtube.com'])
Youtube
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
