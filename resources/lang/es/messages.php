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

    'English' => 'Inglés',
    'Dutch' => 'Neerlandés',
    'Spanish' => 'Español',
    'French' => 'Francés',
    'German' => 'Alemán',


    'good' => 'bueno',
    'limited' => 'limitado',

    'Your_profile_has_received_a_star' => 'Tu perfil ha recibido una estrella',
    'Your_profile_has_been_deleted' => 'Tu perfil ha sido eliminado',

    // pay.blade.php
    'pay_confirm' => '¿Transferir :amount a la cuenta :toAccountName de :toHolderName?',
    'pay_limit_error_budget_from' => 'Lo sentimos, tu saldo es demasiado bajo para esta transferencia. Tu saldo no puede bajar de :limitMinFrom. Importe máximo de transferencia posible: :transferBudgetFrom.',
    'pay_limit_error_budget_from_and_to' => 'Lo sentimos, tu saldo es demasiado bajo para esta transferencia. Tu saldo no puede bajar de :limitMinFrom. Además, también excedería el saldo máximo de la cuenta receptora. Importe máximo de transferencia posible: :transferBudgetTo.',
    'pay_limit_error_budget_from_and_to_without_budget_to' => 'Lo sentimos, tu saldo es demasiado bajo para esta transferencia. Tu saldo no puede bajar de :limitMinFrom. Además, también excedería el saldo máximo de la cuenta receptora.',
    'pay_limit_error_budget_to' => 'Lo sentimos, esta transferencia excedería el saldo máximo de la cuenta receptora. Importe máximo de transferencia posible: :transferBudgetTo.',
    'pay_limit_error_budget_to_without_budget_to' => 'Lo sentimos, esta transferencia excedería el saldo máximo de la cuenta receptora. Por favor, contacta a :toHolderName para saber qué hacer.',
    'pay_chat_message' => 'Hola, acabo de pagar :amount a tu :account_name',

    // single-transaction.blade.php
    'qr_transaction_info' => ':from_relation y :to_relation pueden verificar esta transacción escaneando el código.',

    // transactions-table.blade.php
    'transactions_found' => '{0} No hay transacciones|{1} :count transacción en total|[2,*] :count transacciones en total',





];
