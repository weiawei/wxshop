<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Captcha;
class CaptchaController extends Controller
{
    public function create()
    {
        $verify = new Captcha();//调用第三方  实例化
        $code = $verify->getCode();//获取验证码的值
        session(['imgcode'=>$code]);//把验证码的值存session
        return $verify->doimg();//返回图片


    }
}