<?php

namespace Modules\Common\Http\Controllers\Backend\SectionComponent\Src;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Modules\Common\Entities\core_section_videos;
use View;

class TrivVideoComponent
{

    public function __construct() {
        //$this->middleware(['auth', 'clearance']); //clearance middleware lets only users with a //specific permission permission to access these resources
    }

    public static function create($ID)
    {
        $section_videos = array();
        session(['section_videos' => $section_videos]);
    }

    public static function store($ID)
    {
        if(session('section_videos'))
        $section_videos = session('section_videos');
        else
        $section_videos = array();

        if(count($section_videos)>0){
            foreach($section_videos as $section_video){
                $arr = array(
                    'section_rs' => $ID,
                    'section' => $section_video['section'],
                    'type' => $section_video['type'],
                    'title' => $section_video['title'],
                    'description' => $section_video['description'],
                    'video_url' => $section_video['video_url'],
                );
                core_section_videos::create($arr);
            }
        }
    }

    public static function edit($ID)
    {

        $section = view()->shared('section');
        
        $section_videos = core_section_videos::select(
            'core_section_videos.ID',
            'core_section_videos.title',
            'core_section_videos.type',
            'core_section_videos.video_url'
            )
        ->with('typeName')
        ->where('core_section_videos.section_rs','=',$ID)
        ->where('core_section_videos.section','=',$section)
        ->get();

        view()->share('section_videos', $section_videos);


    }

    public static function update($ID)
    {
        $requestData = request()->all();
        echo "Update Video Component";
    }

    public static function destroy($ID)
    {
        $requestData = request()->all();
        core_section_videos::where('section_rs','=',$ID)
        ->where('section','=',$requestData['section'])
        ->delete();
    }


    public function storeSectionVideo(Request $request)
    {
        
        $requestData = $request->all();
        
        //categorycustomfield::create($requestData);
        if($requestData['section_rs']){
            // $categorycustomfield_exist = core_section_videos::where('section_rs', $requestData['custom_field'])
            // ->where('category', $requestData['category'])
            // ->where('module', $requestData['module'])
            // ->first();

            //if(!isset($categor customfield_exist->ID)){
                $arr = array(
                    'section_rs' => $requestData['section_rs'],
                    'section' => $requestData['section'],
                    'type' => $requestData['video_type'],
                    'title' => $requestData['video_title'],
                    'description' => $requestData['video_description'],
                    'video_url' => $requestData['video_url'],
                );
                if(isset($requestData['key']))
                core_section_videos::where('ID','=',$requestData['key'])->update($arr);
                else
                core_section_videos::create($arr);
    
                $response = array(
                    'status' => 'success',
                    'msg' => 'Video Link Added successfully!'
                );
        }else{
            if(session('section_videos'))
                $section_videos = session('section_videos');
            else
                $section_videos = array();

            $arr_section_videos = array(
                'section'    =>  $requestData['section'],
                'type'   =>  $requestData['video_type'],
                'title'  =>  $requestData['video_title'],
                'description' => $requestData['video_description'],
                'video_url' => $requestData['video_url']
            );
        
            if(!in_array($arr_section_videos,$section_videos)){
                if(isset($requestData['key']))
                $section_videos[$requestData['key']] = $arr_section_videos;
                else
                $section_videos[] = $arr_section_videos;

                session(['section_videos' => $section_videos]);
                $response = array(
                    'status' => 'success',
                    'msg' => 'Video Link Added successfully!',
                    'section_videos' => session('section_videos')
                );
            }else{
                $response = array(
                    'status' => 'warning',
                    'msg' => ' Video Link not added successfully!,  please try again',
                    'section_videos' => session('section_videos')
                );
            }

        }
        
        return response()->json($response,200);
    }

    public function getSectionVideos(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;

        $key = $request->key;
        if(isset($section_rs)){
            $section_videos = core_section_videos::select(
                'core_section_videos.ID as key',
                'core_section_videos.title',
                'core_section_videos.type',
                'core_section_videos.video_url'
                )
            ->with('typeName')
            ->where('core_section_videos.section_rs','=',$section_rs)
            ->where('core_section_videos.section','=',$section)
            ->get();

            $str_video = '';
            if(count($section_videos)>0){
                foreach($section_videos as $key => $section_video){
                    $video_thumb_url = getVideoThumbUrl($section_video->video_url,$section_video->type);
                    $section_videos[$key]['video_thumb_url'] = $video_thumb_url;
                }
            }
            $response = array('videos' => $section_videos);
        }else{
            if(session('section_videos'))
            $section_videos = session('section_videos');
            else
            $section_videos = array();

            $str_video = '';
            if(count($section_videos)>0){
                foreach($section_videos as $key => $section_video){
                    $video_thumb_url = getVideoThumbUrl($section_video['video_url'],$section_video['type']);
                    $section_videos[$key]['video_thumb_url'] = $video_thumb_url;
                    $section_videos[$key]['key'] = $key;
                }
            }
            $response = array('videos' => $section_videos);
        }
        return response()->json($response,200);
    }

    public function deleteVideo(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;
        $key = $request->key;
        if($section_rs){
            core_section_videos::destroy($key);
            //categorycustomfield::destroy(['section_rs' => $section_rs,'section' => $section]);
        }else{
            if(session('section_videos'))
            $section_videos = session('section_videos');
            else
            $section_videos = array();
            
            unset($section_videos[$key]);

            session(['section_videos' => $section_videos]);
        }

        $response = array(
            'status' => 'warning',
            'msg' => 'Video deleted successfully!',
            'section_videos' => session('section_videos')
        );
        return response()->json($response,200);        

    }


    public function getSectionVideoForEdit(Request $request){
        $section_rs = $request->section_rs;
        $section = $request->section;
        $key = $request->key;
        if(isset($section_rs)){
            $video_detail = core_section_videos::select(
                'core_section_videos.ID',
                'core_section_videos.title',
                'core_section_videos.type',
                'core_section_videos.description',
                'core_section_videos.video_url'
                )
            ->with('typeName')
            ->where('core_section_videos.section_rs','=',$section_rs)
            ->where('core_section_videos.ID','=',$key)
            ->where('core_section_videos.section','=',$section)
            ->first();

            //dd($category_custom_fields);
            //echo "<pre>"; print_r($category_custom_fields); exit;

        }else{
            if(session('section_videos'))
            $section_videos = session('section_videos');
            else
            $section_videos = array();

            $video_detail = json_decode(json_encode($section_videos[$key]));
        }

        return view('common::backend.component.videos.video-add-edit-form', compact('video_detail','key'));
    }
}
