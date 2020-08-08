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

Route::prefix('members')->group(function() {
    Route::get('/', 'MembersController@index');
});


Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
'namespace' => 'Backend',
], function ()
{
    Route::get('/view-patient', 'PatientsController@view')->name('View Patient');
    Route::get('/detail-patient/{id}', 'PatientsController@detail')->name('Detail Patient');
    Route::get('/create-patient', 'PatientsController@create')->name('Create Patient');
    Route::post('/store-patient', 'PatientsController@store')->name('Store Patient');
    Route::get('/edit-patient/{id}', 'PatientsController@edit')->name('Edit Patient');
    Route::patch('/update-patient/{id}', 'PatientsController@update')->name('Update Patient');
    Route::delete('/destroy-patient/{id}', 'PatientsController@destroy')->name('Destroy Patient');
});

Route::group([
                'middleware' => ['web', 'theme:smkV1.0'], 
                'prefix' => '',
                'namespace' => 'Frontend',
                ], function ()
                {
                    Route::get('/patients', 'PatientsController@view');
                    Route::get('/patient/detail/{id}', 'PatientsController@detail');
                });