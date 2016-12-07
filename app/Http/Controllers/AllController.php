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
        ini_set("error_reporting",E_ALL ^ E_NOTICE);
        $result = DB::select("SELECT * FROM `hitokoto_pending` WHERE `creator` ='".Auth::user()->name."'");
        if(!$result){
            $back['pending_status']=1; 
        }else{
            $back['pending_result']=$result;
            $back['pending_status']=0;
            
        }
        $results = DB::select("SELECT * FROM `hitokoto_sentence` WHERE `creator` = '".Auth::user()->name."'");
        if(!$results){
            $back['sentence_status']=1; 
        }else{
            $back['sentence_result']=$results;
            $back['sentence_status']=0; 
        }
        if(Auth::user()->name=="freejishu" || Auth::user()->name=="酷儿"){
            $back['user_master']=1;
            $results = DB::select("SELECT * FROM `hitokoto_pending`");
            $back['user_check_list']=$results;
        }
        $result = DB::select("SELECT * FROM `hitokoto_refuse` WHERE `creator` ='".Auth::user()->name."'");
        if(!$result){
            $back['refuse_status']=1; 
        }else{
            $back['refuse_result']=$result;
            $back['refuse_status']=0; 
        }
        
        return view("all",$back);
    }
}
