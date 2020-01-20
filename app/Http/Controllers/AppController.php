<?php

namespace App\Http\Controllers;

use Log;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;


class AppController extends Controller
{
    public function login(Request $request){
        if(@$_GET['test']){
            $data = json_decode($_GET['test'],true);
        }else{
            $data = $request->all();
        }
        Log::info('info:', ['msg' => $data]);

        //return '';
        if(!$data)return response()->json(['code' => '-1', 'msg' => '请求有误。您可以尝试重新提交请求，若持续出现此错误请联系我们。' ]);
        

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            // 认证通过...
            return response()->json(['code' => '200', 'msg' => '登录成功。' ]);
        }else{
            return response()->json(['code' => '-1', 'msg' => '登录失败。请检查您提交的邮箱和密码是否正确和匹配。']);
        }
        return ' ';
    }
    
    public function get_my_hitokoto(Request $request){
        if (!Auth::check()) {
            return response()->json(['code' => '-1', 'msg' => '未登录，请先登录。']);
        }
        
        $result = DB::select("SELECT * FROM `hitokoto_pending` WHERE `creator` ='".Auth::user()->name."'");
        if(!$result){
            $back['pending_status']=1; 
        }else{
            $back['pending_result']=$result;
            $back['pending_status']=0;
            
        }
        $results = DB::select("SELECT * FROM `hitokoto_sentence` WHERE `creator` = '".Auth::user()->name."'");
        if(!$results){
            $back['sentence_status']=1; 
        }else{
            $back['sentence_result']=$results;
            $back['sentence_status']=0; 
        }
        /*
        if(Auth::user()->name=="freejishu" || Auth::user()->name=="酷儿"){
            $back['user_master']=1;
            $results = DB::select("SELECT * FROM `hitokoto_pending`");
            $back['user_check_list']=$results;
        }
        */
        $result = DB::select("SELECT * FROM `hitokoto_refuse` WHERE `creator` ='".Auth::user()->name."'");
        if(!$result){
            $back['refuse_status']=1; 
        }else{
            $back['refuse_result']=$result;
            $back['refuse_status']=0; 
        }
        return response()->json(['code' => '200', 'msg' => 'Success', 'data' => ['username' => Auth::user()->name,'sentence' => $back]]);
    }
    
    public function get_my_information(Request $request){
        if (!Auth::check()) {
            return response()->json(['code' => '-1', 'msg' => '未登录，请先登录。']);
        }
        
        //通过用户验证
        
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

        return response()->json(['code' => '200', 'msg' => 'Success', 'data' => ['username' => Auth::user()->name,'email' => Auth::user()->email,'avatar'=>"https://gravatar.loli.net/avatar/".md5(Auth::user()->email)."?s=200&d=mm&r=g",'sentence' => $back]]);
        
    }
    
    public function add_new_sentence(Request $request){
        if (!Auth::check()) {
            return response()->json(['code' => '-1', 'msg' => '未登录，请先登录。']);
        }
        if(@$_GET['test']){
            $data = json_decode($_GET['test'],true);
        }else{
            $data = $request->all();
        }
        //{"hitokoto":"xxxxxx","from":"xxxxx","type":"xxxxxxx"}
        if(!$data)return response()->json(['code' => '-1', 'msg' => '请求有误。您可以尝试重新提交请求，若持续出现此错误请联系我们。' ]);

        if($data['hitokoto'] && $data['from'] && $data['type']){
            $data["hitokoto"] = $data['hitokoto'];
            $data["from"] = $data['from'];
            $data["creator"] = Auth::user()->name;
            $data["type"] = $data['type'];
            $data["created_at"] = strtotime("now");
            DB::table("pending")->insert($data);
            return response()->json(['code' => '200', 'msg' => '添加成功。我们会尽快审核。' ]);
        } else {
            return response()->json(['code' => '-1', 'msg' => '添加失败。请检查您的一言中是否存在非法字符，然后重试。若长时间出现此问题，请联系我们。' ]);
        }
        
        return response()->json(['code' => '-1',  'msg' => '遇到意料之外的错误，请重试。若长时间出现此问题，请联系我们。' ]);
    }
    
    public function app_announcement(Request $request){
        return response()->json(['code' => '200',  'msg' => '测试公告。' ]);
    }
    
    public function oauth_status(Request $request){
        return response()->json([
            'code' => '200', 
            'msg' => [
                'all' => [ 'status' => true,'msg' => '不能登录的时候这里会有原因。比如：系统维护。'],
                'login' => [ 'status' => true,'msg' => '不能登录的时候这里会有原因。比如：系统维护。'],
                'get_information' => [ 'status' => true,'msg' => '不能登录的时候这里会有原因。比如：系统维护。'],
                'get_all_hitokoto' => [ 'status' => true,'msg' => '不能登录的时候这里会有原因。比如：系统维护。'],
                'add' => [ 'status' => true,'msg' => '不能登录的时候这里会有原因。比如：系统维护。'],
                'app_announcement' => [ 'status' => true,'msg' => '不能登录的时候这里会有原因。比如：系统维护。']
                ]
            ]
        );
    }
}
