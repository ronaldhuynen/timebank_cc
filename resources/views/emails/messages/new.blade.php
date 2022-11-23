@component('mail::message')
@foreach($recipient as $type => $r)
Hello {{ $r['name'] }},
@endforeach

Your conversation on Timebank.cc with {{$event->thread->subject}} has an unread update:


@component('mail::panel')
### {{$owner->name}} wrote:

{{ $event->message->body }}
@endcomponent

{{__('Join this conversation on our website by clicking the Respond button below:')}}


@component('mail::button', ['url' => route('messenger.show', ['thread' => $event->thread->id])])
{{__('Respond')}}
@endcomponent

{{__('Happy Timebanking!')}}<br>

{{ config('app.name') }}
@endcomponent

{{-- TODO: make report as inapproprate link? --}}