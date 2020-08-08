<?php

namespace Modules\Common\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

class CommonController extends Controller
{


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('common::index');
    }


    public function imageOpt(Request $request)
    {
        echo $request->image;
        echo '<br> Width' . $request->w;
        echo '<br> Height'. $request->h;
        echo "Hai"; exit;    
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */

    public function slugUpdater()
    {
        $permissions = DB::table('permissions')->get();
        if(count($permissions)>0){
            foreach ($permissions as $key => $permission) {
                $slug = urlStringConvert($permission->name);
                $arr = array('slug' => $slug);
                DB::table('permissions')->where('id', $permission->id)
                ->update($arr);
            }
        }
    }

    public function create()
    {
        return view('common::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('common::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('common::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}