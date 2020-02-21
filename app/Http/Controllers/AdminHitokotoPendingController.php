<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\HitokotoPenging;

class AdminHitokotoPendingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function Index()
    {
        $results =\App\ HitokotoPending::all();
	foreach($results as $key => $value) {
	  $results[$key]->type = transformType($value->type);
        }
	$data = [];
	$data['collection'] = $results;
        return view('admin.hitokoto.pending',$data);
    }
}
