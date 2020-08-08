<?php

namespace Modules\Common\Http\Controllers\Backend\SectionComponent\Src;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Common\Entities\core_section_images;

use DB;

class TrivImageComponent
{

    public static function create($ID)
    {
        $section_images = array();
        session(['section_images' => $section_images]);
    }

    
    public static function edit($ID)
    {
        $section = view()->shared('section');
        
        $section_images = core_section_images::select(
            'core_section_images.ID',
            'core_section_images.title',
            'core_section_images.image'
            )
        ->where('core_section_images.section_rs','=',$ID)
        ->where('core_section_images.section','=',$section)
        ->get();

        view()->share('section_images', $section_images);

        $image_paths = imagePathComposeBySectionID($section);
        $image_paths['img_path'] = $image_paths['img_path'].'/'.$ID;
            
        $arr = array(
            'section'  => $section,
            'img_size_name'  => 'standard',
        );
        $img_optimize_params = getCdnImageOptimizeParams($arr);
        
        view()->share('image_paths', $image_paths);
        view()->share('img_optimize_params', $img_optimize_params);
        

    }

    
    public static function destroy($ID)
    {
        $requestData = request()->all();
        $section_images = core_section_images::where('section_rs','=',$ID)
        ->where('section','=',$requestData['section'])
        ->get();

        $image_paths = imagePathComposeBySectionID($requestData['section']);
        $img_folder = public_path($image_paths['img_folder']).'/'.$ID;
        rrmdir($img_folder);
        // if(count($section_images)>0){
        //     foreach($section_images as $section_image){
        //         @unlink($img_folder.'/'.$section_image['image']);
        //     }
        // }
        //@rmdir($img_folder);
        
        core_section_images::where('section_rs','=',$ID)
        ->where('section','=',$requestData['section'])
        ->delete();
    }

    public static function update($ID)
    {
        $requestData = request()->all();
        echo "Update Image Component";
    }

    // On Section Record Set Submit, storing all images into db from session
    public static function store($ID)
    {
        $requestData = request()->all();
        if(session('section_images'))
        $section_images = session('section_images');
        else
        $section_images = array();

        $image_paths = imagePathComposeBySectionID($requestData['section']);

        //dd($image_paths);
        $dest_img_folder = public_path($image_paths['img_folder']).'/'.$ID;
        if (!is_dir($dest_img_folder)) {
            mkdir($dest_img_folder, 0755, true);
        }
    

        if(count($section_images)>0){
            foreach($section_images as $section_image){
                $arr = array(
                    'section_rs' => $ID,
                    'section' => $section_image['section'],
                    'title' => $section_image['title'],
                    'description' => $section_image['description'],
                    'alt_tag_text' => $section_image['alt_tag_text'],
                    'image' => $section_image['image'],
                    'mime' =>  $section_image['mime'],
                );
                core_section_images::create($arr);

                if (@copy(public_path($image_paths['img_folder_tmp']).'/'.$section_image['image'],$dest_img_folder.'/'.$section_image['image']))
                {
                    @unlink(public_path($image_paths['img_folder_tmp']).'/'.$section_image['image']);
                }
            }
        }
    }
    
