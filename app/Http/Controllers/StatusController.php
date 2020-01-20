<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StatusController extends Controller
{

    public function Index()
    {
        return view('status');
    }
} 
