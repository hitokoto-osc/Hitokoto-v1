<?php

namespace App\Http\Controllers;

use App\Hitokoto;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class HitokotoController extends Controller
{
    public function index(){
        $id = Input::get("id");
        $type = Input::get("type");
        $charset = Input::get("charset");

        if($id){
            if (!$type){
                $result = Hitokoto::where('id',$id)->first();
            } else {
                $result = Hitokoto::where('id',$id)->where('type',$type)->first();
            }

            if(!$result){
                return view('errors.404');
            }

        } else {
            if (!$type){
                $result = Hitokoto::orderBy(\DB::raw('RAND()'))->take(1)->first();
            } else {
                $result = Hitokoto::where('type',$type)->orderBy(\DB::raw('RAND()'))->take(1)->first();
            }
        }
        
        $data['hitokoto'] = $result->hitokoto;
        $data['type'] = $result->type;
        $data['from'] = $result->from ? $result->from : "无名";
        $data['creator'] = $result->creator;
        $data['ID']=$result->id;
        if($data['ID']){
            $results = DB::select('select * from hitokoto_like where sentenceID = '.$data['ID']);
            $data['like_number'] = count($results);
            //$data['like_number'] = $results -> {'count(*)'};
        }
        

        if($charset=='gbk')
        {
            //iconv("UTF-8", "GBK", $data);
        }
        return view('hitokoto' ,$data);
    }
}
