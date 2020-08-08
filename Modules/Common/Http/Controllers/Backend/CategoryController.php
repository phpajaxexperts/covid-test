<?php

namespace Modules\Common\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Modules\Common\Entities\Category;
use Modules\Common\Entities\Categorymapping;
use Modules\Common\Entities\core_category_custom_fields;
use Modules\Common\Entities\Customfield;
use Illuminate\Http\Request;



class CategoryController extends Controller
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

        $module = $request->module;
        $parent = 0;
        $categories = categoryTreeView($module);
        if(!isset($categories)){
            $categories = '<ul id="tree2"><li><a href="'.url("administrator/create-category/".$module.'/'.$parent).'">+ add category</a></li></ul>'; 
        }else{
           $categories = '<ul id="tree2">'.substr($categories,4,strlen($categories));
        }
        //dd($categories);
        //echo $categories; exit;

        if (!empty($keyword)) {
            $category = Category::where('name', 'LIKE', "%$keyword%")
                ->orWhere('caption', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('video_url', 'LIKE', "%$keyword%")
                ->orWhere('gallery_url', 'LIKE', "%$keyword%")
                ->orWhere('meta_title', 'LIKE', "%$keyword%")
                ->orWhere('meta_description', 'LIKE', "%$keyword%")
                ->orWhere('meta_keywords', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $category = Category::latest()->paginate($perPage);
        }

        //dd($category);
        
        return view('common::backend.category.view', compact('category','categories','module'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $module = $request->module;
        $parent = $request->parent;
        session(['category_custom_fields' => '']);

        return view('common::backend.category.create', compact('module','parent') );
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
        
        //dd($requestData);

        if ($request->hasFile('image')) {
            foreach($request['image'] as $file){
                $uploadPath = public_path('/uploads/image');

                $extension = $file->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;

                $file->move($uploadPath, $fileName);
                $requestData['image'] = $fileName;
            }
        }

        $ID = Category::create($requestData)->ID;

        

        $arr = array(
            'category' => $ID,
            'parent' => $requestData['parent'],
            'module' => $requestData['module']
        );
        Categorymapping::create($arr);

        if(session('category_custom_fields'))
        $category_custom_fields = session('category_custom_fields');
        else
        $category_custom_fields = array();

        if(count($category_custom_fields)>0){
            foreach($category_custom_fields as $category_custom_field){
                $arr = array(
                    'custom_field' => $category_custom_field['custom_field'],
                    'category' => $ID,
                    'module' => $requestData['module']
                );
                core_category_custom_fields::create($arr);
            }
        }


        return redirect('administrator/view-category/'.$requestData['module'])->with('flash_message', 'Category added!');
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
        $module = $request->module;
        $category = Category::findOrFail($id);

        return view('common::backend.category.detail', compact('category','module'));
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
        $module = $request->module;
        $category = Category::findOrFail($id);
        session(['category_custom_fields' => '']);

        $category_custom_fields = getCategoryCustomFields($id,$module);
        //dd($category_custom_fields);


        return view('common::backend.category.edit', compact('category','module','category_custom_fields') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();
        $id = $request->id;

        if ($request->hasFile('image')) {
            foreach($request['image'] as $file){
                $uploadPath = public_path('/uploads/image');

                $extension = $file->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;

                $file->move($uploadPath, $fileName);
                $requestData['image'] = $fileName;
            }
        }

        $category = Category::findOrFail($id);
        $category->update($requestData);

        return redirect('administrator/view-category/'.$requestData['module'])->with('flash_message', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id 
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($module,$id)
    {
        Category::destroy($id);
        Categorymapping::destroy(['category' => $id,'module'=>$module]);
        return redirect('administrator/view-category/'.$module)->with('flash_message', 'Category deleted!');
    }
}
