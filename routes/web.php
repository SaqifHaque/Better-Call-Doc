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

Route::get('/logout','HomeController@Logout');

Route::group(['middleware'=>['session']], function(){

    Route::post('/picupload/{user}','UserController@editPic')->name('user.pic');

    Route::get('/profile','UserController@profile')->name('user.profile');
    
    Route::post('/profile-edit/{user}','UserController@editProfile')->name('user.edit');

    Route::get('/notice','UserController@Notice');
    
    Route::group(['middleware'=>['patient']], function(){

        Route::get('/userdash', 'UserController@UserDash')->name('user.userdash');

        Route::get('/appointment/{id}', 'UserController@DoctorDetails')->name('user.doctor');

        Route::get('/search/{str}', 'MicroServiceController@Search')->name('user.search');

        Route::get('/apptable','UserController@AppTable')->name('user.app');

        Route::post('/takeappointment/{id}', 'UserController@TakeAppointment');

        Route::get('generate-pdf/{id}','PDFController@generatePDF');

        Route::get('/review/{id}','UserController@Review')->name('user.review');

        Route::post('/rated/{id}','UserController@Rated');
        Route::post('/cancel/{appoinment}','UserController@Cancel');

    });
    Route::group(['middleware'=>['admin']], function(){
        //admin
        Route::get('/user/new', function () {
            return view('admin.add-user');
        });
        Route::get('/admindash', 'AdminController@admindash')->name('admin.admindash');
        Route::post('/user', 'AdminController@store');
        Route::get('/users', 'AdminController@index')->name('admin.user-list');
        Route::post('/status/{user}', 'AdminController@updateStatus');
        Route::get('/user/{user}/edit', 'AdminController@edit');
        Route::post('/user/{user}', 'AdminController@update');
        Route::delete('/user/{user}', 'AdminController@destroy');
        Route::get('/appointment', 'AppoinmentController@index')->name('appoinment-list');
        Route::post('/appointment-status/{appoinment}', 'AppoinmentController@updateAppointmentStatus');
        Route::post('/appointment/{appoinment}/approve', 'AppoinmentController@approveAppointmentStatus');
        Route::post('/appointment/{appoinment}/cancel', 'AppoinmentController@cancelAppointmentStatus');
        Route::get('/appointment-list', 'AppoinmentController@appointments');
        Route::get('/finance','AdminController@Finance');
        Route::post('/noti', 'NoticeController@store');
    });
    Route::group(['middleware'=>['doctor']], function(){
            //doctor
            Route::get('/doctordash/{doctor}', 'DoctorController@show')->name('doctordash');
            Route::get('/doctor-table/{doctor}', 'DoctorController@index');
            Route::post('/scedule/{doctor}', 'DoctorController@setTime');
            Route::post('/appointment/{appoinment}', 'DoctorController@updateAppointmentStatus');
            Route::post('/prescription/{appoinment}', 'PrescriptionController@store');
    });
});







