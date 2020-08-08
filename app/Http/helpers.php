<?php
function getUserBrowsingDevice()
{
    $tablet_browser = 0;
    $mobile_browser = 0;

    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $tablet_browser++;
    }

    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;
    }

    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
        $mobile_browser++;
    }

    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda ','xda-');

    if (in_array($mobile_ua,$mobile_agents)) {
        $mobile_browser++;
    }

    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
        $mobile_browser++;
        //Check for tablets on opera mini alternative headers
        $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
            $tablet_browser++;
        }
    }

    if ($tablet_browser > 0) {
        // do something for tablet devices
        return 'tablet';
    }
    else if ($mobile_browser > 0) {
        // do something for mobile devices
        return 'mobile';
    }
    else {
        // do something for everything else
        return 'desktop';
    }
}

function aasort (&$array, $key,$order = 'ASC') {
    $sorter=array();
    $ret=array();
    if(is_array($array))
        reset($array);

    if(count($array)>0){
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
    }
    if($order == 'ASC')
        asort($sorter);
    elseif($order == 'DESC')
        arsort($sorter);

    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
    return $array;
}

function timeZoneAdjust($format,$dat) {
    $dat = strtotime($dat);
    if(date('T',$dat)=='PST'){
        $dateadjusted = date($format,$dat+3600);
    }else{
        $dateadjusted = date($format,$dat);
    }
    return $dateadjusted;
}

function urlStringConvert($str) {
    $str=trim($str);
    $existdata = array(" ", "&", ",","'","?","/");
    $replacedata   = array("-", "and","","","","-");
    $covertstr = strtolower(str_replace($existdata, $replacedata, $str));
    $covertstr = urlencode($covertstr);
    return $covertstr;
}

function cleanQuery($string) {
    if(get_magic_quotes_gpc())  {
        $string = stripslashes($string);
    }
    if (phpversion() >= '4.3.0') {
    } else {
        $string = mysql_escape_string($string);
    }
    return $string;
}

function trimLength($s, $maxlength) {
    $words = explode(' ', $s);
    $split = '';
    foreach ($words as $word) {
        if (strlen($split) + strlen($word) < $maxlength)
            $split .= $word.' ';
        else
            break;
    }
    if(strlen($s) > $maxlength){
        $split=trim($split)." ...";
    }
    return $split;
}

function splitImages($img) {
    if($img){
    $img = list($img_name,$img_type) = explode(".",$img);
    $xs = $img_name."_xs.".strtolower($img_type);
    $th = $img_name."_th.".strtolower($img_type);
    $logo = $img_name."_logo.".strtolower($img_type);
    $reg = $img_name.".".strtolower($img_type);
    $lrg = $img_name."_lg.".strtolower($img_type);
    $as = $img_name."_as.".strtolower($img_type);
    $og = $img_name."_og.".strtolower($img_type);
    $arr_imgs = array("small" => $xs, "thumbnail" => $th, "standard" => $reg, "large" => $lrg, "actual" => $as, "logo" => $logo, "original" => $og);
    return $arr_imgs;
    }
}

function getVideosInformation($videos){
    $arr_videos = array();
    if(count($videos)>0){
        foreach ($videos as $video){
            if($video->type_format==1) {
                $youvideoid = strip_embed_string($video->video);
                $ytdata = @file_get_contents('https://www.googleapis.com/youtube/v3/videos?key=AIzaSyBjPH3vS2_Z0w8o1i0Dt_Biw82TEVHxaeA&part=snippet,contentDetails&id='.$youvideoid);
                $youtube = json_decode($ytdata, TRUE);
                //echo "<pre>";print_r($youtube['pageInfo']['totalResults']); exit;
                if($youtube['pageInfo']['totalResults']>0){
                    $video_title = $youtube['items'][0]['snippet']['title'];
                    $video_duration = converYouTubetime($youtube['items'][0]['contentDetails']['duration']);
                    $video_thumb_url = $youtube['items'][0]['snippet']['thumbnails']['default']['url'];
                    $arr_videos[] = array('type'=>'youtube','videoid'=>$video->ID,'youtubevideoid'=>$youvideoid,'title'=>$video_title,'duration'=>$video_duration);
                }
            }elseif($video->type_format==2){
                $str = $video->video;
                $id = substr(trim($str),strlen('http://vimeo.com/'));
                $videodata = @file_get_contents('http://vimeo.com/api/v2/video/'.$id.'.json');
                $videodata = json_decode($videodata,true);
                if($videodata){
                    $durationInSeconds = $videodata[0]['duration'];
                    $duration = floor($durationInSeconds/60).":".$durationInSeconds % 60;
                    $arr_videos[] = array('type'=>'vimeo','videoid'=>$video->ID,'vimeovideoid'=>$id,'title'=>$video_title,'author'=>$videodata[0]['user_name'],'viewcount'=>$videodata[0]['stats_number_of_plays'],'duration'=>$duration, 'image' => $videodata[0]['thumbnail_small']);
                }
            }
        }
        return $arr_videos;
    }
}

