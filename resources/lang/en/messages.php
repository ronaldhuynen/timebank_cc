
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
    | $language = 'Dutch';
    | __('messages.' . $language)
    |
    */

    'Dutch' => 'Dutch',
    'English' => 'English',
    'French' => 'French',
    'German' => 'German',
    'Spanish' => 'Spanish',

    'good' => 'good',
    'limited' => 'limited',

    'Your_profile_has_received_a_star' => 'Your profile received a star',
    'Your_profile_has_been_deleted' => 'Your profile has been deleted',

    // pay.blade.php
    'pay_confirm' => 'Transfer :amount to the :toAccountName account of :toHolderName?',
    'pay_limit_error_budget_from' => 'Sorry, your balance is too low for this transfer. Your balance cannot go below :limitMinFrom. Maximum transfer amount possible: :transferBudgetFrom.',
    'pay_limit_error_budget_from_and_to' => 'Sorry, your balance is too low for this transfer. Your balance cannot go below :limitMinFrom. Moreover, it would also exceed the maximum balance of the receiving account. Maximum transfer amount possible: :transferBudgetTo.',
    'pay_limit_error_budget_from_and_to_without_budget_to' => 'Sorry, your balance is too low for this transfer. Your balance cannot go below :limitMinFrom. Moreover, it would also exceed the maximum balance of the receiving account.',
    'pay_limit_error_budget_to' => 'Sorry, this transfer would exceed the maximum balance of the receiving account. Maximum transfer amount possible: :transferBudgetTo.',
    'pay_limit_error_budget_to_without_budget_to' => 'Sorry, this transfer would exceed the maximum balance of the receiving account. Please contact :toHolderName what to do.',

    // single-transaction.blade.php
    'qr_transaction_info' => ':from_relation and :to_relation can verify this transaction by scanning the code.',

    // transactions-table.blade.php
    'transactions_found' => '{0} No transactions|{1} :count transaction in total|[2,*] :count transactions in total',

];
