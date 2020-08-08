<?php

namespace Modules\Common\Http\Controllers\Backend\SectionComponent\Src;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Modules\Common\Entities\core_section_files;
use Modules\Common\Entities\core_file_type;

use View;

class TrivFileComponent
{
    
    public static function create($ID)
    {
        $section_files = array();
        session(['section_files' => $section_files]);
    }

    public static function store($ID)
    {
        $section = view()->shared('section');
        if(session('section_files'))
        $section_files = session('section_files');
        else
        $section_files = array();

        $file_paths = filePathComposeBySectionID($section);

        //dd($image_paths);
        $dest_file_folder = public_path($file_paths['file_folder']).'/'.$ID;
        if (!is_dir($dest_file_folder)) {
            mkdir($dest_file_folder, 0755, true);
        }


        if(count($section_files)>0){
            foreach($section_files as $section_file){
                $arr = array(
                    'section_rs' => $ID,
                    'section' => $section_file['section'],
                    'title' => $section_file['title'],
                    'description' => $section_file['description'],
                    'file' => $section_file['file'],
                    'type' => $section_file['type'],
                );
                core_section_files::create($arr);
                if (@copy(public_path($file_paths['file_folder_tmp']).'/'.$section_file['file'],$dest_file_folder.'/'.$section_file['file']))
                {
                    @unlink(public_path($file_paths['file_folder_tmp']).'/'.$section_file['file']);
                }
            }
        }
    }

    public static function edit($ID)
    {

        $section = view()->shared('section');
        
        $section_files = core_section_files::select(
            'core_section_files.ID',
            'core_section_files.title',
            'core_section_files.type',
            'core_section_files.file'
            )
        ->with('typeName')
        ->where('core_section_files.section_rs','=',$ID)
        ->where('core_section_files.section','=',$section)
        ->get();

        view()->share('section_files', $section_files);


    }

    public static function update($ID)
    {
        $requestData = request()->all();
        echo "Update file Component";
    }

    public static function destroy($ID)
    {
        $requestData = request()->all();
        
        $section_files =core_section_files::where('section_rs','=',$ID)
        ->where('section','=',$requestData['section'])
        ->get();

        $file_paths = filePathComposeBySectionID($requestData['section']);
        $file_folder = public_path($file_paths['file_folder']).'/'.$ID;
        if(count($section_files)>0){
            foreach($section_files as $section_file){
                @unlink($file_folder.'/'.$section_file['file']);
            }
        }
        @rmdir($file_folder);

        core_section_files::where('section_rs','=',$ID)
        ->where('section','=',$requestData['section'])
        ->delete();
    }


    public function storeSectionFile(Request $request)
    {
        
        $requestData = $request->all();
        
        if(isset($requestData['key'])){
            $request->validate([
                'file' => 'mimes:pdf,xls,xlsx,csv,doc,docx',
            ]);
        }else{
            $request->validate([
                'file' => 'required|mimes:pdf,xls,xlsx,csv,doc,docx',
            ]);
        }


        if(isset($request->file)){
            $file_path_detail = filePathFilenameCompose($request->file,$request->section);
            $file_type = getFileTypeUsingName($request->file);
        }

        if($requestData['section_rs']){
            $arr = array(
                'section_rs' => $requestData['section_rs'],
                'section' => $requestData['section'],
                'title' => $requestData['file_title'],
                'description' => $requestData['file_description'],
            );

            if(isset($request->file)){
                $request->file->move(public_path($file_path_detail['file_path'].'/'.$requestData['section_rs']), $file_path_detail['file_name']);
                $arr['type'] = $file_type->ID;
                $arr['file'] = $file_path_detail['file_name'];
            }

            if(isset($requestData['key']))
            core_section_files::where('ID','=',$requestData['key'])->update($arr);
            else
            core_section_files::create($arr);

            $response = array(
                'status' => 'success',
                'msg' => 'File Added successfully!'
            );
        }else{
            if(session('section_files'))
                $section_files = session('section_files');
            else
                $section_files = array();

            $arr_section_files = array(
                'section'    =>  $requestData['section'],
                'title'  =>  $requestData['file_title'],
                'description' => $requestData['file_description'],
            );

            if(isset($request->file)){
                $request->file->move(public_path($file_path_detail['file_path_tmp']), $file_path_detail['file_name']);
                $arr_section_files['type'] = $file_type->ID;
                $arr_section_files['file'] = $file_path_detail['file_name'];
            }else{
                if(isset($requestData['key'])){
                    $arr_section_files['type'] = $section_files[$requestData['key']]['type'];
                    $arr_section_files['file'] = $section_files[$requestData['key']]['file'];
                }
            }
        
            if(!in_array($arr_section_files,$section_files)){
                if(isset($requestData['key']))
                $section_files[$requestData['key']] = $arr_section_files;
                else
                $section_files[] = $arr_section_files;

                session(['section_files' => $section_files]);
                $response = array(
                    'status' => 'success',
                    'msg' => 'File  Added successfully!',
                    'section_files' => session('section_files')
                );
            }else{
                $response = array(
                    'status' => 'warning',
                    'msg' => ' File not added successfully!,  please try again',
                    'section_files' => session('section_files')
                );
            }

        }
        
        return response()->json($response,200);
    }

    public function getSectionFiles(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;

        $key = $request->key;
        if(isset($section_rs)){
            $section_files = core_section_files::select(
                'core_section_files.ID as key',
                'core_section_files.title',
                'core_section_files.type',
                'core_section_files.file'
                )
            ->with('typeName')
            ->where('core_section_files.section_rs','=',$section_rs)
            ->where('core_section_files.section','=',$section)
            ->get();
            $response = array('files' => $section_files);
        }else{
            if(session('section_files'))
            $section_files = session('section_files');
            else
            $section_files = array();

            if(count($section_files)>0){
                foreach ($section_files as $key => $section_file) {
                    $file_type = core_file_type::find($section_file['type']);
                    $section_files[$key]['key'] = $key;
                    $section_files[$key]['type_name'] = $file_type;
                }
            }

            $response = array('files' => $section_files);
        }
        return response()->json($response,200);
    }

    public function deleteFile(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;
        $key = $request->key;
        if($section_rs){
            core_section_files::destroy($key);
            //categorycustomfield::destroy(['section_rs' => $section_rs,'section' => $section]);
        }else{
            if(session('section_files'))
            $section_files = session('section_files');
            else
            $section_files = array();
            
            unset($section_files[$key]);

            session(['section_files' => $section_files]);
        }

        $response = array(
            'status' => 'warning',
            'msg' => 'File deleted successfully!',
            'section_files' => session('section_files')
        );
        return response()->json($response,200);        

    }


    public function getSectionFileForEdit(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;
        $key = $request->key;
        if(isset($section_rs)){
            $file_detail = core_section_files::select(
                'core_section_files.ID',
                'core_section_files.title',
                'core_section_files.type',
                'core_section_files.description',
                'core_section_files.file'
                )
            ->with('typeName')
            ->where('core_section_files.section_rs','=',$section_rs)
            ->where('core_section_files.ID','=',$key)
            ->where('core_section_files.section','=',$section)
            ->first();

            //dd($category_custom_fields);
            //echo "<pre>"; print_r($category_custom_fields); exit;

        }else{
            if(session('section_files'))
            $section_files = session('section_files');
            else
            $section_files = array();

            $file_detail = json_decode(json_encode($section_files[$key]));
        }

        return view('common::backend.component.files.file-add-edit-form', compact('file_detail','key'));
    }

}
