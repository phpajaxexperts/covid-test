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

// Route::prefix('administrator')->group(function() {
//     Route::get('/', 'AdministratorController@index');
// });



Route::group([
    'middleware' => ['web', 'administrator', 'auth:administrator', 'theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
    'prefix' => 'administrator',
    //'as' => 'admin.',
    //'namespace' => 'Modules\Administrator\Http\Controllers',
], function () {
    //require base_path('routes/admin.php');
   Route::get('/dashboard', 'AdministratorController@dashboard')->name('Administrator Dashboard');
   Route::get('/view-administrators', 'AdministratorController@viewAdministrator')->name('View Administrator');
   Route::get('/administrator-create', 'AdministratorController@create')->name('Create Administrator');
   Route::post('/administrator-store', 'AdministratorController@store')->name('Store Administrator');
   Route::get('/administrator-edit/{id}', 'AdministratorController@edit')->name('Edit Administrator');
   Route::put('/administrator-update/{id}', 'AdministratorController@update')->name('Update Administrator');
   Route::get('/administrator-destroy/{id}', 'AdministratorController@destroy')->name('Destroy Administrator');
   
   
   Route::get('/logout', function () {
    Auth::guard('administrator')->logout();
    //return redirect('/administrator');
    //return redirect('/administrator')->with(Auth::logout());
   });

    Route::get('/view-roles', 'RolesController@view')->name('View Role');
    Route::get('/create-role', 'RolesController@create')->name('Create Role');
    Route::put('/store-role', 'RolesController@store')->name('Store Role');
    Route::get('/edit-role/{id}', 'RolesController@edit')->name('Edit Role');
    Route::put('/update-role/{id}', 'RolesController@update')->name('Update Role');
    Route::get('/destroy-role/{id}', 'RolesController@destroy')->name('Destroy Role');

    Route::get('/view-permission', 'PermissionController@view')->name('View Permission');
    Route::get('/create-permission', 'PermissionController@create')->name('Create Permission');
    Route::put('/store-permission', 'PermissionController@store')->name('Store Permission');
    Route::get('/edit-permission/{id}', 'PermissionController@edit')->name('Edit Permission');
    Route::put('/update-permission/{id}', 'PermissionController@update')->name('Update Permission');
    Route::get('/destroy-permission/{id}', 'PermissionController@destroy')->name('Destroy Permission');

});

Route::get('/generatesection', 'AdministratorController@view')->name('generatesection');

Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
//'namespace' => 'Modules\Administrator\Http\Controllers',
], function ()
{
    Route::get('/view-modules', 'ModulesController@view')->name('View Modules');
    Route::get('/detail-module/{id}', 'ModulesController@detail')->name('Detail Modules');
    Route::get('/create-module', 'ModulesController@create')->name('Create Module');
    Route::post('/store-module', 'ModulesController@store')->name('Store Module');
    Route::get('/edit-module/{id}', 'ModulesController@edit')->name('Edit Module');
    Route::patch('/update-module/{id}', 'ModulesController@update')->name('Update Module');
    Route::delete('/destroy-module/{id}', 'ModulesController@destroy')->name('Destroy Module');
});

Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
//'namespace' => 'Modules\Administrator\Http\Controllers',
], function ()
{
    Route::get('/view-sections', 'SectionsController@view')->name('View Sections');
    Route::get('/detail-section/{id}', 'SectionsController@detail')->name('Detail Sections');
    Route::get('/create-section', 'SectionsController@create')->name('Create Section');
    Route::post('/store-section', 'SectionsController@store')->name('Store Section');
    Route::get('/edit-section/{id}', 'SectionsController@edit')->name('Edit Section');
    Route::patch('/update-section/{id}', 'SectionsController@update')->name('Update Section');
    Route::delete('/destroy-section/{id}', 'SectionsController@destroy')->name('Destroy Section');
    Route::post('/get-table-fields', 'SectionsController@getTableFields')->name('getTableFields');
});