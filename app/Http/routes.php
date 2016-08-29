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

Route::get('/',  [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);
// Route::get('/', 'HomeController@index')->name('home');

Route::auth();
//Route::resource('events', 'EventController');
/*
Route::resource('events', 'EventController', ['parameters' => [
    'user' => 'admin_user'
]]);
*/
//Route::resource('events\user', 'Visitor\EventController');

Route::group(['namespace' => 'Utility', 'prefix' => 'api'], function() { // 'middleware' => 'auth'
    Route::get('map/json',  ['uses' => 'ApiController@getEventsJSON', 'as' => 'api.events']);
});

Route::group(['namespace' => 'Visitor', 'prefix' => 'user', 'as' => 'visitor::'], function() { // 'middleware' => 'auth'
    Route::get('events',  ['uses' => 'EventController@index', 'as' => 'events.index']);
    //Route::get('events/sort',  ['uses' => 'EventController@sort', 'as' => 'visitor.events.sort']);
    Route::get('events/{events}',  ['uses' => 'EventController@show', 'as' => 'events.show']);
    Route::get('events/poster/{name}',  ['uses' => 'EventController@getPosterForCarousel', 'as' => 'events.poster']); //posterForCarousel
});

Route::group(['namespace' => 'Organiser', 'prefix' => 'organiser', 'as' => 'organiser::'], function() { // 'middleware' => 'auth'
    Route::get('events/poster/{name}',  ['uses' => 'EventController@getPosterForCarousel', 'as' => 'events.poster']);
    Route::resource('events', 'EventController'); // route name: eg: organiser::events.store
});


/*
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() { // 'middleware' => 'auth'
    Route::get('events',  ['uses' => 'EventController@index', 'as' => 'admin.event.index']);
    Route::get('events/{events}',  ['uses' => 'EventController@show', 'as' => 'admin.event.show']);
});
*/

/*
Hello {{ Auth::user->name }}
// name coumn of the user table
*/

/*
{{ Auth::check()?"Logged In":"Logged Out" }}
[OR]
@if (Auth::check())
// ...
@else
// ...
<a href="{{ route('login') }}">
@endif
*/

// route helper eg:
// <a href="{{ route('login') }}">
// ie: a route named 'login'


/*
// Authentication routes
Route::get('auth/login', 'Auth/AuthController@getLogin');
Route::post('auth/login', 'Auth/AuthController@postLogin');
Route::get('auth/logout', 'Auth/AuthController@getLogout');

// Registration routes
Route::get('auth/register', 'Auth/AuthController@getRegister');
Route::post('auth/register', 'Auth/AuthController@postRegister');
*/

//Route::group(['middleware' => 'web'], function() {
  // No need since all routes are by default in the web middleware
  //Route::auth();
  //Route::get('/home', 'HomeController@index');
//});

/*
Route::get('map', '');
Route::get('login', '');
Route::get('signup', '');
Route::get('register', '');
Route::get('events', '');
*/
