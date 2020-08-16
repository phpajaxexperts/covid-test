<?php

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
    Theme::set('covid');
    return view('welcome');
});

//Route::get('/book-test', function () {
//    Theme::set('covid');
//    return view('book-test');
//});

Route::get('/book-test/pre-screening', 'HomeController@bookPreScreeningTest');
Route::get('/book-test/point-of-entry', 'HomeController@bookPointOfEntryTest');
Route::post('/payment-process-init', 'HomeController@paymentProcessInit');
Route::get('/payment-confirm', 'HomeController@paymentConfirm');
Route::get('/payment-receipt/{bill_id}', 'HomeController@paymentReceipt');
Route::post('/update-amount-paid', 'HomeController@updateAmountPaid');
Route::post('/get-time-slots', 'HomeController@getTimeSlots');
Route::get('/booking-confirm/{bookingID}', 'HomeController@bookingConfirm');

Route::get('/qr-code-generator/{ID}', 'HomeController@qrCodeGenerator');



Route::get('/qrcode', function () {
    Theme::set('covid');
    return view('qrcode');
});

Route::get('/center', function () {
    Theme::set('centers');
    return view('login');
});

Route::post('/center/login', 'HomeController@centerLogin');


Route::get('/collection', function () {
    Theme::set('centers');
    return view('collection-login');
});

Route::post('/collection/login', 'HomeController@collectionLogin');
Route::get('collection/manual-bookings', 'CollectionsController@manualBookings');
Route::post('collection/manual-bookings', 'CollectionsController@manualBookings');
Route::post('collection/update-manual-payment', 'CollectionsController@updateManualPayment');




Route::get('/video-popup/{ID}', 'HomeController@videoPopup');

Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');
Route::post('/contact', 'HomeController@contact');

Route::get('/clear', function() { 

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    //Artisan::call('config:cache');
 
    return "Cleared!";
 
 });

//Route::get('/{keyword}', 'HomeController@search');




Route::group(['prefix' => 'administrator'], function () {
  Route::get('/', 'AdministratorAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdministratorAuth\LoginController@login');
  Route::post('/logout', 'AdministratorAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdministratorAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdministratorAuth\RegisterController@register');

  Route::post('/password/email', 'AdministratorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdministratorAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdministratorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdministratorAuth\ResetPasswordController@showResetForm');
});

Route::get('/center/dashboard', 'CentersController@dashboard');
Route::get('/center/patients', 'CentersController@patients');
Route::post('/center/patients', 'CentersController@patients');
Route::post('/center/update-patient', 'CentersController@updatePatient');
Route::get('/center/logout', 'CentersController@logout');




Route::get('/collection', function () {
    Theme::set('centers');
    return view('collection-login');
});

Route::group( [  'middleware' => [ 'guest'] ], function () {
    


Route::get('/clinic', function () {
    if (\Auth::guard('clinic')->user()) {
        return Redirect::to('/clinic/dashboard');
    }
    Theme::set('clinic');
    return view('login');
});
});
Route::post('/clinic/login', 'Auth\LoginController@clinicLogin');

Route::group( [  'middleware' => [ 'auth:clinic'] ], function () {

    Route::get('/clinic/dashboard', 'ClinicController@dashboard');
    Route::get('/clinic/patients', 'ClinicController@patients');
    Route::post('/clinic/patients', 'ClinicController@patients');
    Route::post('/clinic/update-patient', 'ClinicController@updatePatient');
    Route::get('/clinic/logout', 'ClinicController@logout');
});
