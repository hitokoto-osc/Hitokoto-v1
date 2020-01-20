<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
// use App\User;

class ApiController extends Controller
{

    public function index(){
        return view("api");
    }
    
    public function refreshToken() {
        $user = Auth::user();
        // var_dump($token);
        // die();
        $user->token = str_random(40);
        $user->update();
        return response()->json([
            'code' => 200,
            'message' => 'ok',
            'data' => [
                'token' => $user->token
            ],
        ]);
    } 
    public function getToken () {
	$user = Auth::user();
        // var_dump($token);
        // die();
	if ($user->token === '') {
            $user->token = str_random(40);
	    $user->update();
        }
        return response()->json([
            'code' => 200,
            'message' => 'ok',
            'data' => [
                'token' => $user->token
            ],
        ]);
    }
   
    public function testLogin() {
    
    }
}
