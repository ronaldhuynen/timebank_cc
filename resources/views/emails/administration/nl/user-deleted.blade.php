@component('mail::message')
    Hallo {{ $full_name ?? $name }},

    Je Timebank.cc gebruikers-profiel is verwijderd.  
    
    Gebruikersnaam: {{ $name }}
    Volledige naam: {{ $full_name }}
    Email: {{ $deletedMail }}
    Verwijderd op: {{ $time }}

    Al je rekeningen, persoonlijke profielgegevens, foto's of andere verzonden bestanden en berichten zijn permanent verwijderd. 
    Historische gegevens zoals transactie-omschrijvingen en berichten die je deelt met andere Timebank.cc gebruikers zijn ge-anoniemiseerd. Wij hebben geen gegevens van jou met derden gedeeld. 


    Namens het Timebank.cc Team, hopelijk tot een volgende keer!

    {{ config('app.name') }}
@endcomponent