function convertYouTubeVideo($id){
    if ($id)
        $rs='<embed src="http://www.youtube.com/v/'.$id.'&rel=1" type="application/x-shockwave-flash" wmode="transparent" allowfullscreen="true" width="460" height="295"></embed><br />';
    else
        $rs="";
    return 	$rs;
}


function convertHomeYouTubeVideo($id){
    if ($id)
        $rs='<embed src="http://www.youtube.com/v/'.$id.'&rel=1" type="application/x-shockwave-flash" wmode="transparent" allowfullscreen="true" width="330" height="300"></embed><br />';
    else
        $rs="";
    return 	$rs;
}

function convertVimeoVideo($id){
    if ($id)
        $rs = '<iframe width="460" height="295" frameborder="0" src="http://player.vimeo.com/video'.$id.'"?title=0&autoplay=1&byline=0&portrait=0"></iframe><br />';
    else
        $rs="";
    return 	$rs;
}

function strip_embed_string($str) {
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $str, $youvideoid);
    if($youvideoid)
    return $youvideoid[0];
}

function converYouTubetime($youtube_time) {
    preg_match_all('/(\d+)/',$youtube_time,$parts);

    // Put in zeros if we have less than 3 numbers.
    if (count($parts[0]) == 1) {
        array_unshift($parts[0], "0", "0");
    } elseif (count($parts[0]) == 2) {
        array_unshift($parts[0], "0");
    }

    $sec_init = $parts[0][2];
    $seconds = $sec_init%60;
    $seconds_overflow = floor($sec_init/60);

    $min_init = $parts[0][1] + $seconds_overflow;
    $minutes = ($min_init)%60;
    $minutes_overflow = floor(($min_init)/60);

    $hours = $parts[0][0] + $minutes_overflow;

    if($hours != 0)
        return $hours.':'.$minutes.':'.$seconds;
    else
        return $minutes.':'.$seconds;
}

function convertToPhoneFormat($phone_num) {
    //$phone = '000-0000-0000';
    if(!preg_match("/^([0-9]{3}) [0-9]{4}-[0-9]{4}$/", $phone_num)) {
        // $phone is valid
        $arr_number[] = substr($phone_num, 0,3);
        $arr_number[] = substr($phone_num, 3,3);
        $arr_number[] = substr($phone_num, 6,4);
        return '('.$arr_number[0].') '.$arr_number[1].' - '.$arr_number[2];
    }else{
        return $phone_num;
    }
}

