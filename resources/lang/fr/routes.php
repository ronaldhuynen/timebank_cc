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
    "welcome" => "bienvenue",
    "goodbye-deleted-user" => "au-revoir",
    'dashboard' => 'tableau-de-bord',
    'pay' => 'payez',
    'pay-to-name' => 'payez/{name}',
    'pay-amount-to-name' => 'payez/{hours}/{minutes}/a/{name}',
    'transactions' => 'transactions',
    'statement' => 'releve/{transactionId}',
    'posts.manage' => 'articles/gerer',
    'post.show_by_id' => 'article/{postId}',
    'post.show_by_slug' => 'article/{slug}',
    'user.show' => 'utilisateur/{userId}',
    'org.show' => 'organisation/{orgId}',
    'user.edit' => 'utilisateur/modifier',
    'org.edit' => 'organisation/modifier',
    'users-overview' => 'apercu-utilisateurs',
    'user.show' => 'utilisateur/{userId}',
    'search.show' => 'recherche',
    'messenger.join' => 'messager/invitation/{invite}',
    'terms.show' => 'conditions-d-utilisation',
    'policy.show' => 'politique-de-confidentialite',
    'profile.show' => 'utilisateur/parametres',
    'show.by.name' => '{name}',








];
