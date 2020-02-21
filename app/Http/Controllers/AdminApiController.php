<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HitokotoReview;


class AdminApiController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    
    
    public function getReviewSentence (Request $req) {
       $id = $req->get('sentenceId');
       if (!$id) {
           return response()->json([
               "status" => 403,
               "message" => "未授权的访问"
           ]);
       }
       $review = @HitokotoReview::find($id);
       if (!count($id)) {
         return response()->json([
           "status" => 403,
           "message" => "未授权的访问"
         ]);
       }
       return response()->json($review);

    }
    public function updateSentence(Request $request) {
        $id = $request->get('sentenceId');
        if (!$id) {
          return response()->json([
            "status" => 403,
            "message" => "未授权的访问",
          ]);
       }
       $review = @HitokotoReview::find($id);
       if (!count($id)) {
         return response()->json([
           "status" => 403,
           "message" => "未授权的访问"
         ]);
       }
       $content = $request->get("content");
       $source = $request->get("source");
       $author = $request->get("author");
       $categroy = $request->get("categroy");
       $creator = $request->get("creator");
       
       if ($content) {
           $review->hitokoto = $content;
       }
       
       if ($categroy) {
	$type;
        switch($categroy) {
           case "动漫": 
             $type = "a";
             break;
           case "漫画":
             $type = "b";
             break;
           case "游戏":
             $type = "c";
             break;
           case "文学":
             $type = 'd';
             break;
           case '原创':
             $type = 'e';
             break;
           case '来自网络':
             $type = 'f';
             break;
           case '其他':
             $type = 'g';
             break;
           case "影视":
             $type = "h";
             break;
           case "诗词":
             $type = 'i';
             break;
           case '网易云':
             $type = 'j';
             break;
           case '哲学':
             $type = 'k';
             break;
           case '抖机灵':
             $type = 'l';
             break;

           default:
             $type = 'a';
             break;
         }
	 $review->type = $type;
       }

       if($source) {
         $review->from = $source; 
       }
       
       if($creator) {
         $review->creator = $creator;
       }
       
       if($author) {
         $review->from_who = $author;
       }

       if (@$review->save()) {
         return response()->json([
           "status" => 200,
           "message" => "句子已更新"
         ]);
       } else {
          return response()->json([
            "status"=>400,
            "message"=>"更新句子时出错"
          ]);
       }
    }
}
