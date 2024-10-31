<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messages Language Lines
    |--------------------------------------------------------------------------
    |
    | Messages that can be addressed by variables.
    | Useful to translate fetched strings from the database.
    | Usage:
    | $language = 'Dutch'
    | __('messages.' . $language)
    | // 'Nederlands'
    */

    'Dutch' => 'Nederlands',
    'English' => 'Engels',
    'French' => 'Frans',
    'German' => 'Duits',
    'Spanish' => 'Spaans',

    'good' => 'goed',
    'limited' => 'beperkt',

    'past year' => 'afgelopen jaar',

    'Your_profile_has_received_a_star' => 'Je profiel heeft een ster ontvangen',
    'Your_profile_has_been_deleted' => 'Je profiel is verwijderd',

    // pay.blade.php
    'pay_confirm' => 'Maak :amount over naar de :toAccountName rekening van :toHolderName?',
    'pay_limit_error_budget_from' => 'Sorry, je saldo is te laag voor deze transactie. Je saldo kan niet lager zijn dan :limitMinFrom. Het maximale transactie bedrag dat mogelijk is: :transferBudgetFrom.',
    'pay_limit_error_budget_from_and_to' => 'Sorry, je saldo is te laag voor deze transactie. Je saldo kan niet lager zijn dan :limitMinFrom. Bovendien zou deze transactie het maximale saldo van de ontvanger overschrijden. Het maximale transactie bedrag dat mogelijk is: :transferBudgetTo.',
    'pay_limit_error_budget_to' => 'Sorry, this transfer would exceed the maximum balance of the receiving account. Maximum transfer amount possible: :transferBudgetTo.',

    // single-transaction.blade.php
    'qr_transaction_info' => ':from_relation en :to_relation kunnen deze transactie controleren door de code te scannen.',



];