function getInstagram(){
    //$instagramurl = "https://api.instagram.com/v1/users/self/media/recent/?access_token=4749573384.1677ed0.c98f68b98b4f4223aaa2321209e42f68&&count=200";
    $instagramurl = "https://api.instagram.com/v1/users/self/media/recent/?access_token=".config('app.instagram_token')."&count=200";
    $instach = curl_init($instagramurl);
    curl_setopt($instach, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($instach, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($instach, CURLOPT_SSL_VERIFYPEER, FALSE);
    $instacontents = curl_exec($instach);
    curl_close($instach);
    $instaData = json_decode($instacontents, TRUE);
    if($instaData){
        if($instaData['data']){
            foreach($instaData['data'] as $insta) {
                $date = date('m.d.Y', $insta['caption']['created_time']);
                $link = "http://instagram.com/".$insta['caption']['from']['username'];
                $arr_insta[] = array("date"=>$date, "name"=>$insta['user']['full_name'], "title"=>$insta['caption']['text'], "link"=>$link, "image"=>$insta['images']['low_resolution']['url'], "image_link"=>$insta['link'], "link_name" => $insta['caption']['from']['full_name'], "comments_count" => $insta['comments']['count'], "likes_count" => $insta['likes']['count']);
            }
        }
        return  $arr_insta;
    }
}

function getControllerName() {
    try{
   $currentAction= Route::getCurrentRoute()->getActionName();
    if($currentAction){
        list($controller, $method) = explode('@', $currentAction);
        $controllerName = preg_replace('/.*\\\/', '', $controller);
        return $controllerName;
    }
    }catch(Exception $e) {
        return;
    }
}

function getActionName() {
    try{
        $currentAction= Route::getCurrentRoute()->getActionName();
        if($currentAction) {
            list($controller, $method) = explode('@', $currentAction);
            $actionName = preg_replace('/.*\\\/', '', $method);
            return $actionName;
        }
    }catch(Exception $e) {
        return;
    }
}

function themeURL($path) {

}

function removeElementFromArrayByKey($data,$key_name){
    foreach ($data as $key => $subArr) {
        unset($subArr[$key_name]);
        $data[$key] = $subArr;  
    }
    return $data;
}

function makeSingleDimArrByKey($data,$key_name){
    $arr = [];
    foreach ($data as $key => $subArr) {
        $arr[] = $subArr['value'];
    }
    return $arr;
}


function fileUrlGenerator($arr){
    $file_url = config('app.media_folder').'/';
    $file_url .= $arr['file_folder'];
    
    return $file_url;
}


function imageUrlGenerator($arr){
    $img_url = url(config('app.image_crop_url')).'/';
    $img_url .= config('app.media_folder').'/';
    $img_url .= $arr['img_folder'].'/'.$arr['ID'].'/'.$arr['image'];
    $img_url .= $arr['img_optimize_params'];
    return $img_url;
}


function imagePathGenerator($arr){
    $section_detail = getSection($arr['section']);
    $section_collection_name = str_replace(['#', '/', '\\', ' '], '', $section_detail->collection_name);
    $img_folder = config('app.media_folder').'/'.strtolower($section_collection_name).config(strtolower($section_detail->administrator_modules->module_config_name).'.img_path');
    $img_folder_tmp = config('app.media_folder').'/'.strtolower($section_collection_name).config(strtolower($section_detail->administrator_modules->module_config_name).'.img_path').'_tmp';

    $img_optimize_params = getCdnImageOptimizeParams($arr);

    $img_path = config('app.image_crop_url').'/'.$img_folder;
    $img_path_tmp = config('app.image_crop_url').'/'.$img_folder_tmp;
    $arr_img_path_detail = array(
        'img_path' => url($img_path),
        'img_path_tmp' => url($img_path_tmp),
        'img_folder' => $img_folder,
        'img_folder_tmp' => $img_folder_tmp,
        'img_optimize_params' => $img_optimize_params
    );

    return $arr_img_path_detail;
}

function getCdnImageOptimizeParams($arr){
    if(isset($arr['img_width'])!='' && isset($arr['img_height'])!=''){
        $img_width = $arr['img_width'];
        $img_height = $arr['img_height'];
    }else{
        $image_size = DB::table('core_image_sizes')
        ->where('core_image_sizes.section','=',$arr['section'])
        ->where('core_image_sizes.name','=',$arr['img_size_name'])
        ->get()->first();

        //dd($arr);

        if(isset($image_size->width))
        $img_width = $image_size->width;
        else
        $img_width = '';

        if(isset($image_size->height))
        $img_height = $image_size->height;
        else
        $img_height = '';
    }

    $ar = '';
    if(isset($arr['aspect_ratio'])){
        $ar = '&ar='.$arr['aspect_ratio'];
    }

    $str = '?crop=faces&fit=crop&h='.$img_height.'&w='.$img_width.'&lossless=1&q=65'.$ar;

    return $str;
}


function getVideoThumbUrl($video_url,$video_type){
    if($video_type == 1){
        $thumb_url = "http://img.youtube.com/vi/".getYouTubeVideoID($video_url)."/mqdefault.jpg";
    }elseif($video_type == 2){
        
        $id = substr(trim($video_url),strlen('https://vimeo.com/'));
        $videodata = @file_get_contents('http://vimeo.com/api/v2/video/'.$id.'.json');
        $videodata = json_decode($videodata,true);

        $thumb_url = $videodata[0]['thumbnail_medium']; 
    }
    return $thumb_url;
}


function getYouTubeVideoID($video_url){
    $video_id = '';
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $video_url, $match)) {
        $video_id = $match[1];
    }
    return $video_id;
}

function clearCache()
{
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
}

?>
