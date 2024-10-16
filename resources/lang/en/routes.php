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
    "welcome" => "welcome",
    "goodbye-deleted-user" => "goodbye",
    "dashboard"    =>  "dashboard",
    "pay" => "pay",
    'pay-to-name' => 'pay/{name}',
    'pay-amount-to-name' => 'pay/{hours}/{minutes}/to/{name}',
    'transactions' => 'transactions',
    'statement' => 'statement/{transactionId}',
    'posts.manage' => 'posts/manage',
    'post.show_by_id' => 'post/{id}',
    'post.show_by_slug' => 'post/{slug}',
    'user.show' => 'user/{id}',
    'org.show' => 'org/{id}',
    'user.edit' => 'user/edit',
    'org.edit' => 'org/edit',
    'users-overview' => 'users-overview',
    'search.show' => 'search',
    'terms.show' => 'terms-of-service',
    'policy.show' => 'privacy-policy',
    'profile.show' => 'user/settings',
    'show.by.name' => '{name}',

    'messenger.portal' => 'messenger',
    'messenger.show' => 'messenger/{thread}',
    'messenger.private.create' => 'messenger/recipient/{alias}/{id}',
    'messenger.threads.show.call' => 'messenger/threads/{thread}/calls/{call}',
    'messenger.join.invite' => 'messenger/join/{invite}',





];
