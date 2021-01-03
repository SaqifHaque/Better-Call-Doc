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



Route::get('/registration','HomeController@Registration')->name('home.registration');
Route::post('/registration','HomeController@Register');

Route::get('/login','HomeController@Login')->name('home.login');
Route::post('/login','HomeController@ValidateLogin');

Route::get('/pincode','HomeController@Pincode')->name('home.pincode');
Route::post('/pincode','HomeController@CheckPin');

Route::get('/social','HomeController@LoadFacebook');

Route::get('/userdash', 'UserController@UserDash')->name('user.userdash');

Route::get('/appointment/{id}', 'UserController@DoctorDetails')->name('user.doctor');


//Route::get('/dashboard','HomeController@FacebookResponse')->name('teacher.dashboard');
