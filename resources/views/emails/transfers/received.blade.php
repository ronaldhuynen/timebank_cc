@component('mail::message')
# New Timebank.cc transfer

Hello {{ $transaction->accountTo->accountable->name }},

You have received a new payment on your {{ $transaction->accountTo->name }}.


<!--TODO create proper layout of table for all screens!-->
@component('mail::table')
| Date:            | From             | Description      | Amount |
| ---------------- |:----------------:| ----------------:| ------:|
| {{ $transaction->updated_at }} | {{ $transaction->accountFrom->accountable->name }} | {{ $transaction->description }} | {{ tbFormat($transaction->amount) }} |
@endcomponent


@component('mail::button', ['url' => ''])    <!--TODO ook nog juiste rekening aan route toevoegen -->
Transaction history
@endcomponent

Greetings!<br>
{{ config('app.name') }}
@endcomponent
