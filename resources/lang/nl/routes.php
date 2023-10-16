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
    "dashboard"    =>  "overzicht",
    "article"  =>  "gebruiker/{userId}",
];
