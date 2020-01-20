<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AdminHitokotoPendingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function Index()
    {
        $results = DB::select("SELECT * FROM `hitokoto_pending`");
        $back['user_check_list']=$results;
        return view('admin.hitokoto.pending',$back);
    }
}
