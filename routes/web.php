<?php

use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Admin Routes
Route::group(
    ['middleware' => 'admin'],
    function () {
        Route::get('admin/home', 'Admin\HomeController@index')->name('admin.route');
        Route::resource('users', 'Admin\UserController');
    });
Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('posts/create','PostController@create')->name('posts.create');
        Route::post('posts/store','PostController@store')->name('posts.store');
        Route::get('posts/edit/{post_id}','PostController@edit')->name('posts.edit');
        Route::patch('posts/update/{post_id}','PostController@update')->name('posts.update');
        Route::delete('posts/destroy/{post_id}','PostController@destroy')->name('posts.destroy');
    });
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts','PostController@index')->name('posts.index');

Route::get('tags/{tag_id}/posts','TagController@tagpost');
