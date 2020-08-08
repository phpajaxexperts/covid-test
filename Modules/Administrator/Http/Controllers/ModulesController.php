<?php

namespace Modules\Administrator\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

use Modules\Administrator\Entities\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class ModulesController extends Controller
{

     public function __construct() {
        $this->middleware(['auth:administrator', 'clearance']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
         //$this->middleware(['auth', 'clearance']); //clearance middleware lets only users with a //specific permission permission to access these resources
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
            $modules = Module::where('name', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $modules = Module::latest()->paginate($perPage);
        }

        return view('administrator::modules.view', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('administrator::modules.create');
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

        $name = $request->name;

        $requestData = $request->all();

        $requestData['module_config_name'] = str_replace(['#', '/', '\\', ' '], '', strtolower($requestData['name']));
        
        Module::create($requestData);

        //$module_name = str_replace(' ','',$name);
        $module_name = str_replace(' ','',$requestData['module_config_name']);
        Artisan::call('module:make', ['name' => [$module_name]]);


        $seeder_snippet = <<<EOD
Module::insert(array('name'=>'$request->name','active'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
EOD;

        $stub = File::get($this->getStub());

        $name = ucfirst($name);
        $seederNamespace = 'Modules\\'.$name.'\Database\Seeders';
        $modelName = str_singular($name);
        $modelNamespace = '..\Modules\\'.$name.'\Entities\\';

        $this->replaceSeederNamespace($stub, $seederNamespace)
            ->replaceSeederSnippet($stub, $seeder_snippet)
            ->replaceClassName($stub, $name.'Module');

        File::put(base_path('Modules\\'.$module_name.'\Database\Seeders\\'.ucfirst($name).'ModuleDataBaseSeeder.php'), $stub);

    //    $str_config=" <?php
    //     return [
    //         'name' => '$module_name',
    //         'img_path' => '/images',
    //         'img_path_tmp' => '/images_tmp',
    //         'file_path' => '/files',
    //         'file_path_tmp' => '/files_tmp'
    //     ];";
    //     File::put(base_path('Modules\\'.$module_name.'\Config\config.php'), $str_config);
        
        return redirect('administrator/view-modules')->with('flash_message', 'Module added!');
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
        $module = Module::findOrFail($id);

        return view('administrator::modules.detail', compact('module'));
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
        $module = Module::findOrFail($id);

        return view('administrator::modules.edit', compact('module'));
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
        
        $requestData = $request->all();
        
        $module = Module::findOrFail($id);
        $module->update($requestData);

        return redirect('administrator/view-modules')->with('flash_message', 'Module updated!');
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
        Module::destroy($id);

        return redirect('administrator/view-modules')->with('flash_message', 'Module deleted!');
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
