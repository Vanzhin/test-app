@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => $url])
Посмотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
