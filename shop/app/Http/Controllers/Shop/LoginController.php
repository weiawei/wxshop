<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\User;
use App\Http\Model\Common;

class LoginController extends Controller
{
    /**登录页面*/
    public function login(){
        return view('login');
    }
    /**登录执行页面*/
    public function logindo(Request $request){
        $data=$request->all();
        unset($data['_token']);
        $user=new User;
        $user_tel=$data['user'];
        $res=$user->where(['user_tel'=>$user_tel])->first();
        if($res){
            $user_pwd=decrypt($res['user_pwd']);
            if($data['user_pwd']==$user_pwd){
                session(['userInfo'=>$user_tel]);
                return  1;
            }else{
               return  2;
            }
        }else{
            exit('用户名错误');
        }
        return redirect('index');
    }
    /**新用户注册页面*/
    public function register(Request $request){
        return view('register');
    }
    /**新用户注册*/
    public function registerdo(Request $request){
        $data=$request->all();
        unset($data['_token']);
        unset($data['user_conpwd']);
        $user_code=1234;
        
        if($user_code!=$data['user_code']){
            exit('验证码错误');
        }
        $data['user_pwd']=encrypt($data['user_pwd']);
        $user=new User;
        $user->user_tel=$data['user_tel'];
        $user->user_pwd=$data['user_pwd'];
        $user->user_code=$data['user_code'];
        $res=$user->save();
        if($res){
            return 1;
        }else{
            return 2;
        }

    }
    /**验证唯一性*/
    public function checkTel(Request $request)
    {
        $user_tel=$request->mobile;
        $user=new User;
        //连接数据库 根据名称查询
        $data=$user->where(['user_tel'=>$user_tel])->first();
        if($data){
            return 'no';
        }else{
            return 'ok';
        }
    }
    /**发送短信，获取验证码*/
    public function mobile(Request $request){
        $mobile=$request->mobile;//接收手机号
        $res=$this->sendMobile($mobile);
    }
    /**短信验证*/
    private  function sendMobile($mobile){
        $host = env("MOBILE_HOST");
        $path = env("MOBILE_PATH");
        $method = "POST";
        $appcode = env("MOBILE_APPCODE");
        $headers = array();
        $code = Common::createcode(4);
        session(['mobilecode'=>$code]);
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$code."，3分钟内有效！&mobile=".$mobile;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        var_dump(curl_exec($curl));
        }
}
