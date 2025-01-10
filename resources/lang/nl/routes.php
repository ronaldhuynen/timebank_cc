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
    'pay-amount-to-name' => 'betaal/{hours}/{minutes}/aan/{name}',
    'pay-amount-to-name-description' => 'betaal/{hours}/{minutes}/aan/{name}/omschrijving/{description}',
    'transactions' => 'transacties',
    'statement' => 'transactie/{transactionId}',
    'posts.manage' => 'artikelen/beheren',
    'post.show_by_id' => 'artikel/{id}',
    'post.show_by_id_international' => 'post/{id}',
    'post.show_by_slug' => 'artikel/{slug}',
    'categories.manage' => 'categorieen/beheren',
    'tags.manage' => 'labels/beheren',
    'permissions.manage' => 'rechten/beheren',
    'roles.manage' => 'rollen/beheren',

    'static.getting-started' => 'starten',
    'static.faq' => 'vraag-en-antwoord',
    'static.organizations' => 'organizaties',
    'static.principles' => 'principes',
    'static.the-hague' => 'den-haag',
    'static.lekkernassuh' => 'lekkernassuh',
    'static.amst-brus-lisb' => 'amsterdam-brussel-lissabon',
    'static.work-w-us' => 'werk-bij-ons',
    'static.philosophy' => 'filosofie',
    'static.association' => 'vereniging',
    'static.history' => 'geschiedenis',
    'static.press-media' => 'pers-en-media',
    'static.research' => 'onderzoek',
    'static.team' => 'team',
    'static.messenger' => 'messenger',
    
    'user.show' => 'gebruiker/{id}',
    'org.show' => 'organisatie/{id}',
    'user.edit' => 'gebruiker/bewerken',
    'org.edit' => 'organisatie/bewerken',
    'bank.edit' => 'bank/bewerken',
    'admin.edit' => 'admin/bewerken',
    'users-overview' => 'gebruikers-overzicht',
    'search.show' => 'zoeken',
    'messenger.join' => 'messenger/uitnodiging/{invite}',
    'terms.show' => 'algemene-voorwaarden',
    'policy.show' => 'privacybeleid',
    'profile.user.show' => 'gebruiker/instellingen',
    'profile.org.show' => 'organisatie/instellingen',
    'profile.bank.show' => 'bank/instellingen',
    'profile.admin.show' => 'admin/instellingen',
    'show.by.name' => 'gebruiker/{name}',

    'messenger.portal' => 'messenger',
    'messenger.show' => 'messenger/{thread}',
    'messenger.private.create' => 'messenger/recipient/{alias}/{id}',
    'messenger.threads.show.call' => 'messenger/threads/{thread}/calls/{call}',
    'messenger.join.invite' => 'messenger/meedoen/{invite}',

];
