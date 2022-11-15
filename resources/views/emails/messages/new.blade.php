@component('mail::message')
# New Timebank.cc Message Event

Hello!

Body:
{{ $event->message->body }}


Url:
{{ config('app.url') }}

{{-- {{ $event->message->body }} --}}


@component('mail::button', ['url' => route('messenger.show', ['thread' => $event->thread->id])])




<!--TODO ook nog juiste thread aan route toevoegen -->

Respond
@endcomponent

Greetings!<br>
{{ config('app.name') }}
@endcomponent