    public static function uploadSectionImage(Request $request)
    {

        $requestData = $request->all();

        foreach($request->file('files') as $image)
		{
            $image_path_detail = imagePathFilenameCompose($image,$request->section);

            if($requestData['section_rs']){
                if(file_exists($image->getPathName())){
                    $mime_type = $image->getMimeType();
                    $image->move(public_path($image_path_detail['img_path'].'/'.$requestData['section_rs']), $image_path_detail['file_name']);
                    $arr = array(
                        'section_rs' => $requestData['section_rs'],
                        'section' => $requestData['section'],
                        'title' => $requestData['image_title'],
                        'description' => $requestData['image_description'],
                        'alt_tag_text' => $requestData['alt_tag_text'],
                        'image' => $image_path_detail['file_name'],
                        'mime' => $mime_type,
                    );
                    core_section_images::create($arr);
        
                    $response = array(
                        'status' => 'success',
                        'msg' => 'Image Added successfully!'
                    );
                }
            }else{
                if(file_exists($image->getPathName())){
                    $mime_type = $image->getMimeType();
                    $image->move(public_path($image_path_detail['img_path_tmp']), $image_path_detail['file_name']);
                    if(session('section_images'))
                        $section_images = session('section_images');
                    else
                        $section_images = array();

                    $arr_section_images = array(
                        'section'    =>  $requestData['section'],
                        'title'  =>  $requestData['image_title'],
                        'description' => $requestData['image_description'],
                        'alt_tag_text' => $requestData['alt_tag_text'],
                        'image' => $image_path_detail['file_name'],
                        'mime' => $mime_type,
                    );
                
                    if(isset($requestData['key']))
                    $section_images[$requestData['key']] = $arr_section_images;
                    else
                    $section_images[] = $arr_section_images;

                    session(['section_images' => $section_images]);
                    $response = array(
                        'status' => 'success',
                        'msg' => 'Image  Added successfully!',
                        'section_images' => session('section_images')
                    );
                }

            }
        }
        return response()->json(['imag_url'=>'img_url','image_id'=>'image_id','success'=>'true'],200);
    }

    
    public function getSectionImages(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;
       
        $image_paths = imagePathComposeBySectionID($section);
            
        $arr = array(
            'section'  => $section,
            'img_size_name'  => 'standard',
        );
        $img_optimize_params = getCdnImageOptimizeParams($arr);

        $key = $request->key;
        if(isset($section_rs)){
            $section_images = core_section_images::select(
                'core_section_images.ID',
                'core_section_images.title',
                'core_section_images.image'
                )
            ->where('core_section_images.section_rs','=',$section_rs)
            ->where('core_section_images.section','=',$section)
            ->get();

            if(count($section_images)){
                foreach($section_images as $key => $section_image){
                    $section_images[$key]['image_url'] = $image_paths['img_path'].'/'.$section_rs.'/'.$section_image['image'].$img_optimize_params;
                    $section_images[$key]['key'] = $section_image->ID;
                }
            }
            
            $response = array('images' => $section_images);
        }else{
            if(session('section_images'))
            $section_images = session('section_images');
            else
            $section_images = array();

            
            if(count($section_images)){
                foreach($section_images as $key => $section_image){
                    $section_images[$key]['image_url'] = $image_paths['img_path_tmp'].'/'.$section_image['image'].$img_optimize_params;
                    $section_images[$key]['key'] = $key;
                }
            }
            
            $response = array('images' => $section_images);
        }
        return response()->json($response,200);
    }

    public function deleteImageConfirm(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;
        $key = $request->key;

        $image_paths = imagePathComposeBySectionID($section);
        $arr = array(
            'section'  => $section,
            'img_size_name'  => 'standard',
        );
        $img_optimize_params = getCdnImageOptimizeParams($arr);

        if(isset($section_rs)){
            $image_detail = core_section_images::select(
                'core_section_images.ID',
                'core_section_images.title',
                'core_section_images.description',
                'core_section_images.image'
                )
            ->where('core_section_images.section_rs','=',$section_rs)
            ->where('core_section_images.ID','=',$key)
            ->where('core_section_images.section','=',$section)
            ->first();

            $image_url = $image_paths['img_path'].'/'.$section_rs.'/'.$image_detail->image.$img_optimize_params;
        }else{
            if(session('section_images'))
            $section_images = session('section_images');
            else
            $section_images = array();

            $image_detail = json_decode(json_encode($section_images[$key]));

            $image_url = $image_paths['img_path_tmp'].'/'.$image_detail->image.$img_optimize_params;

        }

        return view('common::backend.component.images.image-delete-confirm', compact('image_detail','key','image_url'));
    }

