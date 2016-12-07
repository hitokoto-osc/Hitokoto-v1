<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {   
        ini_set("error_reporting",E_ALL ^ E_NOTICE);
        $result = DB::select("SELECT * FROM `hitokoto_pending` WHERE `creator` ='".Auth::user()->name."'");
        if(!$result){
            $back['pending_status']=1; 
        }else{
            $back['pending_result']=$result;
            $back['pending_status']=0;
            if(count($result)>5){
                $back['pending_times']=5; 
            }else{
                $back['pending_times']=count($result); 
            }
            
        }
        $results = DB::select("SELECT * FROM `hitokoto_sentence` WHERE `creator` = '".Auth::user()->name."'");
        if(!$results){
            $back['sentence_status']=1; 
        }else{
            $back['sentence_result']=$results;
            $back['sentence_status']=0; 
            if(count($results)>5){
                $back['sentence_times']=5; 
            }else{
                $back['sentence_times']=count($results); 
            }
        }
        if(Auth::user()->name=="freejishu" || Auth::user()->name=="酷儿"){
            $back['user_master']=1;
            $results = DB::select("SELECT * FROM `hitokoto_pending`");
            $back['user_check_list']=$results;
        }

        return view("home",$back);
    }
}