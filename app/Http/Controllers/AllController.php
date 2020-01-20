<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class AllController extends Controller
{
    public function index() 
    {   
        //ini_set("error_reporting",E_ALL ^ E_NOTICE);
        $result = DB::select("SELECT * FROM `hitokoto_pending` WHERE `creator` ='".Auth::user()->name."'");
        if(!$result){
            $back['pending_status']=1; 
            $back['pending_result']=[];
        }else{
            $back['pending_status']=0;
            $back['pending_result']=$result;
            
        }
        $results = DB::select("SELECT * FROM `hitokoto_sentence` WHERE `creator` = '".Auth::user()->name."'");
        if(!$results){
            $back['sentence_status']=1; 
            $back['sentence_result']=[];
        }else{
            $back['sentence_status']=0; 
            $back['sentence_result']=$results;
        }
        if(Auth::user()->name=="freejishu" || Auth::user()->name=="酷儿"){
            $back['user_master']=1;
            $results = DB::select("SELECT * FROM `hitokoto_pending`");
            $back['user_check_list']=$results;
        }
        $result = DB::select("SELECT * FROM `hitokoto_refuse` WHERE `creator` ='".Auth::user()->name."'");
        if(!$result){
            $back['refuse_status']=1; 
            $back['refuse_result']=[];
        }else{
            $back['refuse_status']=0; 
            $back['refuse_result']=$result;
        }
        //return json_encode($back);
        
        return view("all",$back);
    }
}
