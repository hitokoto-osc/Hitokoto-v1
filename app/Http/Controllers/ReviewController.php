<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class ReviewController extends Controller
{
    public function index(){
        ini_set("error_reporting",E_ALL ^ E_NOTICE);
        if($_GET['action']=="1"){
            //通过
            $result = DB::select("SELECT * FROM `hitokoto_pending` WHERE `id` ='".Input::get("id")."'");
            $data["hitokoto"] = $result[0]->hitokoto;
            $data["from"] = $result[0]->from;
            $data["creator"] = $result[0]->creator;
            $data["type"] = $result[0]->type;
            $data["created_at"] = $result[0]->created_at;
            DB::table("sentence")->insert($data);

            $results = DB::select("SELECT * FROM `hitokoto_sentence` WHERE `hitokoto` ='".$result[0]->hitokoto."'");
            if($results){
                DB::delete('delete from `hitokoto_pending` where `id` = '.$result[0]->id);
//                $memcache_obj = new Memcache;
//                $conn_status=$memcache_obj->connect('127.0.0.1', 11211);
//                if(!$conn_status){
//                    $massage = "<br />但是Memcache链接失败惹.";
//
//                }else{
//                    $memcache_obj->set('hitokoto_status', '2', MEMCACHE_COMPRESSED, 0);
//                    $massage = "<br />缓存刷新成功.";
//                }
                return "审核通过.#".$results[0]->id;
                
            }else{
                return "入库失败.";
            }

        }else{
            //拒绝
            $result = DB::select("SELECT * FROM `hitokoto_pending` WHERE `id` ='".Input::get("id")."'");
            $data["hitokoto"] = $result[0]->hitokoto;
            $data["from"] = $result[0]->from;
            $data["creator"] = $result[0]->creator;
            $data["type"] = $result[0]->type;
            $data["created_at"] = $result[0]->created_at;
            DB::table("refuse")->insert($data);
            DB::delete('delete from `hitokoto_pending` where `id` = '.$result[0]->id);
            return "入库成功.";
        }
        return "你能走到这证明PHP出错了.";
    }
}
