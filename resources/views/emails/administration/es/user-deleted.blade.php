@component('mail::message')
    {{__('Hola') . ' ' . $to['name'] }},

    {{ __('Your profile on Timebank.cc just received a') . ' ' .  $reactionType['name'] . ' ' . __('from') . ' ' . $from->name . '.'}}

    {{__('If you want, you can also view the profile of') . ' ' . $from->name . ' ' . __('here:') }}


    @component('mail::button', ['url' => $buttonUrl])
        {{ $from->name }}
    @endcomponent

    {{__('Happy Timebanking!')}}<br>

    {{ config('app.name') }}
@endcomponent









