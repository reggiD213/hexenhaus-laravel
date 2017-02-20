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

Route::resource('pics', 'PicsController');

Route::resource('newsfeeds', 'NewsfeedsController');


//auth pages
Route::get('members', ['uses' => 'MembersController@index', 'as' => 'members']);
Auth::routes();
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