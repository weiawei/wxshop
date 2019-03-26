<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{
    //潮购记录
    public function buyrecord()
    {
        return view('buyrecord');
    }
    //晒单
    public function willshare()
    {
        return view('willshare');
    }
    //我的钱包
    public function mywallet()
    {
        return view('mywallet');
    }
    //收货地址
    public function address()
    {
        return view('address');
    }
    //收货地址添加
    public function writeaddr(){
        return view('writeaddr');
    }
    //分享
    public function invite()
    {
        return view('invite');
    }
    //设置
    public function safeset()
    {
        return view('safeset');
    }

}
