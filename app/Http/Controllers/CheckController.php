<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
class CheckController extends Controller
{
    public function index(){
        ini_set("error_reporting",E_ALL ^ E_NOTICE);
        preg_match_all("/\\d+/m", Input::get("id"), $matches);
        if ($matches[0][0]!= Input::get("id")){
            return "Check Error."; 
        }
        $result = DB::select("SELECT * FROM `hitokoto_pending` WHERE `id` ='".Input::get("id")."'");
        //return $result[0]->hitokoto;
        if(file_get_contents ("http://hitokoto.cn/Qcloud/test.php")!="OK"){
            return "调用远程环境错误。";
        }
        $a = json_decode(file_get_contents("http://hitokoto.cn/Qcloud/demo.php?text=".$result[0]->hitokoto));
        if(!$a){
            return "无分词结果。";
        }
        $b = 0;
        for ($i = 0; $i < count($a); $i++) {
            if($a[$i]){
                $result = DB::select("SELECT * FROM `hitokoto_sentence` WHERE `hitokoto` LIKE '%".$a[$i]."%' ");
                for ($ii = 0; $ii < count($result); $ii++) {
                    $b = $b + 1;
                    $back = $back . "#" . $b ." ". $result[$ii]->hitokoto . "<br />";
                }
            }
            
        }
        if (!$back){
            $back = "无相近结果。";
        }else{
            $back = "共".$b."条<br />".$back;
        }
        return "搜索结果：".$back;
        
    }
    
    public function admin_review(){
        return "OK!";
        
    }
}



