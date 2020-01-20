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
        $display = [
          "id" => $raw -> ID,
          "sid" => $raw -> sentenceID,
          "ip" => (Input::get('realIP')) ? ($raw -> ip) : (preg_replace('~(\d+)\.(\d+)\.(\d+)\.(\d+)~', "$1.$2.*.*", $raw -> ip)),
          "created_time" => $raw -> time
        ];
        $set[] = $display;
      }
      return response() -> json([
        "status" => 0,
        "message" => "ok",
        "data" => [
          "sets" => $set,
          "total" => count($set)
        ]
      ]);
    }
    public function index(){
        preg_match_all("/\\d+/m", Input::get("ID"), $matches);
        if ($matches[0][0]!= Input::get("ID")){
            return response()->json([
                "status" => 400,
                "message" => "谢谢主人的喜欢~~",
                "data" => []
            ]); 
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
        
        $result = Like::where('sentenceID', '=', Input::get('ID'))->where('ip', '=', getIp())->get();
        if(count($result) > 0){
            return response()->json([
                "status" => 1,
                "message" => "句子们已经感受到你的爱了哦~",
                "data" => [
                     "ip" => getIp(),
                     //"set" => $result
                     "sets" => [
                       "id" => $result[0] -> ID,
                       "sid" => $result[0] -> sentenceID,
                       "ip" => $result[0] -> ip,
                       "created_time" => $result[0] -> time
                     ] 
                ]
            ]); 
        } else {
            Like::insert([
                "sentenceID" => Input::get("ID"),
                "ip" => getIp(),
                "time" => DB::raw('NOW()')
            ]);
            return response()->json([
                "status" => 0,
                "message" => "谢谢主人的喜欢~",
                "data" => [
                    "ip" => getIp()
                ] 
            ]); 
       }
    }
}
