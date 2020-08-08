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


Route::prefix('common')->group(function() {
    Route::get('/', 'CommonController@index');
    Route::get('/slug-updater', 'CommonController@slugUpdater');
});


//Route::resource('/image-opt', 'CommonController')->name('imageOpt');

// Route::group(['prefix' => 'image-opt'], function () {
//     Route::resource('/', 'CommonController@imageOpt')->name('imageOpt');
// });


//Route::get('image-opt/'.$cur_uri[0], 'ImgOptController@imageOpt');

Route::group([
    'middleware' => ['web'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
    'prefix' => 'img-opt',
    'namespace' => 'Backend',
    ], function ()
    {
        if (isset($_SERVER['REQUEST_URI'])){         
            $cur_uri = explode('?',$_SERVER["REQUEST_URI"]);
            //echo $cur_uri[0]; exit;
            Route::get('/'.substr($cur_uri[0],9,strlen($cur_uri[0])), 'ImgOptController@imageOpt');
        }
});
 

Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
'namespace' => 'Backend',
], function ()
{
    Route::get('/view-category/{module}', 'CategoryController@view')->name('View Category');
    Route::get('/detail-category/{module}/{id}', 'CategoryController@detail')->name('Detail Category');
    Route::get('/create-category/{module}/{parent}', 'CategoryController@create')->name('Create Category');
    Route::post('/store-category', 'CategoryController@store')->name('Store Category');
    Route::get('/edit-category/{module}/{id}', 'CategoryController@edit')->name('Edit Category');
    Route::patch('/update-category/{smodulection}/{id}', 'CategoryController@update')->name('Update Category');
    Route::delete('/destroy-category/{module}/{id}', 'CategoryController@destroy')->name('Destroy Category');
});

Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
'namespace' => 'Backend',
], function ()
{
    Route::get('/view-customfield', 'CustomfieldsController@view')->name('View Customfield');
    Route::get('/detail-customfield/{id}', 'CustomfieldsController@detail')->name('Detail Customfield');
    Route::get('/create-customfield', 'CustomfieldsController@create')->name('Create Customfield');
    Route::post('/store-customfield', 'CustomfieldsController@store')->name('Store Customfield');
    Route::get('/edit-customfield/{id}', 'CustomfieldsController@edit')->name('Edit Customfield');
    Route::patch('/update-customfield/{id}', 'CustomfieldsController@update')->name('Update Customfield');
    Route::delete('/destroy-customfield/{id}', 'CustomfieldsController@destroy')->name('Destroy Customfield');
});


Route::group([
    'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
    'prefix' => 'administrator',
    'namespace' => 'Backend',
    ], function ()
    {
        Route::get('/create-categorycustomfield', 'CategorycustomfieldController@create')->name('Create Categorycustomfield');
        Route::post('/store-categorycustomfield', 'CategorycustomfieldController@store')->name('Store Categorycustomfield');
        Route::get('/get-categorycustomfields', 'CategorycustomfieldController@getCategoryCustomFields')->name('Get Categorycustomfields');
        Route::delete('/delete-categorycustomfields', 'CategorycustomfieldController@deleteCategoryCustomFields')->name('delete Categorycustomfields');
    });

Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
'namespace' => 'Backend',
], function ()
{
    Route::get('/view-sectioncustomfield', 'SectioncustomfieldController@view')->name('View Sectioncustomfield');
    Route::get('/detail-sectioncustomfield/{id}', 'SectioncustomfieldController@detail')->name('Detail Sectioncustomfield');
    Route::get('/create-sectioncustomfield', 'SectioncustomfieldController@create')->name('Create Sectioncustomfield');
    Route::post('/store-sectioncustomfield', 'SectioncustomfieldController@store')->name('Store Sectioncustomfield');
    Route::get('/edit-sectioncustomfield/{id}', 'SectioncustomfieldController@edit')->name('Edit Sectioncustomfield');
    Route::patch('/update-sectioncustomfield/{id}', 'SectioncustomfieldController@update')->name('Update Sectioncustomfield');
    Route::delete('/destroy-sectioncustomfield/{id}', 'SectioncustomfieldController@destroy')->name('Destroy Sectioncustomfield');

    Route::get('/get-sectioncustomfields', 'SectioncustomfieldController@getSectionCustomFields')->name('Get Sectioncustomfields');
    Route::delete('/delete-sectioncustomfields', 'SectioncustomfieldController@deleteSectionCustomFields')->name('delete Sectioncustomfields');
});

Route::group([
    'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
    'prefix' => 'administrator',
    'namespace' => 'Backend\SectionComponent\Src',
    ], function ()
    {
        Route::get('/add-video-form', function(){
            return view('common::backend.component.videos.video-add-edit-form');
        });

        Route::post('/store-section-video', 'TrivVideoComponent@storeSectionVideo')->name('Store Section Video');
        Route::post('/get-section-videos', 'TrivVideoComponent@getSectionVideos')->name('Get Section Videos');
        Route::get('/edit-video', 'TrivVideoComponent@getSectionVideoForEdit')->name('Get Section Edit Video');
        Route::delete('/delete-video', 'TrivVideoComponent@deleteVideo')->name('deleteVideo');
    });

    
Route::group([
    'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
    'prefix' => 'administrator',
    'namespace' => 'Backend\SectionComponent\Src',
    ], function ()
    {
        Route::get('/add-file-form', function(){
            return view('common::backend.component.files.file-add-edit-form');
        });
        Route::post('/store-section-file', 'TrivFileComponent@storeSectionFile')->name('Store Section File');
        Route::post('/get-section-files', 'TrivFileComponent@getSectionFiles')->name('Get Section Files');
        Route::get('/edit-file', 'TrivFileComponent@getSectionFileForEdit')->name('Get Section Edit File');
        Route::delete('/delete-file', 'TrivFileComponent@deleteFile')->name('deleteFile');
    });


Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
'namespace' => 'Backend\SectionComponent\Src',
], function ()
{
    Route::get('/add-image-form', function(){
        return view('common::backend.component.images.image-add-form');
    });
    Route::post('/upload-section-images', 'TrivImageComponent@uploadSectionImage')->name('Upload Section Image');
    Route::get('/upload-section-images', 'TrivImageComponent@uploadSectionImage')->name('Upload Section Image');
    Route::post('/get-section-images', 'TrivImageComponent@getSectionImages')->name('Get Section Images');
    Route::get('/edit-image', 'TrivImageComponent@getSectionImageForEdit')->name('Get Section Edit Image');
    Route::post('/update-section-image', 'TrivImageComponent@updateSectionImage')->name('Update Section Image');
    Route::get('/delete-image-confirm', 'TrivImageComponent@deleteImageConfirm')->name('deleteImageConfirm');
    Route::delete('/delete-image', 'TrivImageComponent@deleteImage')->name('deleteImage');
});        
