<?php

namespace Modules\Administrator\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use Modules\Administrator\Entities\Module;
use Modules\Administrator\Entities\Section;
use Modules\Administrator\Entities\Permissions;
use Modules\Administrator\Entities\form_section_components;
use Modules\Administrator\Entities\core_image_sizes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionsController extends Controller
{

     public function __construct() {
         $this->middleware(['auth', 'clearance']); //clearance middleware lets only users with a //specific permission permission to access these resources
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function view(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $sections = Section::where('name', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->orWhere('module', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            //$sections = Section::latest()->paginate($perPage);
            $sections = Section::select(
                'administrator_module_sections.id',
                'administrator_module_sections.name',
                'administrator_modules.name as module_name'
                )
                ->where('administrator_module_sections.active', '=', 1)
                ->join('administrator_modules','administrator_modules.ID','=','administrator_module_sections.module')
                ->get();
        }

        return view('administrator::sections.view', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tables = DB::select('SHOW TABLES');
        //echo "<pre>";print_r($tables); exit;

        $modules = Module::where('active', '=', 1)->get();
        return view('administrator::sections.create',compact('modules','tables'));
    }

    public function getTableFields(Request $request)
    {
        $table_name = $request->table_name;

        $fields = DB::select('SHOW COLUMNS FROM '.$table_name);
        //echo "<pre>";print_r($fields); exit;
       if(count($fields)>0){
           foreach($fields as $field){
               if($field->Field!='created_at' && $field->Field!='updated_at')
               $arr_fields[] = $field->Field;
           }
       }
        $response = $arr_fields;
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required'
		]);

        $requestData = $request->all();
        
        $requestData['collection_name'] = str_replace(['#', '/', '\\', ' '], '', strtolower($requestData['name']));

        $section_id = Section::create($requestData)->id;
        $module_id = $request->module;

        $section_name_ucfirst = ucfirst(strtolower($request->name));
        $section_name = strtolower($request->name);
        $section_name_singular = str_singular(strtolower($request->name));



        $snippet = <<<EOD
        \$sec_id = Section::insertGetId(array('module'=>1,'name'=>'$request->name','active'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));

        Permissions::create(['module'=>1,'section'=>\$sec_id,'name' => 'View '.ucfirst("$section_name_singular"),'slug' => urlStringConvert('View '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 1,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>\$sec_id,'name' => 'Detail '.ucfirst("$section_name_singular"),'slug' => urlStringConvert('View '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>\$sec_id,'name' => 'Create '.ucfirst("$section_name_singular"),'slug' => urlStringConvert('View '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>\$sec_id,'name' => 'Store '.ucfirst("$section_name_singular"),'slug' => urlStringConvert('View '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>\$sec_id,'name' => 'Edit '.ucfirst("$section_name_singular"),'slug' => urlStringConvert('View '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>\$sec_id,'name' => 'Update '.ucfirst("$section_name_singular"),'guard_name' => 'administrator','display' => 0,'active' => 1]);
        Permissions::create(['module'=>1,'section'=>\$sec_id,'name' => 'Destroy '.ucfirst("$section_name_singular"),'slug' => urlStringConvert('View '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1]);
EOD;



        $status = $this->generatesectionCRUD($request,$snippet,$section_id);

        if($status=='success'){

            $view_permission = ['module'=>$module_id,'section'=>$section_id,'name' => 'View '.ucfirst($section_name_singular),'slug' => urlStringConvert('View '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 1,'active' => 1];
            $detail_permission = ['module'=>$module_id,'section'=>$section_id,'name' => 'Detail '.ucfirst($section_name_singular),'slug' => urlStringConvert('Detail '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1];
            $create_permission = ['module'=>$module_id,'section'=>$section_id,'name' => 'Create '.ucfirst($section_name_singular),'slug' => urlStringConvert('Create '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1];
            $store_permission = ['module'=>$module_id,'section'=>$section_id,'name' => 'Store '.ucfirst($section_name_singular),'slug' => urlStringConvert('Store '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1];
            $edit_permission = ['module'=>$module_id,'section'=>$section_id,'name' => 'Edit '.ucfirst($section_name_singular),'slug' => urlStringConvert('Edit '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1];
            $update_permission = ['module'=>$module_id,'section'=>$section_id,'name' => 'Update '.ucfirst($section_name_singular),'slug' => urlStringConvert('Update '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1];
            $destroy_permission = ['module'=>$module_id,'section'=>$section_id,'name' => 'Destroy '.ucfirst($section_name_singular),'slug' => urlStringConvert('Destroy '.ucfirst($section_name_singular)),'guard_name' => 'administrator','display' => 0,'active' => 1];
            Permissions::create($view_permission);
            Permissions::create($detail_permission);
            Permissions::create($create_permission);
            Permissions::create($store_permission);
            Permissions::create($edit_permission);
            Permissions::create($update_permission);
            Permissions::create($destroy_permission);

            $category_component = ['section'=>$section_id,'form_component'=>1,'position' => 1];
            $images_component = ['section'=>$section_id,'form_component'=>2,'position' => 2];
            $videos_component = ['section'=>$section_id,'form_component'=>3,'position' => 2];
            $files_component = ['section'=>$section_id,'form_component'=>4,'position' => 2];
            $meta_detail_component = ['section'=>$section_id,'form_component'=>5,'position' => 2];

            form_section_components::create($category_component);
            form_section_components::create($images_component);
            form_section_components::create($videos_component);
            form_section_components::create($files_component);
            form_section_components::create($meta_detail_component);


            $img_xs = ['name'=>'small','width'=>50,'height' =>50,'section' => $section_id,'collection_name' => $section_name];
            $img_thumb = ['name'=>'thumb','width'=>100,'height' =>100,'section' => $section_id,'collection_name' => $section_name];
            $img_medium = ['name'=>'medium','width'=>250,'height' =>250,'section' => $section_id,'collection_name' => $section_name];
            $img_standard = ['name'=>'standard','width'=>500,'height' =>500,'section' => $section_id,'collection_name' => $section_name];
            $img_large = ['name'=>'large','width'=>750,'height' => 750,'section' => $section_id,'collection_name' => $section_name];
            $img_actual = ['name'=>'actual','width'=>1000,'height' => 1000,'section' => $section_id,'collection_name' => $section_name];

            core_image_sizes::create($img_xs);
            core_image_sizes::create($img_thumb);
            core_image_sizes::create($img_medium);
            core_image_sizes::create($img_standard);
            core_image_sizes::create($img_large);
            core_image_sizes::create($img_actual);

        }

        Artisan::call('cache:clear');
        return redirect( url('administrator/view-sections') )->with('flash_message', 'Section added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $id = $request->id;
        $section = Section::findOrFail($id);

        return view('administrator::sections.detail', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $section = Section::findOrFail($id);
        $modules = Module::where('active', '=', 1)->get();
        return view('administrator::sections.edit', compact('section','modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $section = Section::findOrFail($id);
        $section->update($requestData);

        return redirect('administrator/view-sections')->with('flash_message', 'Section updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::destroy($id);

        return redirect('administrator/view-sections')->with('flash_message', 'Section deleted!');
    }


    public function generatesectionCRUD($request,$section_seeder_snippet='',$section_id)
    {
        $field_names = $request->field_name;
        $field_types = $request->field_type;
        $arr_validation_fields = array();
        $arr_foreign_key_fields = array();
        $arr_relationship_fields = array();
        //echo "<pre>"; print_r($_POST); exit;
        //$arr_options = [];
        if(count($field_names)>0){
            foreach ($field_names as $key => $field_name){
                $arr_options = [];
                $options_name = "options_".$key;
                if($request->$options_name){
                    //echo $options_name;
                    $options = explode(',',$request->$options_name);
                    if(count($options)>0){
                        foreach ($options as $option){
                            $str_option = explode(':',$option);
                            //$arr_options[] = $option;
                            /*
                            $arr_options[] = array(
                                $str_option[0] => $str_option[1]
                            );
                            */
                            $arr_options[$str_option[0]] = $str_option[1];
                        }
                    }

                    $arr_fields[] = array(
                        'name'  => $field_name,
                        'type'  => $field_types[$key],
                        'options'  => $arr_options
                    );
                }else {
                    if ($field_types[$key] == 'select') {
                        $db_option = "db_options_" . $key;
                        if ($request->$db_option == 1) {
                            $db_table = "tables_".$key;
                            $arr_fields[] = array(
                                'name' => $field_name,
                                'type' => $field_types[$key],
                                'options' => 'db',
                                'table' => $request->$db_table
                            );

                        } else {
                            $arr_fields[] = array(
                                'name' => $field_name,
                                'options' => '',
                                'type' => $field_types[$key],
                            );
                        }
                    } else {
                        $arr_fields[] = array(
                            'name' => $field_name,
                            'options' => '',
                            'type' => $field_types[$key],
                        );
                    }
                }
                $required_check_box_name = "required_field_".$key;
                if($request->$required_check_box_name){
                    $arr_validation_fields[] = array(
                        'field'  => $field_name,
                        'rules' => 'required'
                    );
                }

                if($field_types[$key]=='select'){
                    $db_option = "db_options_".$key;
                    if($request->$db_option==1){
                        //echo $db_table = "tables_".$key; exit;
                        $db_table = "tables_".$key;
                        if($db_table){
                            $table_field = 'table_field_'.$key;
                            $arr_foreign_key_fields[] = array(
                                'column'  => $field_name,
                                'references' => $request->$table_field,
                                'on' => $request->$db_table,
                                'onDelete' =>  'cascade'
                            );

                            $arr_relationship_fields[] = array(
                                'name'  => $field_name,
                                "type" => "belongsTo",
                                "class" =>  "App\\".$request->$db_table

                            );
                        }
                    }
                }
            }
        }

        //echo "<pre>";print_r($arr_fields); exit;

        $fields = array(
            'fields' => $arr_fields,
            'validations' => $arr_validation_fields,
            'foreign_keys' => $arr_foreign_key_fields,
            'relationships' => $arr_relationship_fields
        );
        $fields_json_file = base_path('fields.json');
        File::put($fields_json_file, json_encode($fields));

        //exit;
        //exit;
        //echo "<pre>"; print_r($arr_fields); exit;
        //echo json_encode($arr_fields); exit;
        //echo "<prE>"; print_r($arr_validation_fields); exit;
        //Artisan::call('module:make', ['name' => ["test4"], '--force'=> true]);
        //Artisan::call('crud:generate', ['name' => 'Posts', '--fields' => 'title#string; content#text; category#select#options={"technology": "Technology", "tips": "Tips", "health": "Health"}' ]);
        //$module_name = 'Articles';
        //$section_name = 'articles';
        //$section_name_singular = 'article';



        $module_id = ucfirst(strtolower($request->module));
        $module = Module::findOrFail($module_id);
        $module_name = ucfirst(strtolower(str_replace(' ','',$module->name)));

      
        //$section_name = strtolower(str_replace(' ','',$request->name));
        $section_name = strtolower($request->name);
        $section_name_singular = str_singular(strtolower(str_replace(' ','-',$request->name)));
        $section_name_singular_with_space = str_singular(strtolower($request->name));


        $configFile = '..\Modules\\'.$module_name.'\Config\config.php';
        if (file_exists($configFile)) {
            //$config_data = File::get($configFile);
            $config_data = config(strtolower($module_name));
            $config_section_name = strtolower(str_replace(['#', '/', '\\', ' '],'',$request->name));
            $config_data[$config_section_name]=array(
                'images' => $config_section_name.'/images',
                'images_tmp' => $config_section_name.'/images_tmp',
                'files' => $config_section_name.'/files',
                'files_tmp' => $config_section_name.'/files_tmp',
                'section' => $section_id, 
                'perpage' => 20,
            );
            //dd($config_data);

            $str_config= '<?php return ' . var_export($config_data, true) . ';';
            File::put(base_path('Modules\\'.$module_name.'\Config\config.php'), $str_config);
        }

        $table_name = strtolower($request->table_name);

        $front_end_needed = $request->front_end_needed;
        if(!$front_end_needed)
        $front_end_needed = 'no';

        $stub = File::get($this->getStub());

        $name = ucfirst($section_name);
        $seederNamespace = 'Modules\\'.$module_name.'\Database\Seeders';
        $modelName = str_singular($name);
        $modelNamespace = '..\Modules\\'.$module_name.'\Entities\\';
        $this->replaceSeederNamespace($stub, $seederNamespace)
            ->replaceSeederSnippet($stub, $section_seeder_snippet)
            ->replaceClassName($stub, $section_name.'Section');

        File::put('..\Modules\\'.str_replace(' ','',$module_name).'\Database\Seeders\\'.ucfirst($section_name).'SectionDataBaseSeeder.php', $stub);
        //File::put(ucfirst($section_name).'SectionDataBaseSeeder.php', $stub);

        $params = array(
            'name' => ucfirst($section_name),
            '--fields_from_file' => base_path("fields.json"),
            //'--fields' => 'name#string; active#select#options={"1": "yes","0": "no"}',
            '--view-path' => '..\..\Modules\\'.$module_name.'\Resources\views',
            '--module-name' => $module_name,
            '--section-name' => $config_section_name,
            '--controller-namespace'=> '..\..\..\Modules\\'.$module_name.'\Http\Controllers',
            '--model-namespace' => '..\Modules\\'.$module_name.'\Entities',

            '--section-seeder-snippet' => $section_seeder_snippet,
            '--table'   => $table_name,
            '--front-end-needed'   => $front_end_needed,
            '--route-group'=>'administrator',
            '--form-helper' => 'html'
        );
        //,'moduleName' => 'test1'
        //echo "<pre>"; print_r($params); exit;
        Artisan::call('crud:generate', $params);


        //echo Theme::get(); exit;
        $section_name = strtolower(str_replace(' ','',$request->name));
        $routeFile = '..\Modules\\'.$module_name.'\Routes\web.php';
        //$routeFile = ('..\Modules\\'.$module_name.'\Http\Routes/web.php');
        if (file_exists($routeFile)) {
            $route = "Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
'namespace' => 'Backend',
], function ()
{
    Route::get('/view-".$section_name_singular."', '".ucfirst($section_name)."Controller@view')->name('View ".ucfirst($section_name_singular_with_space)."');
    Route::get('/detail-".$section_name_singular."/{id}', '".ucfirst($section_name)."Controller@detail')->name('Detail ".ucfirst($section_name_singular_with_space)."');
    Route::get('/create-".$section_name_singular."', '".ucfirst($section_name)."Controller@create')->name('Create ".ucfirst($section_name_singular_with_space)."');
    Route::post('/store-".$section_name_singular."', '".ucfirst($section_name)."Controller@store')->name('Store ".ucfirst($section_name_singular_with_space)."');
    Route::get('/edit-".$section_name_singular."/{id}', '".ucfirst($section_name)."Controller@edit')->name('Edit ".ucfirst($section_name_singular_with_space)."');
    Route::patch('/update-".$section_name_singular."/{id}', '".ucfirst($section_name)."Controller@update')->name('Update ".ucfirst($section_name_singular_with_space)."');
    Route::delete('/destroy-".$section_name_singular."/{id}', '".ucfirst($section_name)."Controller@destroy')->name('Destroy ".ucfirst($section_name_singular_with_space)."');
});";

            $isAdded = File::append($routeFile, "\n\n" . $route);

            if($front_end_needed=='yes'){
                $front_end_route = "Route::group([
                'middleware' => ['web', 'theme:".config('theme.active')."'], 
                'prefix' => '',
                'namespace' => 'Frontend',
                ], function ()
                {
                    Route::get('/".$section_name."', '".ucfirst($section_name)."Controller@view');
                    Route::get('/".$section_name_singular."/detail/{id}', '".ucfirst($section_name)."Controller@detail');
                });";
                $isAdded = File::append($routeFile, "\n\n" . $front_end_route);
            }
        }

        Artisan::call('config:cache');
        return "success";
        //clearCache();
    }


    protected function replaceSeederNamespace(&$stub, $name)
    {
        $stub = str_replace('DummyNamespace', $name, $stub);
        return $this;
    }


    protected function replaceModelName(&$stub, $modelName)
    {
        $stub = str_replace('{{modelName}}', $modelName, $stub);

        return $this;
    }

    protected function replaceModelNamespace(&$stub, $modelNamespace)
    {
        $modelNamespace = str_replace('..\\','' , $modelNamespace);
        $stub = str_replace('{{modelNamespace}}', $modelNamespace, $stub);

        return $this;
    }

    protected function replaceSeederSnippet(&$stub, $snippet)
    {
        $stub = str_replace('{{seeder_schema}}', $snippet, $stub);

        return $this;
    }

    protected function getStub()
    {
        return config('crudgenerator.custom_template')
            ? config('crudgenerator.path') . '/seeder.stub'
            : __DIR__ . '/../stubs/seeder.stub';
    }

    protected function replaceClassName(&$stub, $name)
    {
        $stub = str_replace('{{DummyClass}}', ucfirst($name), $stub);

        return $this;

        //return str_replace('{{DummyClass}}', ucfirst($name), $stub);
    }



}
