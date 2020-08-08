<?php

namespace Modules\Common\Http\Controllers\Backend\SectionComponent\Src;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class TrivMetaComponent
{
    public static function create($ID)
    {

    }

    public static function store($ID)
    {
        $requestData = request()->all();
        if($requestData['meta_title']!='' || $requestData['meta_keywords']!='' || $requestData['meta_description']!=''){
            $arr_section_meta = array(
                'section_rs' => $ID,
                'section' => $requestData['section'],
                'meta_title' => $requestData['meta_title'],
                'meta_keywords' => $requestData['meta_keywords'],
                'meta_description' => $requestData['meta_description'],
            );
            DB::table('core_section_meta_detail')->insert($arr_section_meta);
        }
    }

    public static function edit($ID)
    {
        $section = view()->shared('section');
        $meta_detail = DB::table('core_section_meta_detail')
        ->where('core_section_meta_detail.section_rs','=',$ID)
        ->where('core_section_meta_detail.section','=',$section)
        ->first();
       //dd($selected_category);
        view()->share('meta_detail', $meta_detail);
    }

    public static function update($ID)
    {
        $requestData = request()->all();
        $section = view()->shared('section');
        $arr_meta_detail = array(
            'meta_title' => request()->meta_title,
            'meta_keywords' => request()->meta_keywords,
            'meta_description' => request()->meta_description,
        );
        $record_exist = DB::table('core_section_meta_detail')
        ->where('core_section_meta_detail.section_rs','=',$ID)
        ->where('core_section_meta_detail.section','=',$section)->first();

        if(isset($record_exist->ID)){
            DB::table('core_section_meta_detail')
            ->where('section_rs','=',$ID)
            ->where('section','=',request()->section)
            ->update($arr_meta_detail);
        }else{
            if($requestData['meta_title']!='' || $requestData['meta_keywords']!='' || $requestData['meta_description']!=''){
                $arr_meta_detail['section_rs'] = $ID;
                $arr_meta_detail['section'] = request()->section;
                DB::table('core_section_meta_detail')->insert($arr_meta_detail);
            }
        }
    }

    public static function destroy($ID)
    {
        DB::table('core_section_meta_detail')
        ->where('section_rs','=',$ID)
        ->where('section','=',request()->section)
        ->delete();
    }

}
