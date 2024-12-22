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
    "welcome" => "bienvenido",
    "goodbye-deleted-user" => "adios",
    'dashboard' => 'salpicadero',
    'pay' => 'pagar',
    'pay-to-name' => 'pagar/{name}',
    'pay-amount-to-name' => 'paga/{hours}/{minutes}/a/{name}',
    'pay-amount-to-name-description' => 'paga/{hours}/{minutes}/a/{name}/definicion/{description}',
    'transactions' => 'transacciones',
    'statement' => 'estado/{transactionId}',
    'posts.manage' => 'publicaciones/administrar',
    'post.show_by_id' => 'publicacion/{id}',
    'post.show_by_id_international' => 'post/{id}',
    'post.show_by_slug' => 'publicacion/{slug}',
    
    'static.getting-started' => 'empezar',
    'static.faq'=> 'preguntas-frecuentes',
    'static.organizations'=> 'organizaciones',
    'static.principles'=> 'principios',
    'static.the-hague'=> 'la-haya',
    'static.lekkernassuh'=> 'lekkernassuh',
    'static.amst-brus-lisb'=> 'amsterdam-bruselas-lisboa',
    'static.work-w-us'=> 'trabaja-con-nosotros',
    'static.philosophy'=> 'filosofía',
    'static.association'=> 'asociación',
    'static.history' => 'historia',
    'static.press-media' => 'prensa-medios',
    'static.research'=> 'investigación',
    'static.team'=> 'equipo',
    'static.messenger'=> 'mensajero',

    'user.show' => 'usuario/{id}',
    'org.show' => 'organizacion/{id}',
    'user.edit' => 'usuario/editar',
    'org.edit' => 'organizacion/editar',
    'users-overview' => 'resumen-usuarios',
    'user.show' => 'usuario/{id}',
    'search.show' => 'buscar',
    'messenger.join' => 'mensajero/invitacion/{invite}',
    'terms.show' => 'terminos-de-servicio',
    'policy.show' => 'politica-de-privacidad',
    'profile.user.show' => 'usuario/configuraciones',
    'profile.org.show' => 'organizacion/configuraciones',
    'profile.admin.show' => 'admin/configuraciones',
    'show.by.name' => '{name}',

    'messenger.portal' => 'messenger',
    'messenger.show' => 'messenger/{thread}',
    'messenger.private.create' => 'messenger/recipient/{alias}/{id}',
    'messenger.threads.show.call' => 'messenger/threads/{thread}/calls/{call}',
    'messenger.join.invite' => 'mensajero/unirse/{invite}',
];
