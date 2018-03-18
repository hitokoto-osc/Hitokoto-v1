<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AddController extends Controller
{
    public function index ()
    {
        if(Input::has('hitokoto','from','type')){
            $data["hitokoto"] = Input::get('hitokoto');
            $data["from"] = Input::get('from');
            $data["creator"] = Auth::user()->name;
            $data["type"] = Input::get('type');
            $data["created_at"] = strtotime("now");
            DB::table("pending")->insert($data);
            return redirect('home');
        } else {
            return view('add');
        }
    }
}
