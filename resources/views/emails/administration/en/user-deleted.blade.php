@component('mail::message')
    Hello {{ $full_name ?? $name }},

    Your Timebank.cc user profile has been deleted.  
    
    Username: {{ $name }}
    Full name: {{ $full_name }}
    Email: {{ $deletedMail }}
    Deleted at: {{ $time }}

    All your accounts, personal profile data, photo's, or other uploaded files and messages have been permanently deleted.
    Historical data as transaction descriptions and messages you shared with other Timebank.cc users have been anonimyzed. We did not shared any of your data with third parties. 


    On behalf of the Timebank.cc Team, we hope to see you another time!

    {{ config('app.name') }}
@endcomponent