    public function deleteImage(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;
        $key = $request->key;

        $image_paths = imagePathComposeBySectionID($section);

        if($section_rs){
            $section_image = core_section_images::where('core_section_images.ID','=',$key)->get();

            $img_folder = public_path($image_paths['img_folder']).'/'.$key;
            @unlink($img_folder.'/'.$section_image['image']);
            core_section_images::destroy($key);
        }else{
            if(session('section_images'))
            $section_images = session('section_images');
            else
            $section_images = array();

            $img_folder = public_path($image_paths['img_folder_tmp']);
            @unlink($img_folder.'/'.$section_images[$key]['image']);

            unset($section_images[$key]);

            $section_images = array_values($section_images);

            session(['section_images' => $section_images]);
        }

        $response = array(
            'status' => 'warning',
            'msg' => 'Image deleted successfully!',
            'section_images' => session('section_images')
        );
        return response()->json($response,200);        

    }


    public function getSectionImageForEdit(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;
        $key = $request->key;

        $image_paths = imagePathComposeBySectionID($section);
        $arr = array(
            'section'  => $section,
            'img_size_name'  => 'standard',
        );
        $img_optimize_params = getCdnImageOptimizeParams($arr);

        if(isset($section_rs)){
            $image_detail = core_section_images::select(
                'core_section_images.ID',
                'core_section_images.title',
                'core_section_images.description',
                'core_section_images.image'
                )
            ->where('core_section_images.section_rs','=',$section_rs)
            ->where('core_section_images.ID','=',$key)
            ->where('core_section_images.section','=',$section)
            ->first();

            $image_url = $image_paths['img_path'].'/'.$section_rs.'/'.$image_detail->image.$img_optimize_params;
        }else{
            if(session('section_images'))
            $section_images = session('section_images');
            else
            $section_images = array();

            $image_detail = json_decode(json_encode($section_images[$key]));

            $image_url = $image_paths['img_path_tmp'].'/'.$image_detail->image.$img_optimize_params;

        }

        return view('common::backend.component.images.image-edit-form', compact('image_detail','key','image_url'));
    }

    public function updateSectionImage(Request $request)
    {
        
        $requestData = $request->all();
        
        $request->validate([
            'file' => 'mimes:jpg,jpeg,png,gif',
        ]);
            
        if(isset($request->file)){
            $image = $request->file;
            $image_path_detail = imagePathFilenameCompose($image,$request->section);
        }

        if($requestData['section_rs']){
            $arr = array(
                'section_rs' => $requestData['section_rs'],
                'section' => $requestData['section'],
                'title' => $requestData['image_title'],
                'description' => $requestData['image_description'],
                'alt_tag_text' => $requestData['alt_tag_text'],
            );

            if(isset($request->file)){
                $mime_type = $image->getMimeType();
                $image->move(public_path($image_path_detail['img_path']).'/'.$requestData['section_rs'], $image_path_detail['file_name']);
                $arr['image'] = $image_path_detail['file_name'];  
                $arr['mime'] = $mime_type;
            }
        
            core_section_images::where('ID','=',$requestData['key'])->update($arr);

            $response = array(
                'status' => 'success',
                'msg' => 'Image Added successfully!'
            );
        }else{
            if(session('section_images'))
                $section_images = session('section_images');
            else
                $section_images = array();

            $arr_section_images = array(
                'section'    =>  $requestData['section'],
                'title'  =>  $requestData['image_title'],
                'description' => $requestData['image_description'],
                'alt_tag_text' => $requestData['alt_tag_text'],
            );

            if(isset($request->file)){
                $mime_type = $image->getMimeType();
                $image->move(public_path($image_path_detail['img_path_tmp']), $image_path_detail['file_name']);
                $arr_section_images['image'] = $image_path_detail['file_name'];  
                $arr_section_images['mime'] = $mime_type;
            }else{
                $arr_section_images['image'] = $section_images[$requestData['key']]['image'];  
                $arr_section_images['mime'] = $section_images[$requestData['key']]['mime'];
            }
                 
            $section_images[$requestData['key']] = $arr_section_images;
            session(['section_images' => $section_images]);
            $response = array(
                'status' => 'success',
                'msg' => 'Image  Added successfully!',
                'section_images' => session('section_images')
            );
        }
        
        return response()->json($response,200);
    }

}
