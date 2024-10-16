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
    'transactions' => 'transacciones',
    'statement' => 'estado/{transactionId}',
    'posts.manage' => 'publicaciones/administrar',
    'post.show_by_id' => 'publicacion/{postId}',
    'post.show_by_slug' => 'publicacion/{slug}',
    'user.show' => 'usuario/{userId}',
    'org.show' => 'organizacion/{orgId}',
    'user.edit' => 'usuario/editar',
    'org.edit' => 'organizacion/editar',
    'users-overview' => 'resumen-usuarios',
    'user.show' => 'usuario/{userId}',
    'search.show' => 'buscar',
    'messenger.join' => 'mensajero/invitacion/{invite}',
    'terms.show' => 'terminos-de-servicio',
    'policy.show' => 'politica-de-privacidad',
    'profile.show' => 'usuario/configuraciones',
    'show.by.name' => '{name}',


];
