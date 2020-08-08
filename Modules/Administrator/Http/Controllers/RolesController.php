<?php

namespace Modules\Administrator\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Modules\Administrator\Entities\AdministratorModules;
use Modules\Administrator\Entities\AdministratorModuleSections;

use Session;



class RolesController extends Controller
{

    public function __construct() {
       $this->middleware(['auth', 'clearance']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
   }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function view()
    {
        $roles = Role::all();//Get all roles

        return view('administrator::roles.view')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all()->where('active','=',1);//Get all permissions

        $modules = AdministratorModules::all()->where('active','=',1);//Get all modules
        $module_sections = AdministratorModuleSections::all()->where('active','=',1);//Get all module sections
        //echo "<pre>"; print_r($module_sections); exit;

        return view('administrator::roles.create', ['permissions'=>$permissions,'modules'=>$modules,'module_sections'=>$module_sections]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //echo "Hai"; exit;
        //Validate name and permissions field
        $validate_params['name'] = 'required|string|max:255|unique:roles,name,';
        $validate_params['permissions'] = 'required';

        $input = $request->only(['name', 'permissions']);
        $validator = Validator::make($input, $validate_params);
        if ($validator->fails())
        {
            $response['error'] = $validator->messages();
            $response['success'] = 'false';
            return response()->json($response, 200);
        }
        else {

            $name = $request['name'];
            $role = new Role();
            $role->name = $name;

            $permissions = $request['permissions'];

            $role->save();
            //Looping thru selected permissions
            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                //Fetch the newly created role and assign permission
                $role = Role::where('name', '=', $name)->first();
                $role->givePermissionTo($p);
            }

            return redirect()->route('View Role')
                ->with('flash_message',
                    'Role' . $role->name . ' added!');
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return redirect('View Role');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $role = Role::findOrFail($id);

        $permissions = Permission::all()->where('active','=',1);//Get all permissions

        $modules = AdministratorModules::all()->where('active','=',1);//Get all modules
        $module_sections = AdministratorModuleSections::all()->where('active','=',1);//Get all module sections


        return view('administrator::roles.edit', compact('role', 'permissions','modules','module_sections'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $role = Role::findOrFail($id);//Get role with the given id
        //Validate name and permission fields
        $validate_params['name'] = 'required|string|max:255|unique:roles,name,'.$id;
        //$validate_params['permissions'] = 'required';
        $input = $request->except(['permissions']);
        $validator = Validator::make($input, $validate_params);
        if ($validator->fails())
        {
            $response['error'] = $validator->messages();
            $response['success'] = 'false';
            return response()->json($response, 200);
        }
        else {

            $permissions = $request['permissions'];
            $role->fill($input)->save();

            $p_all = Permission::all();//Get all permissions

            foreach ($p_all as $p) {
                $role->revokePermissionTo($p); //Remove all permissions associated with role
            }

            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
                $role->givePermissionTo($p);  //Assign permission to role
            }

            return redirect()->route('View Role')
                ->with('flash_message',
                    'Role' . $role->name . ' updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('View Role')
            ->with('flash_message',
                'Role deleted!');

    }
}
