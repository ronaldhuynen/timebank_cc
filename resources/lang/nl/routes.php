<?php

/*
|--------------------------------------------------------------------------
| Localized routes to be used with mcamara/laravel-localization
|--------------------------------------------------------------------------
|
| You may translate your routes. For example, http://url/en/about and http://url/es/acerca
| (acerca is about in spanish) or http://url/en/article/important-article and
| http://url/es/articulo/important-article (article is articulo in spanish) would
| be redirected to the same controller/view as follows:
| It is necessary that at least the localize middleware in loaded in your
| Route::group middleware (See installation instruction).
|
| For each language, add a routes.php into resources/lang/[**]/routes.php folder.
| The file contains an array with all translatable routes.
|
*/


return [
    "welcome" => "welkom",
    "goodbye-deleted-user" => "tot-ziens",
    'dashboard' => 'overzicht',
    'pay' => 'betaal',
    'pay-to-name' => 'betaal/{name}',
    'transactions' => 'transacties',
    'statement' => 'transactie/{transactionId}',
    'posts.manage' => 'artikelen/beheren',
    'post.show_by_id' => 'artikel/{id}',
    'post.show_by_slug' => 'artikel/{slug}',
    'user.show' => 'gebruiker/{id}',
    'org.show' => 'organisatie/{id}',
    'user.edit' => 'gebruiker/bewerken',
    'org.edit' => 'organisatie/bewerken',
    'users-overview' => 'gebruikers-overzicht',
    'search.show' => 'zoeken',
    'messenger.join' => 'messenger/uitnodiging/{invite}',
    'terms.show' => 'algemene-voorwaarden',
    'policy.show' => 'privacybeleid',
    'profile.show' => 'gebruiker/instellingen',
    'show.by.name' => '{name}',



];
