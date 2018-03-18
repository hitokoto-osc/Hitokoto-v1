<?php

namespace App\Http\Controllers;

use App\Like;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller
{
    public function get() {
      $id = @(int)Input::get("ID");
      if (!$id || $id == 0) {
        return response() -> json([
          "status" => 400,
          "message" => "Bad Request",
          "data" => []
        ]);
      }
      $result = Like::where("sentenceID", $id)->get();
      $set = array();
      foreach($result as $raw) {
        $set[] = $raw;
      }
      return response() -> json([
        "status" => 0,
        "message" => "ok",
        "data" => [
          "set" => $set,
          "total" => count($set)
        ]
      ]);
    }
    public function index(){
        preg_match_all("/\\d+/m", Input::get("ID"), $matches);
        if ($matches[0][0]!= Input::get("ID")){
            return "谢谢主人的喜欢~~"; 
        }
        function getIp(){ 
            $onlineip=''; 
            if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){ 
                $onlineip=getenv('HTTP_CLIENT_IP'); 
            } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){
                $onlineip=getenv('HTTP_X_FORWARDED_FOR'); 
            } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){ 
                $onlineip=getenv('REMOTE_ADDR'); 
            } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){ 
                $onlineip=$_SERVER['REMOTE_ADDR']; 
            } 
            return $onlineip; 
        }
        
        $result = DB::select('select * from hitokoto_like where sentenceID = '.$_GET['ID'].' AND ip = \''.getIp()."'");
        if($result){
            return "句子们已经感受到你的爱了哦~"; 
        }
        DB::insert('insert into hitokoto_like (ID, sentenceID, ip, time) values (NULL, ?, ?, NOW())', [$_GET['ID'], getIp()]);
        return "谢谢主人的喜欢~"; 
    
    
}
}
