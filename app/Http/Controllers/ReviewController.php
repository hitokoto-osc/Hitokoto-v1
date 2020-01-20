<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Hitokoto;
use App\HitokotoReview;
class ReviewController extends Controller
{
    public function edit(HitokotoReview $result) {
        return view('editSentence', compact('result'));
    }
    
    public function index(){
        ini_set("error_reporting",E_ALL ^ E_NOTICE);
        if($_GET['action']=="1"){
            //通过
            $result = DB::table('pending')->where('id', (int)Input::get('id'))->first();
            $data = new Hitokoto();
            $data->hitokoto = $result->hitokoto;
            $data->from = $result->from;
            if ($result->from_who) { $data->from_who = $result->from_who; }
            $data->creator = $result->creator;
            if ($result->creator_uid) { $data->creator_uid = $result->creator_uid; }
            $data->type = $result->type;
            $data->reviewer = Auth::user()->id;
            $data->created_at = $result->created_at;
            $data->save();

            $results = Hitokoto::where('hitokoto', $result->hitokoto)->first();
            if($results){
                DB::table('pending')->where('id', $result->id)->delete();
//                $memcache_obj = new Memcache;
//                $conn_status=$memcache_obj->connect('127.0.0.1', 11211);
//                if(!$conn_status){
//                    $massage = "<br />但是Memcache链接失败惹.";
//
//                }else{
//                    $memcache_obj->set('hitokoto_status', '2', MEMCACHE_COMPRESSED, 0);
//                    $massage = "<br />缓存刷新成功.";
//                }
                return "审核通过.#".$results->id;
                
            }else{
                return "入库失败.";
            }

        }else{
            //拒绝
            $result = DB::select("SELECT * FROM `hitokoto_pending` WHERE `id` ='".Input::get("id")."'");
            $data["hitokoto"] = $result[0]->hitokoto;
            $data["from"] = $result[0]->from;
            if ($result[0]->from_who) { $data["from_who"] = $result[0]->from_who; }
            $data["creator"] = $result[0]->creator;
            if ($result[0]->creator_uid) { $data["creator_uid"] = $result[0]->creator_uid; }
            $data["type"] = $result[0]->type;
            $data["reviewer"] = Auth::user()->id;
            $data["created_at"] = $result[0]->created_at;
            DB::table("refuse")->insert($data);
            DB::delete('delete from `hitokoto_pending` where `id` = '.$result[0]->id);
            return "已拒绝.";
        }
        return "你能走到这证明PHP出错了.";
    }
}
