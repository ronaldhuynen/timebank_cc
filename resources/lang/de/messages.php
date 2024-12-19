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

    'English' => 'Englisch',
    'Dutch' => 'Niederländisch',
    'Spanish' => 'Spanisch',
    'French' => 'Französisch',
    'German' => 'Deutsch',


    'good' => 'gut',
    'limited' => 'begrenzt',

    'Your_profile_has_received_a_star' => 'Ihr Profil hat einen Stern erhalten',
    'Your_profile_has_been_deleted' => 'Ihr Profil wurde gelöscht',

    // pay.blade.php
    'pay_confirm' => 'Überweise :amount auf das :toAccountName-Konto von :toHolderName?',
    'pay_limit_error_budget_from' => 'Entschuldigung, Ihr Guthaben ist für diese Überweisung zu niedrig. Ihr Guthaben darf :limitMinFrom nicht unterschreiten. Maximal möglicher Überweisungsbetrag: :transferBudgetFrom.',
    'pay_limit_error_budget_from_and_to' => 'Entschuldigung, Ihr Guthaben ist für diese Überweisung zu niedrig. Ihr Guthaben darf :limitMinFrom nicht unterschreiten. Außerdem würde dies den maximalen Kontostand des Empfängerkontos überschreiten. Maximal möglicher Überweisungsbetrag: :transferBudgetTo.',
    'pay_limit_error_budget_from_and_to_without_budget_to' => 'Entschuldigung, Ihr Guthaben ist für diese Überweisung zu niedrig. Ihr Guthaben darf :limitMinFrom nicht unterschreiten. Außerdem würde dies den maximalen Kontostand des Empfängerkontos überschreiten.',
    'pay_limit_error_budget_to' => 'Entschuldigung, diese Überweisung würde den maximalen Kontostand des Empfängerkontos überschreiten. Maximal möglicher Überweisungsbetrag: :transferBudgetTo.',
    'pay_limit_error_budget_to_without_budget_to' => 'Entschuldigung, diese Überweisung würde den maximalen Kontostand des Empfängerkontos überschreiten. Bitte kontaktieren Sie :toHolderName, um zu klären, was zu tun ist.',
    'pay_chat_message' => 'Hallo, ich habe gerade :amount auf Ihr :account_name überwiesen',

    // single-transaction.blade.php
    'qr_transaction_info' => ':from_relation und :to_relation können diese Transaktion überprüfen, indem sie den Code scannen.',

    // transactions-table.blade.php
    'transactions_found' => '{0} Keine Transaktionen|{1} :count Transaktion insgesamt|[2,*] :count Transaktionen insgesamt',

];
