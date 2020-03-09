<?php

use Illuminate\Support\Facades\Route;
use App\Mail\NewUserWelcome;


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


Auth::routes();
Route::get('/email',function(){
    return new NewUserWelcome();
});


Route::post('follow/{user}','FollowsController@store');
Route::get('/','PostsController@index');
Route::get('/p/create','PostsController@create');
Route::post('/p','PostsController@store');
Route::get('/p/{post}','PostsController@show'); //id bta3 el post

Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.patch');


Route::get('test' , function(){
    $user = App\User::find(1);
    Mail::to($user->email)->send(new NewUserWelcome());
});