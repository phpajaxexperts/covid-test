<?php

namespace Modules\Administrator\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

//use App\Administrator;
use Modules\Administrator\Entities\Administrator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use File;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;

use Shipu\Themevel\Facades\Theme;

//Enables us to output flash messaging
use Session;

class AdministratorController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:administrator', 'clearance']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
        //$this->middleware(['auth', 'clearance']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function dashboard()
    {
        //$this->generatesection();
        return view('administrator::administrator.dashboard');
    }

    public function viewAdministrator() {
        //Get all users and pass it to the view
        $admins = Administrator::all();
        return view('administrator::administrator.viewadministrator')->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */

    public function create() {
        //Get all roles and pass it to the view
        $roles = Role::get();
        //return view('users.create', ['roles'=>$roles]);
        return view('administrator::administrator.create', ['roles'=>$roles]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /*
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        */


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = Administrator::create($input);

        $roles = $request['roles'];

        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }


        //$user->assignRole($request->input('roles'));
        return redirect()->route('View Administrator')
            ->with('success','Administrator created successfully');

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('administrator::administrator.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $admin = Administrator::findOrFail($request->id); //Get user with specified id
        $roles = Role::get(); //Get all roles

        return view('administrator::administrator.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $admin = Administrator::find($id); //Get role specified by id

        //Validate name, email and password fields
        //$validate_params['name'] = 'required|string|max:255|unique:admins,name,'.$request->listing_id;
        $validate_params['name'] = 'required|string|max:255|unique:administrators,name,'.$id;
        $validate_params['email'] = 'required|email|string|max:255';
        $validate_params['password'] = 'required|min:6';
        //$input = $request->all();
        $input = $request->only(['name', 'email', 'password']);
        $input['password'] = Hash::make($input['password']);
        $validator = Validator::make($input, $validate_params);
        if ($validator->fails())
        {
            $response['error'] = $validator->messages();
            $response['success'] = 'false';
            return response()->json($response, 200);
        }
        else {
            $roles = $request['roles']; //Retreive all roles
            $admin->fill($input)->save();

            if (isset($roles)) {
                $admin->roles()->sync($roles);  //If one or more role is selected associate user to roles
            } else {
                $admin->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
            return redirect()->route('View Administrator')
                ->with('flash_message',
                    'User successfully edited.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
        return view('administrator::administrator.destroy');
    }


    public function generatesection()
    {
        //Artisan::call('module:make', ['name' => ["test4"], '--force'=> true]);
        //Artisan::call('crud:generate', ['name' => 'Posts', '--fields' => 'title#string; content#text; category#select#options={"technology": "Technology", "tips": "Tips", "health": "Health"}' ]);
        $module_name = 'Articles';
        $section_name = 'articles';
        $section_name_singular = 'article';

        $params = array(
            'name' => ucfirst($section_name),
            '--fields_from_file' => base_path("fields.json"),
            //'--fields' => 'name#string; active#select#options={"1": "yes","0": "no"}',
            '--view-path' => '..\..\Modules\\'.$module_name.'\Resources\views',
            '--module-name' => $module_name,
            '--controller-namespace'=> '..\..\..\Modules\\'.$module_name.'\Http\Controllers',
            '--model-namespace' => '..\Modules\\'.$module_name.'\Entities',
            '--route-group'=>'administrator',
            '--form-helper' => 'html'
        );
        //,'moduleName' => 'test1'
        Artisan::call('crud:generate', $params);


        //echo Theme::get(); exit;

        $routeFile = base_path('Modules/'.$module_name.'/Http/routes.php');
        if (file_exists($routeFile)) {
            $route = "Route::group([
'middleware' => ['web',  'administrator', 'auth:administrator','theme:admin'], //you need to add the last middleware to array to fix it (version < v.1.0.6)
'prefix' => 'administrator',
'namespace' => 'Modules\\".$module_name."\Http\Controllers',
], function ()
{
    Route::get('/view-".$section_name_singular."s', '".ucfirst($section_name)."Controller@view')->name('View ".ucfirst($section_name)."');
    Route::get('/detail-".$section_name_singular."/{id}', '".ucfirst($section_name)."Controller@detail')->name('Detail ".ucfirst($section_name)."');
    Route::get('/create-".$section_name_singular."', '".ucfirst($section_name)."Controller@create')->name('Create ".ucfirst($section_name_singular)."');
    Route::post('/store-".$section_name_singular."', '".ucfirst($section_name)."Controller@store')->name('Store ".ucfirst($section_name_singular)."');
    Route::get('/edit-".$section_name_singular."/{id}', '".ucfirst($section_name)."Controller@edit')->name('Edit ".ucfirst($section_name_singular)."');
    Route::patch('/update-".$section_name_singular."/{id}', '".ucfirst($section_name)."Controller@update')->name('Update ".ucfirst($section_name_singular)."');
    Route::delete('/destroy-".$section_name_singular."/{id}', '".ucfirst($section_name)."Controller@destroy')->name('Destroy ".ucfirst($section_name_singular)."');
});";

            $isAdded = File::append($routeFile, "\n\n" . $route);
        }

        echo "Hai"; exit;
    }


}
