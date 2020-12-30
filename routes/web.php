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
//     return view('User.registration');
// });



Route::get('/registration','HomeController@Registration')->name('user.register');
Route::post('/registration','HomeController@Register');

Route::get('/login','HomeController@Login')->name('user.login');
Route::post('/login','HomeController@ValidateLogin');
Route::get('/social','HomeController@LoadFacebook');

//Route::get('/dashboard','HomeController@FacebookResponse')->name('teacher.dashboard');
