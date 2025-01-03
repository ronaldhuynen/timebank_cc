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
    "welcome" => "willkommen",
    "goodbye-deleted-user" => "auf-wiedersehen",
    "dashboard" => "dashboard",
    "pay" => "bezahlen",
    'pay-to-name' => 'bezahlen/{name}',
    'pay-amount-to-name' => 'bezahlen/{stunden}/{minuten}/an/{name}',
    'pay-amount-to-name-description' => 'bezahlen/{stunden}/{minuten}/an/{name}/beschreibung/{beschreibung}',
    'transactions' => 'transaktionen',
    'statement' => 'auszug/{transaktionsId}',
    'posts.manage' => 'beiträge/verwalten',
    'post.show_by_id' => 'beitrag/{id}',
    'post.show_by_id_international' => 'beitrag/{id}',
    'post.show_by_slug' => 'beitrag/{slug}',

    'static.getting-started' => 'anfangen',
    'static.faq' => 'faq',
    'static.organizations' => 'organisationen',
    'static.principles' => 'prinzipien',
    'static.the-hague' => 'den-haag',
    'static.lekkernassuh' => 'lekkernassuh',
    'static.amst-brus-lisb' => 'amsterdam-brussel-lissabon',
    'static.work-w-us' => 'arbeiten-sie-mit-uns',
    'static.philosophy' => 'philosophie',
    'static.association' => 'vereinigung',
    'static.history' => 'histoire',
    'static.press-media' => 'presse-und-medien',
    'static.research' => 'forschung',
    'static.team' => 'team',
    'static.messenger' => 'messenger',

    'user.show' => 'benutzer/{id}',
    'org.show' => 'organisation/{id}',
    'user.edit' => 'benutzer/bearbeiten',
    'org.edit' => 'organisation/bearbeiten',
    'users-overview' => 'benutzerübersicht',
    'search.show' => 'suche',
    'terms.show' => 'nutzungsbedingungen',
    'policy.show' => 'datenschutzrichtlinie',
    'profile.user.show' => 'benutzer/einstellungen',
    'profile.org.show' => 'organisation/einstellungen',
    'profile.org.show' => 'bank/einstellungen',
    'profile.admin.show' => 'admin/einstellungen',
    'show.by.name' => 'benutzer/{name}',

    'messenger.portal' => 'messenger',
    'messenger.show' => 'messenger/{thread}',
    'messenger.private.create' => 'messenger/empfänger/{alias}/{id}',
    'messenger.threads.show.call' => 'messenger/threads/{thread}/anrufe/{anruf}',
    'messenger.join.invite' => 'messenger/beitreten/{einladung}',






];
