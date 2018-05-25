<?php
namespace App\Http\Controllers;
ini_set('memory_limit', '1024M');
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CheckController extends Controller
{
    public function index(){
          // ini_set("error_reporting",E_ALL ^ E_NOTICE);
         preg_match_all("/\\d+/m", Input::get("id"), $matches);
         if ($matches[0][0]!= Input::get("id")){
            return "Check Error."; 
         }
        // if(@(int)Input::get('id')) {
        //  return '检测错误';
        //}
        // return '';
        
        $result = DB::select("SELECT * FROM `hitokoto_pending` WHERE `id` ='".Input::get("id")."'");
        
        //return $result;
        //return $result[0]->hitokoto;
        // if(file_get_contents ("http://hitokoto.cn/Qcloud/test.php")!="OK"){
        //    return "调用远程环境错误。";
        //}
        //$a = json_decode(file_get_contents("http://hitokoto.cn/Qcloud/demo.php?text=".$result[0]->hitokoto));
        //if(!$a){
        //    return "无分词结果。";
        //}
        
        $so = \scws_new();
        $so -> set_charset('utf8');
        $so -> set_dict('/usr/local/scws/etc/dict.utf8.xdb');
        $so -> send_text($result[0]->hitokoto); 
	$results = $so -> get_words("~un");
        $words = [];
        foreach($results as $v) {
 	    $words[] = $v["word"];
	}
	if (!$words) {
             $so -> close();
             return "对文本分词失败. (无法获得分词结果)";
        }
        $so -> close();
	// $words = $so -> get_result
        //Jieba::init();
        //JiebaAnalyse::init();
        // $result = DB::select("SELECT * FROM `hitokoto_sentence` WHERE `id` = 1");
        $back = '';
        // var_dump($results);
        return "搜索结果：".implode(",", $words);
        
        
        /*
        for ($i = 0; $i < count($result); $i++) {
            $sentence=$result[$i]->hitokoto;
            $a = JiebaAnalyse::extractTags($sentence, $top_k = 20);
            $back = $back . $a;
        }
        return "搜索结果：".$back;
        
        //$a = Jieba::cut($result[0]->hitokoto, true);
        
        
        $a = JiebaAnalyse::extractTags($result[0]->hitokoto, $top_k = 20);
        return $a;
        $b = 0;
        for ($i = 0; $i < count($a); $i++) {
            if($a[$i]){
                $result = DB::select("SELECT * FROM `hitokoto_sentence` WHERE `hitokoto` LIKE '%".$a[$i]."%' ");
                $back = '';
                for ($ii = 0; $ii < count($result); $ii++) {
                    $b = $b + 1;
                    $back = $back . "#" . $b ." ". $result[$ii]->hitokoto . "<br />";
                }
            }
            
        }
        */
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



