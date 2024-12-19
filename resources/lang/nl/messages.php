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

    'English' => 'Engels',
    'Dutch' => 'Nederlands',
    'Spanish' => 'Spaans',
    'French' => 'Frans',
    'German' => 'Duits',

    'good' => 'goed',
    'limited' => 'beperkt',

    'Your_profile_has_received_a_star' => 'Je profiel heeft een ster ontvangen',
    'Your_profile_has_been_deleted' => 'Je profiel is verwijderd',

    // pay.blade.php
    'pay_confirm' => 'Overboeken :amount naar de :toAccountName rekening van :toHolderName?',
    'pay_limit_error_budget_from' => 'Sorry, je saldo is te laag voor deze overboeking. Je saldo mag niet onder :limitMinFrom komen. Maximale overdrachtsbedrag mogelijk: :transferBudgetFrom.',
    'pay_limit_error_budget_from_and_to' => 'Sorry, je saldo is te laag voor deze overboeking. Je saldo mag niet onder :limitMinFrom komen. Bovendien zou dit ook het maximale saldo van de ontvangende rekening overschrijden. Maximale overdrachtsbedrag mogelijk: :transferBudgetTo.',
    'pay_limit_error_budget_from_and_to_without_budget_to' => 'Sorry, je saldo is te laag voor deze overboeking. Je saldo mag niet onder :limitMinFrom komen. Bovendien zou dit ook het maximale saldo van de ontvangende rekening overschrijden.',
    'pay_limit_error_budget_to' => 'Sorry, deze overboeking zou het maximale saldo van de ontvangende rekening overschrijden. Maximale overdrachtsbedrag mogelijk: :transferBudgetTo.',
    'pay_limit_error_budget_to_without_budget_to' => 'Sorry, deze overboeking zou het maximale saldo van de ontvangende rekening overschrijden. Neem contact op met :toHolderName om te overleggen wat te doen.',
    'pay_chat_message' => 'Hallo, ik heb zojuist :amount naar je :account_name overgemaakt',

    // single-transaction.blade.php
    'qr_transaction_info' => ':from_relation en :to_relation kunnen deze transactie verifiëren door de code te scannen.',

    // transactions-table.blade.php
    'transactions_found' => '{0} Geen transacties|{1} :count transactie in totaal|[2,*] :count transacties in totaal',

];
