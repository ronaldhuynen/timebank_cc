<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [
    'accepted'             => ':Attribute moet worden geaccepteerd.',
    'accepted_if'          => ':Attribute moet worden geaccepteerd als :other :value is.',
    'active_url'           => ':Attribute is geen geldige URL.',
    'after'                => ':Attribute moet een datum na :date zijn.',
    'after_or_equal'       => ':Attribute moet een datum na of gelijk aan :date zijn.',
    'alpha'                => ':Attribute mag alleen letters bevatten.',
    'alpha_dash'           => ':Attribute mag alleen letters, nummers, underscores (_) en streepjes (-) bevatten.',
    'alpha_num'            => ':Attribute mag alleen letters en nummers bevatten.',
    'array'                => ':Attribute moet geselecteerde elementen bevatten.',
    'before'               => ':Attribute moet een datum vóór :date zijn.',
    'before_or_equal'      => ':Attribute moet een datum vóór of gelijk aan :date zijn.',
    'between'              => [
        'array'   => ':Attribute moet tussen :min en :max waardes bevatten.',
        'file'    => ':Attribute moet tussen :min en :max kilobytes zijn.',
        'numeric' => ':Attribute moet tussen :min en :max zijn.',
        'string'  => ':Attribute moet tussen :min en :max karakters zijn.',
    ],
    'boolean'              => ':Attribute moet ja of nee zijn.',
    'confirmed'            => 'Bevestiging van :attribute komt niet overeen.',
    'current_password'     => 'Huidig wachtwoord is onjuist.',
    'date'                 => ':Attribute moet een datum bevatten.',
    'date_equals'          => ':Attribute moet een datum gelijk aan :date zijn.',
    'date_format'          => ':Attribute voldoet niet aan het formaat :format.',
    'declined'             => ':Attribute moet afgewezen worden.',
    'declined_if'          => ':Attribute moet afgewezen worden wanneer :other gelijk is aan :value.',
    'different'            => ':Attribute en :other moeten verschillend zijn.',
    'digits'               => ':Attribute moet bestaan uit :digits cijfers.',
    'digits_between'       => ':Attribute moet bestaan uit minimaal :min en maximaal :max cijfers.',
    'dimensions'           => ':Attribute heeft geen geldige afmetingen voor afbeeldingen.',
    'distinct'             => ':Attribute heeft een dubbele waarde.',
    'email'                => ':Attribute is geen geldig e-mailadres.',
    'ends_with'            => ':Attribute moet met één van de volgende waarden eindigen: :values.',
    'enum'                 => 'Gekozen :attribute is ongeldig.',
    'exists'               => ':Attribute bestaat niet.',
    'file'                 => ':Attribute moet een bestand zijn.',
    'filled'               => ':Attribute is verplicht.',
    'gt'                   => [
        'array'   => ':Attribute moet meer dan :value waardes bevatten.',
        'file'    => ':Attribute moet groter zijn dan :value kilobytes.',
        'numeric' => ':Attribute moet groter zijn dan :value.',
        'string'  => ':Attribute moet meer dan :value tekens bevatten.',
    ],
    'gte'                  => [
        'array'   => ':Attribute moet :value of meer waardes bevatten.',
        'file'    => ':Attribute moet groter of gelijk zijn aan :value kilobytes.',
        'numeric' => ':Attribute moet groter of gelijk zijn aan :value.',
        'string'  => ':Attribute moet minimaal :value tekens bevatten.',
    ],
    'image'                => ':Attribute moet een afbeelding zijn.',
    'in'                   => ':Attribute is ongeldig.',
    'in_array'             => ':Attribute bestaat niet in :other.',
    'integer'              => ':Attribute moet een getal zijn.',
    'ip'                   => ':Attribute moet een geldig IP-adres zijn.',
    'ipv4'                 => ':Attribute moet een geldig IPv4-adres zijn.',
    'ipv6'                 => ':Attribute moet een geldig IPv6-adres zijn.',
    'json'                 => ':Attribute moet een geldige JSON-string zijn.',
    'lt'                   => [
        'array'   => ':Attribute moet minder dan :value waardes bevatten.',
        'file'    => ':Attribute moet kleiner zijn dan :value kilobytes.',
        'numeric' => ':Attribute moet kleiner zijn dan :value.',
        'string'  => ':Attribute moet minder dan :value tekens bevatten.',
    ],
    'lte'                  => [
        'array'   => ':Attribute moet :value of minder waardes bevatten.',
        'file'    => ':Attribute moet kleiner of gelijk zijn aan :value kilobytes.',
        'numeric' => ':Attribute moet kleiner of gelijk zijn aan :value.',
        'string'  => ':Attribute moet maximaal :value tekens bevatten.',
    ],
    'mac_address'          => ':Attribute moet een geldig MAC-adres zijn.',
    'max'                  => [
        'array'   => ':Attribute mag niet meer dan :max waardes bevatten.',
        'file'    => ':Attribute mag niet meer dan :max kilobytes zijn.',
        'numeric' => ':Attribute mag niet hoger dan :max zijn.',
        'string'  => ':Attribute mag niet uit meer dan :max tekens bestaan.',
    ],
    'mimes'                => ':Attribute moet een bestand zijn van het bestandstype :values.',
    'mimetypes'            => ':Attribute moet een bestand zijn van het bestandstype :values.',
    'min'                  => [
        'array'   => ':Attribute moet minimaal :min waardes bevatten.',
        'file'    => ':Attribute moet minimaal :min kilobytes zijn.',
        'numeric' => ':Attribute moet minimaal :min zijn.',
        'string'  => ':Attribute moet minimaal :min tekens zijn.',
    ],
    'multiple_of'          => ':Attribute moet een veelvoud van :value zijn.',
    'not_in'               => ':Attribute is ongeldig.',
    'not_regex'            => 'Het formaat van :attribute is ongeldig.',
    'numeric'              => ':Attribute moet een getal zijn.',
    'password'             => 'Wachtwoord is onjuist.',
    'present'              => ':Attribute moet aanwezig zijn.',
    'prohibited'           => ':Attribute is niet toegestaan.',
    'prohibited_if'        => ':Attribute is niet toegestaan indien :other gelijk is aan :value.',
    'prohibited_unless'    => ':Attribute is niet toegestaan tenzij :other gelijk is aan :values.',
    'prohibits'            => ':Attribute is niet toegestaan in combinatie met :other.',
    'regex'                => 'Het formaat van :attribute is ongeldig.',
    'required'             => ':Attribute is verplicht.',
    'required_array_keys'  => ':Attribute moet waardes bevatten voor :values.',
    'required_if'          => ':Attribute is verplicht indien :other gelijk is aan :value.',
    'required_unless'      => ':Attribute is verplicht tenzij :other gelijk is aan :values.',
    'required_with'        => ':Attribute is verplicht in combinatie met :values.',
    'required_with_all'    => ':Attribute is verplicht in combinatie met :values.',
    'required_without'     => ':Attribute is verplicht als :values niet ingevuld is.',
    'required_without_all' => ':Attribute is verplicht als :values niet ingevuld zijn.',
    'same'                 => ':Attribute en :other moeten overeenkomen.',
    'size'                 => [
        'array'   => ':Attribute moet :size waardes bevatten.',
        'file'    => ':Attribute moet :size kilobytes groot zijn.',
        'numeric' => ':Attribute moet :size zijn.',
        'string'  => ':Attribute moet :size tekens zijn.',
    ],
    'starts_with'          => ':Attribute moet beginnen met een van de volgende: :values.',
    'string'               => ':Attribute moet een tekst zijn.',
    'timezone'             => ':Attribute moet een geldige tijdzone zijn.',
    'unique'               => ':Attribute is al in gebruik.',
    'uploaded'             => 'Het uploaden van :attribute is mislukt.',
    'url'                  => ':Attribute moet een geldige URL zijn.',
    'uuid'                 => ':Attribute moet een geldige UUID zijn.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        
        // update-profile-organization-form.blade.php
        // update-profile-personal-form.blade.php
        'state.about' => 'Omschrijving', 
        'state.motivation' => 'Motivatie',   
        'languages' => 'Taal-selectie',
        'state.date_of_birth' => 'Geboortedatum',
        'socialsOptionSelected' => 'Social Media',
        'userOnSocial' => 'Profiel op social media',

        // UpdateProfileLocationForm.php
        'country' => 'Land',
        'division' => 'Provincie',
        'city' => 'Plaats',
        'district' => 'Buurt',
        'noCityOptions' => 'geen plaats beschikbaar'
    ],

];