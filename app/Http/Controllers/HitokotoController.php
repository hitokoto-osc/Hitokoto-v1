<?php

namespace App\Http\Controllers;

use App\Hitokoto;
use App\Libraries\System;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class HitokotoController extends Controller
{
    public function index(){
        $id       = Input::get("id");
        $type     = Input::get("type");
        $hitokoto = Hitokoto::whereNotNull('hitokoto');

        if ($id) $hitokoto->where('id', $id);
        if ($type) $hitokoto->where('type', $type);
        if (!$id) $hitokoto->inRandomOrder();

        $result = $hitokoto->first();
        if (!$result) return view('errors.404');

        $result->from = $result->from ?: "无名";
        $likes = $result->like_number->count();

        return view('hitokoto', compact('result', 'likes'));
    }

    public function upload()
    {
        $uploadResult = System::upload('uploadfile');
        if($uploadResult) exit(json_encode(array('success' => true, 'file' => $uploadResult)));
        exit(json_encode(array('success' => false, 'msg' => $uploadResult)));
    }

    public function uploadProgress()
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }
        if (isset($_REQUEST['progresskey'])) {
            $status = apc_fetch('upload_' . $_REQUEST['progresskey']);
        } else {
            exit(json_encode(['success' => false]));
        }
        $pct  = 0;
        $size = 0;
        if (is_array($status)) {
            if (array_key_exists('total', $status) && array_key_exists('current', $status)) {
                if ($status['total'] > 0) {
                    $pct  = round(($status['current'] / $status['total']) * 100);
                    $size = round($status['total'] / 1024);
                }
            }
        }
        echo json_encode(['success' => true, 'pct' => $pct, 'size' => $size]);
    }
}
