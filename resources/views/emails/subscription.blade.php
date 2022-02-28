@component('mail::message')
# Introduction

The body of your message.
Новая статья "{{$news->title}} " от {{ $news->author }} опубликована {{  $news->created_at }}
@component('mail::button', ['url' => $url])
Посмотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
