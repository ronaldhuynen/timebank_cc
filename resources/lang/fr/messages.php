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

    'English' => 'Anglais',
    'Dutch' => 'Néerlandais',
    'Spanish' => 'Espagnol',
    'French' => 'Français',
    'German' => 'Allemand',


    'good' => 'bon',
    'limited' => 'limité',

    'Your_profile_has_received_a_star' => 'Votre profil a reçu une étoile',
    'Your_profile_has_been_deleted' => 'Votre profil a été supprimé',

    // pay.blade.php
    'pay_confirm' => 'Transférer :amount au compte :toAccountName de :toHolderName ?',
    'pay_limit_error_budget_from' => 'Désolé, votre solde est trop faible pour ce transfert. Votre solde ne peut pas descendre en dessous de :limitMinFrom. Montant maximum possible pour le transfert : :transferBudgetFrom.',
    'pay_limit_error_budget_from_and_to' => 'Désolé, votre solde est trop faible pour ce transfert. Votre solde ne peut pas descendre en dessous de :limitMinFrom. De plus, cela dépasserait également le solde maximum du compte bénéficiaire. Montant maximum possible pour le transfert : :transferBudgetTo.',
    'pay_limit_error_budget_from_and_to_without_budget_to' => 'Désolé, votre solde est trop faible pour ce transfert. Votre solde ne peut pas descendre en dessous de :limitMinFrom. De plus, cela dépasserait également le solde maximum du compte bénéficiaire.',
    'pay_limit_error_budget_to' => 'Désolé, ce transfert dépasserait le solde maximum du compte bénéficiaire. Montant maximum possible pour le transfert : :transferBudgetTo.',
    'pay_limit_error_budget_to_without_budget_to' => 'Désolé, ce transfert dépasserait le solde maximum du compte bénéficiaire. Veuillez contacter :toHolderName pour savoir quoi faire.',
    'pay_chat_message' => 'Bonjour, je viens de payer :amount sur votre :account_name',

    // single-transaction.blade.php
    'qr_transaction_info' => ':from_relation et :to_relation peuvent vérifier cette transaction en scannant le code.',

    // transactions-table.blade.php
    'transactions_found' => '{0} Aucune transaction|{1} :count transaction au total|[2,*] :count transactions au total',



];
