<?php

$locale = '';
$segment = Request::segment(1);

if (in_array($segment, Config::get('app.locales')) &&
    $segment != Config::get('app.fallback_locale')) {
    App::setLocale($segment);
    $locale = $segment;
}

Route::group(
    [
        'middleware' => ['web','auth','intranet'],
        'namespace' => 'Intranet',
        'prefix' => $locale.'/intranet'
    ], function () {
        Route::get('/', ['as' => 'dashboard', 'uses' => 'IntranetController@dashboard']);

        Route::post('/mark-as-read', ['as' => 'mark-as-read', 'uses' => 'IntranetController@markAsRead']);

        Route::get('/perfil', ['as' => 'profile', 'uses' => 'UserController@viewProfile']);
        Route::get('/edit-profile', ['as' => 'edit-profile', 'uses' => 'UserController@editProfile']);
            Route::post('/update-profile', ['as' => 'update-profile', 'uses' => 'UserController@updateProfile']);
            Route::post('/update-image', ['as' => 'update-image', 'uses' => 'UserController@updateImage']);
            Route::post('/update-password', ['as' => 'update-password', 'uses' => 'UserController@updatePassword']);
            Route::post('/add-studies', ['as' => 'add-studies', 'uses' => 'UserController@addStudies']);
            Route::post('/add-school', ['as' => 'add-school', 'uses' => 'UserController@addSchool']);
            Route::post('/change-promotion', ['as' => 'change-promotion', 'uses' => 'UserController@changePromotion']);

        Route::get('/galeria', ['as' => 'gallery', 'uses' => 'IntranetController@viewGallery']);
            Route::post('/buscar-galeria', ['as' => 'search-gallery', 'uses' => 'GalleryController@searchGallery']);
            Route::get('/crear-galeria', ['as' => 'create-gallery-front', 'uses' => 'GalleryController@createGalleryFront']);
            Route::post('/guardar-galeria', ['as' => 'save-gallery-front', 'uses' => 'GalleryController@saveGalleryFront']);
            Route::post('/etiquetar-usuaris', ['as' => 'tag-users', 'uses' => 'GalleryController@tagUsers']);
            Route::post('/eliminar-etiqueta', ['as' => 'delete-tag', 'uses' => 'GalleryController@deleteTag']);
            Route::post('/afegir-descripcio', ['as' => 'add-description', 'uses' => 'GalleryController@addDescription']);
            Route::post('/afegir-fotos', ['as' => 'add-pictures', 'uses' => 'GalleryController@addPictures']);
            Route::delete('/eliminar-foto', ['as' => 'delete-picture', 'uses' => 'GalleryController@deletePicture'] );


        Route::get('/promocio', ['as' => 'promotion', 'uses' => 'UserController@viewPromotion']);
        Route::get('/avantatges', ['as' => 'perks', 'uses' => 'IntranetController@viewPerks']);
            Route::get('/buscar-avantatges', ['as' => 'search-perks', 'uses' => 'IntranetController@searchPerks']);

        // SINGLES
        Route::get('/galeria/{slug}', [
            'as' => 'gallery-single',
            'uses' => 'IntranetController@singleGallery'
        ]);
        Route::get('/galeria/{slug}/{id}', [
            'as' => 'picture-single',
            'uses' => 'IntranetController@singlePicture'
        ]);


        // FORMS


        Route::post('/send-message', ['as' => 'chat-message', 'uses' => 'ChatsController@sendMessage']);
        Route::post('/delete-message', ['as' => 'delete-message', 'uses' => 'ChatsController@deleteMessage']);
        Route::post('/load-messages', ['as' => 'load-messages', 'uses' => 'ChatsController@loadMessages']);
    });



?>
