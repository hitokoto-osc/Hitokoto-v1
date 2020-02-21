<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;

use Ramsey\Uuid\Uuid as UUID;

class v1Controller extends Controller
{
    public function append ()
    { 
        if (!Input::has('token')) {
            return response()->json([
               'code' => -1,
               'message' => 'no auth',
                'data' => [
                ],
            ]);
        }

        $user = User::where('token', Input::get('token'))->first();
        if($user && Input::has('hitokoto','from','type')){
            $data["hitokoto"] = Input::get('hitokoto');
            $data["from"] = Input::get('from');
            if (Input::has('from_who') && Input::get('from_who') !== '') {
                $data["from_who"] = Input::get("from_who");
            }
            $data["creator"] = Auth::user()->name;
            $data["type"] = Input::get('type');
            $data["creator_uid"] = Auth::user()->id;
            $data["uuid"] = UUID::uuid4();
            $data["created_at"] = strtotime("now");
            DB::table("pending")->insert($data);
            return response()->json([
                'code' => 200,
                'message' => 'ok',
                'data' => [
                    'hitokoto' => $data
                ],
            ]);
  	}
        
       return response()->json([
            'code' => -1,
            'message' => 'auth error.',
            'data' => [
            ],
        ]);
    }
}                                                                                                                                                                                                
