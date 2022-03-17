<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('guest.home');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth') //controllo se sono loggato
    ->namespace('Admin')
    ->name('admin.') //name
    ->prefix('admin') //uri
    ->group(function () {
        Route::get('/', 'PostController@index')
            ->name('home');
        // Route::get('/', 'HomeController@index')
        //     ->name('home');
        Route::get('/my-posts', 'PostController@filter')
        ->name('posts.myPosts');
        Route::get('posts/user-post/{id}', "PostController@topUserPosts")->name('posts.topUserPosts');
        
        // Route::get('/categories', 'CategoryController@index')->name("categories.index");
        // Route::get('/categories/{category}', 'CategoryController@show')->name("categories.show");
        
        Route::resource('categories', 'CategoryController');
        Route::resource('posts', 'PostController');
    });

    Route::get("{any?}", function () {
        return view("guest.home");
      })->where("any", ".*");