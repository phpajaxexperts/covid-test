<?php

namespace Modules\Administrator\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Modules\Administrator\Entities\AdministratorModules;
use Modules\Administrator\Entities\AdministratorModuleSections;

use Session;

class PermissionController extends Controller
{


    public function __construct() {
        $this->middleware(['auth', 'clearance']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function view()
    {
        $permissions = Permission::all(); //Get all permissions

        return view('administrator::permission.view')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        $roles = Role::get(); //Get all roles
        $modules = AdministratorModules::where('active',1)->pluck('name','id');//Get all modules
        $module_sections = AdministratorModuleSections::all()->where('active',1);//Get all module sections

        $arr_module_sections = array();
        if(count($modules)>0){
            foreach ($modules as $key => $module){
                if(count($module_sections)>0) {
                    foreach ($module_sections as $module_section) {
                        if($module_section->module==$key){
                            $arr_module_sections[$module][$module_section->id]= $module_section->name;
                        }
                    }
                }
            }
        }

        $module_sections = $arr_module_sections;
        //echo "<pre>"; print_r($module_sections); exit;
        return view('administrator::permission.create', compact('roles','modules','module_sections'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'module_section'=>'required',
            'name'=>'required|max:255',
        ]);

        /*
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        */

        $name = $request['name'];
        $module_section = $request['module_section'];
        $menu_display = $request['menu_display'];
        $active = $request['active'];
        $arr_module_section = AdministratorModuleSections::where('id',$module_section)->first();
        $module = $arr_module_section->module;

        $permission = new Permission();
        $permission->name = $name;
        $permission->module = $module;
        $permission->section = $module_section;
        $permission->display = $menu_display;
        $permission->active = $active;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('View Permission')
            ->with('flash_message',
                'Permission'. $permission->name.' added!');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('administrator.permission.view');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $permission = Permission::find($request->id);

        $roles = Role::get(); //Get all roles
        $modules = AdministratorModules::where('active',1)->pluck('name','id');//Get all modules
        $module_sections = AdministratorModuleSections::all()->where('active',1);//Get all module sections

        $arr_module_sections = array();
        if(count($modules)>0){
            foreach ($modules as $key => $module){
                if(count($module_sections)>0) {
                    foreach ($module_sections as $module_section) {
                        if($module_section->module==$key){
                            $arr_module_sections[$module][$module_section->id]= $module_section->name;
                        }
                    }
                }
            }
        }

        $module_sections = $arr_module_sections;

        return view('administrator::permission.edit', compact('permission','module_sections','roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $validatedData = $request->validate([
            'name'=>'required|max:255',
        ]);

        /*
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        */

        $input = $request->all();
        $permission->fill($input)->save();

        return redirect()->route('View Permission')
            ->with('flash_message',
                'Permission'. $permission->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission
        if ($permission->name == "Administer roles & permissions") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect()->route('View Permission')
            ->with('flash_message',
                'Permission deleted!');
    }
}
