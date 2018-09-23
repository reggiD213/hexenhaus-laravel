<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::singularResourceParameters();

Route::get('test', function() {
    return view('test', ['events' => App\Event::all()]);
});

//static pages
Route::get('apply', ['uses' => 'PagesController@apply', 'as' => 'apply']);
Route::get('contact', ['uses' => 'PagesController@contact', 'as' => 'contact']);
Route::get('about', ['uses' => 'PagesController@about', 'as' => 'about']);
Route::get('impressum', ['uses' => 'PagesController@impressum', 'as' => 'impressum']);

//dynamic pages
Route::get('events', function () {
    return redirect(route('events.index'));
});
Route::resource('events', 'EventsController', ['except' => ['index']]);
Route::get('/', ['uses' => 'EventsController@index', 'as' => 'events.index']);
Route::get('events_archive', ['uses' => 'EventsController@indexBygone', 'as' => 'events.index.archive']);

Route::resource('bands', 'BandsController', ['except' => ['show']]);

Route::post('pics', 'PicsController@store');
Route::delete('pics/{pic}', ['uses' =>'PicsController@destroy', 'as' => 'pics.destroy']);

//Route::resource('galleries', 'GalleriesController', ['except' => ['update', 'edit']]);
Route::post('galleries', ['uses' => 'GalleriesController@store', 'as' => 'galleries.store']);
Route::get('galleries', ['uses' => 'GalleriesController@index', 'as' => 'galleries.index']);
Route::get('galleries/create', ['uses' => 'GalleriesController@create', 'as' => 'galleries.create']);
Route::get('galleries/{event}', ['uses' => 'GalleriesController@show', 'as' => 'galleries.show']);
Route::delete('galleries/{event}', ['uses' => 'GalleriesController@destroy', 'as' => 'galleries.destroy']);
//Route::get('api/galleries/{event}', 'GalleriesController@getAjax');

Route::resource('newsfeeds', 'NewsfeedsController');

Route::resource('members', 'MembersController');

Route::resource('applications', 'ApplicationsController', ['except' => ['edit', 'update']]);
Route::get('applications/{application}/send', ['uses' => 'ApplicationsController@send', 'as' => 'applications.send']);

Route::resource('settings', 'SettingsController', ['only' => ['index', 'update']]);

//auth pages
//Route::get('members', ['uses' => 'MembersController@index', 'as' => 'members']);
Auth::routes();

Route::patch('users/{user}', ['uses' => 'UserController@update', 'as' => 'users.update']);
/*
+--------+-----------+---------------------------+----------------------+------------------------------------------------------------------------+--------------+
| Domain | Method    | URI                       | Name                 | Action                                                                 | Middleware   |
+--------+-----------+---------------------------+----------------------+------------------------------------------------------------------------+--------------+
|        | POST      | login                     |                      | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | GET|HEAD  | login                     | login                | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST      | logout                    | logout               | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST      | password/email            |                      | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | POST      | password/reset            |                      | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD  | password/reset            |                      | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | GET|HEAD  | password/reset/{token}    |                      | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET|HEAD  | register                  | register             | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST      | register                  |                      | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
+--------+-----------+---------------------------+----------------------+------------------------------------------------------------------------+--------------+
*/