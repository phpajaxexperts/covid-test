<?php

namespace Modules\Common\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ImgOptController extends Controller
{
    
    // Sample URL
    //http://127.0.0.1:8000/img-opt/media/classifieds/images/nature.jpeg?crop=faces&fit=crop&h=100&w=100&lossless=1&q=65

    public function imageOpt(){
         if(isset($_REQUEST['h']))
         $height = $_REQUEST['h'];
         else
         $height = '';
        // echo "Height :".$_REQUEST['h'].'<br>';
         if(isset($_REQUEST['w']))
         $width = $_REQUEST['w'];
         else
         $width = '';
        // echo "Width :".$_REQUEST['w'].'<br>';
        
        //$server_path = 'https://louderworks.imgix.net';
        $cur_uri_with_param = $_SERVER["REQUEST_URI"];
        $cur_uri = explode('?',$cur_uri_with_param);
        $img_path = substr($cur_uri[0],8,strlen($cur_uri[0]));

        $pathinfo = pathinfo($img_path);
        //echo "<pre>"; print_r($pathinfo); exit;
        $img_folder_path = $pathinfo['dirname'];
        $file_path = public_path($img_folder_path.'/'.md5($cur_uri_with_param).'.'.$pathinfo['extension']);

        if(file_exists($file_path)){
            header("Content-Type: image/jpeg");
            echo file_get_contents("$file_path");
        }else{
            $img_path = public_path($img_path);
            $img = Image::make($img_path);

            // resize image instance
            $img->fit($width, $height);
            
            // insert a watermark
            //$img->insert(public_path('Triv_Logo_small.png'));

            $img->text('TrivPro', $width/2, $height/2, function($font) {
                $font->file(public_path('watermark/Lato-Regular.ttf'));
                $font->size(45);
                //$font->color('#EEEEEE');
                $font->color(array(255, 255, 255, 0.5));
                $font->align('center');
                $font->valign('top');
                $font->angle(45);
            });        
            // save image in desired format
            
            $img->save($file_path);

            header("Content-Type: image/jpeg");
            echo file_get_contents("$file_path");
        }
    }
}
