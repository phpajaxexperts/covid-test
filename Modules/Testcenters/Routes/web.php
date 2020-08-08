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

Route::prefix('testcenters')->group(function() {
    Route::get('/', 'TestcentersController@index');
});


Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
'namespace' => 'Backend',
], function ()
{
    Route::get('/view-center', 'CentersController@view')->name('View Center');
    Route::get('/detail-center/{id}', 'CentersController@detail')->name('Detail Center');
    Route::get('/create-center', 'CentersController@create')->name('Create Center');
    Route::post('/store-center', 'CentersController@store')->name('Store Center');
    Route::get('/edit-center/{id}', 'CentersController@edit')->name('Edit Center');
    Route::patch('/update-center/{id}', 'CentersController@update')->name('Update Center');
    Route::delete('/destroy-center/{id}', 'CentersController@destroy')->name('Destroy Center');
});

Route::group([
                'middleware' => ['web', 'theme:smkV1.0'], 
                'prefix' => '',
                'namespace' => 'Frontend',
                ], function ()
                {
                    Route::get('/centers', 'CentersController@view');
                    Route::get('/center/detail/{id}', 'CentersController@detail');
                });