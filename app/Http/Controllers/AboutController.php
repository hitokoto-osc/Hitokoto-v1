<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AboutController extends Controller
{
    public function index(){
        return view("about");
    }
}
