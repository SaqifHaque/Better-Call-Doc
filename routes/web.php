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


//auth

Route::get('/registration','HomeController@Registration')->name('home.registration');
Route::post('/registration','HomeController@Register');

Route::get('/login','HomeController@Login')->name('home.login');
Route::post('/login','HomeController@ValidateLogin');

Route::get('/pincode','HomeController@Pincode')->name('home.pincode');
Route::post('/pincode','HomeController@CheckPin');

Route::get('/facebook','HomeController@LoadFacebook');
Route::get('/facebook-response','HomeController@FacebookResponse');

Route::group(['middleware'=>['session']], function(){

    Route::get('/chat','ChatController@chat');

    Route::post('/send','ChatController@send');
    
    Route::group(['middleware'=>['patient']], function(){
        //user

        Route::get('/userdash', 'UserController@UserDash')->name('user.userdash');

        Route::get('/appointment/{id}', 'UserController@DoctorDetails')->name('user.doctor');

        Route::get('/search/{str}', 'MicroServiceController@Search')->name('user.search');

        Route::get('/apptable','UserController@AppTable')->name('user.app');

        Route::post('/takeappointment/{doctor}', 'UserController@TakeAppointment');

        Route::get('/notice','UserController@Notice');
    });
    Route::group(['middleware'=>['admin']], function(){
        //admin
        Route::get('/admindash', 'AdminController@admindash')->name('admin.admindash');
        Route::post('/user', 'AdminController@store');
        Route::get('/users', 'AdminController@index')->name('user-list');
        Route::post('/status/{user}', 'AdminController@updateStatus');
        Route::get('/user/{user}/edit', 'AdminController@edit');
        Route::post('/user/{user}', 'AdminController@update');
        Route::delete('/user/{user}', 'AdminController@destroy');
        Route::get('/appointment', 'AppoinmentController@index')->name('appoinment-list');
        Route::post('/appointment-status/{appoinment}', 'AppoinmentController@updateAppointmentStatus');
        Route::post('/appointment/{appoinment}/approve', 'AppoinmentController@approveAppointmentStatus');
        Route::post('/appointment/{appoinment}/cancel', 'AppoinmentController@cancelAppointmentStatus');
        Route::get('/appointment-list', 'AppoinmentController@appointments');
    });
    Route::group(['middleware'=>['doctor']], function(){
            //doctor
            Route::get('/doctordash', 'DoctorController@doctorDash')->name('doctordash');
    });
});







