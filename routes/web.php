<?php
use App\User;
use App\MediaOriginal;
use App\MediaTranslated;
use App\Post;
use App\Page;
use App\Category;
use App\Block;
use App\School;
use App\Activity;
use App\Promotion;
use App\Gallery;
use App\Perk;
use App\Registry;
use App\Picture;
use App\Configuration;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/flush-session', [ 'uses' => 'PublicController@flushSession']);


$locale = '';
$segment = Request::segment(1);

if (in_array($segment, Config::get('app.locales')) &&
    $segment != Config::get('app.fallback_locale')) {
    App::setLocale($segment);
    $locale = $segment;
}

Route::group([
        'prefix' => $locale
    ], function () {
    // HOME --------------------------------------
    Route::get('/', [
        'as' => 'home',
        'uses' => 'PublicController@pageHome'
    ]);

    // PAGES --------------------------------------
    Route::get('/alumni', [ 'as' => 'alumni', 'uses' => 'PublicController@pageAlumni']);
    Route::get('/activitats', [ 'as' => 'activitats', 'uses' => 'PublicController@pageActivitats']);
    Route::post('/buscar-activitats', [ 'as' => 'search-activitats', 'uses' => 'PublicController@searchActivitats']);
    Route::get('/avantatges', [ 'as' => 'avantatges', 'uses' => 'PublicController@pageAvantatges']);
    Route::post('/save-registry', [ 'as' => 'save-registry', 'uses' => 'RegistryController@saveRegistry']);
    Route::post('/accept-registry', [ 'as' => 'accept-registry', 'uses' => 'RegistryController@acceptRegistry']);
    Route::post('/deny-registry', [ 'as' => 'deny-registry', 'uses' => 'RegistryController@denyRegistry']);
    Route::get('/contacte', [ 'as' => 'contacte', 'uses' => 'PublicController@pageContact']);
    Route::post('/contact-send', [ 'as' => 'contact-send', 'uses' => 'PublicController@sendContact']);

    // SINGLES --------------------------------------
    Route::get('/activitat/{slug}', [
        'as' => 'activity-single',
        'uses' => 'PublicController@singleActivity'
    ]);

    // LEGAL --------------------------------------
    Route::get('/privacy', [ 'as' => 'privacy', 'uses' => 'PublicController@pagePrivacy']);
    Route::get('/cookies', [ 'as' => 'cookies', 'uses' => 'PublicController@pageCookies']);
    Route::get('/returns', [ 'as' => 'returns', 'uses' => 'PublicController@pageReturns']);

});





Route::get('logout','PublicController@frontLogout');
Auth::routes();

Route::group(
    [
        'middleware' => ['admin','web','auth'],
        'namespace' => 'Admin',
        'prefix' => 'admin'
    ], function () {
        Route::get('/', 'HomeController@index');
        Route::get('logout','UserController@frontLogout');

        // Mailing --------------------------------------
        Route::get('/mailing/contact', 'MailingController@contact'); 
        Route::get('/mailing/registry', 'MailingController@registry'); 
        Route::get('/mailing/user-accepted', 'MailingController@userAccepted'); 
        Route::get('/mailing/user-denied', 'MailingController@userDenied'); 

        // Users
        Route::get('/user/trash', 'UserController@trash'); 
        Route::delete('/user/soft-delete/{id}', 'UserController@softDelete'); 
        Route::get('/user/restore/{id}', 'UserController@restore'); 
        Route::get('/user-teacher', 'UserController@indexTeacher');
        Route::get('/user-student', 'UserController@indexStudent');
        Route::get('/user-admin', 'UserController@indexAdmin');
        Route::resource('/user', 'UserController');


        // Roles
        Route::resource('/role', 'RoleController');

        // Media Formats
        Route::resource('/media-extension', 'MediaExtensionController');

        // Uploads
        Route::get('/upload/media-originals', 'UploadController@getMediaOriginals');
        Route::get('/upload/media-translated', 'UploadController@getMediaTranslateds');
        Route::get('/upload/media-extensions', 'UploadController@getMediaExtensions');
        Route::get('/upload/media-html', 'UploadController@getMediaHtml');

        // Posts
        $class = new Post; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource($route, $controller);

        // Media Originals
        $class = new MediaOriginal; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::resource('/' . $route, $controller);

        // Media Translateds
        $class = new MediaTranslated; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::resource('/' . $route, $controller);

        // Page
        $class = new Page; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);

        // Category
        $class = new Category; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::resource('/' . $route, $controller);

        // Block
        $class = new Block; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);
        
        // School
        $class = new School; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);
        
        // Activity
        $class = new Activity; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);
        
        // Promotion
        $class = new Promotion; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);
        
        // Gallery
        $class = new Gallery; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);
    
        // Perk
        $class = new Perk; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);
    
        // Registry
        $class = new Registry; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);
    
        // Picture
        $class = new Picture; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);
    
        // Configuration
        $class = new Configuration; $controller = $class->getControllerName(); $route = str_slug($class->getSingularTableName());
        Route::get('/' . $route . '/trash', $controller . '@trash'); Route::delete('/' . $route . '/soft-delete/{id}', $controller . '@softDelete'); Route::get('/' . $route . '/restore/{id}', $controller . '@restore'); Route::get('/' . $route . '/order/{order}', $controller . '@order'); Route::post('/' . $route . '/upload', $controller . '@upload'); Route::resource('/' . $route, $controller);
    });



