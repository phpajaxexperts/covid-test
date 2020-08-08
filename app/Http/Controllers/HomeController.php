<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Theme;

class HomeController extends Controller
{
    public function videoPopup(Request $request)
    {
        $ID = $request->ID;
        $video = DB::table('core_section_videos')->find($ID);

        if($video->type==1){
            $youtubevideoid = strip_embed_string($video->video_url);
            $youtubevideo = convertYouTubeVideo($youtubevideoid);
            $videotitle = $video->title;
            $video_embed_code = $youtubevideo;
        }else if($video->type==2){
            $str = $video->video_url;
            $id = substr(trim($str),strlen('http://vimeo.com/'));
            $video_code = convertVimeoVideo($id);
            $videotitle = $video->title;
            $video_embed_code = $video_code;
        }

        return view('video-popup', compact('videotitle','video_embed_code'));
    }

    public function about()
    {
        Theme::set('smkV1.0');
        return view('about');
    }

    public function contact()
    {
        Theme::set('smkV1.0');
        if($_POST){
            $name = cleanQuery($_POST['name']);
            $email_address = cleanQuery($_POST['email_address']);
            $subject = "Enquirey from Sameera Maya Kitchen";
            $mssg = "Name : ".cleanQuery($_POST['name']).'<br>';
            $mssg .= "Email Address : ".cleanQuery($_POST['email_address']).'<br>';
            $mssg .= "Subject : ".cleanQuery($_POST['subject']).'<br>';
            $mssg .= "Message : ".cleanQuery($_POST['message']).'<br>';

            //echo $mssg; exit;

            $to = 'sameeramayakitchen@gmail.com';
            $from = 'info@sameeramayakitchen.com';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: Sameera Maya Kitchen <" . $from.">";
            @mail($to,$subject,$mssg,$headers);
            $mail_status = 'Your enquiry has been sent successfully. Our support team will get in touch with you shortly.';
        }else{
            $mail_status = '';
        }
        return view('contact',compact('mail_status'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
    }
}
