<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//展示页面
Route::any('/',"Shop\IndexController@index");
Route::any('info/info',function (){
    echo phpinfo();
});//PHPinfo
/**微商城*/
//需要走中间件的 购物车页面
Route::group(['middleware'=>'logs','prefix'=>'cart'],function () {
    Route::any('shopcart',"Shop\IndexController@shopcart");//购物车页面
    Route::any('changenum',"Shop\CartController@changenum");//改变购买数量
    Route::any('cartDel',"Shop\CartController@cartDel");//单商品删除
    Route::any('payment',"Shop\CartController@payment");//提交订单
    Route::any('paymentdo',"Shop\CartController@paymentdo");//提交订单
    Route::any('paysuccess',"Shop\CartController@paysuccess");//提交订单
});
// 需要走中间件的 我的页面
Route::group(['middleware'=>'logs','prefix'=>'user'],function () {
    Route::any('userpage',"Shop\IndexController@userpage");//我的 页面
    Route::any('buyrecord',"Shop\userController@buyrecord");//潮购记录
    Route::any('willshare',"Shop\userController@willshare");//我的晒单
    Route::any('mywallet',"Shop\userController@mywallet");//我的钱包
    Route::any('address',"Shop\userController@address");//收货地址
    Route::any('writeaddr',"Shop\userController@writeaddr");//收货地址添加
    Route::any('invite',"Shop\userController@invite");//二维码分享
    Route::any('safeset',"Shop\userController@safeset");//安全设置
});
//不走中间件的
Route::prefix('index')->group(function () {
    Route::any('allshops/{id?}',"Shop\IndexController@allshops");//点击分类 带ID传页面
    Route::any('shopcontent/{id?}',"Shop\IndexController@shopcontent");//商品详情
    Route::any('memcache/{id?}',"Shop\IndexController@memcache");//商品详情介绍
    Route::any('cateshop',"Shop\IndexController@cateshop");//所有商品，分类，商品
    Route::any('host',"Shop\IndexController@host");//人气
    Route::any('new',"Shop\IndexController@news");//最新
    Route::any('asc',"Shop\IndexController@asca");//价格升
    Route::any('desc',"Shop\IndexController@desca");//价格降
    Route::any('search',"Shop\IndexController@search");//搜索
    Route::any('addcart',"Shop\IndexController@addcart");//加入购物车
});
//登录 注册
Route::prefix('login')->group(function () {
    Route::any('login',"Shop\LoginController@login");//登录
    Route::any('logindo',"Shop\LoginController@logindo");//登录
    Route::any('register',"Shop\LoginController@register");//注册页面
    Route::any('registerdo',"Shop\LoginController@registerdo");//注册执行
    Route::any('mobile',"Shop\LoginController@mobile");//获取验证码
    Route::any('checktel',"Shop\LoginController@checktel");//验证唯一性
});
//访问验证码的方法
route::any('verify/create','CaptchaController@create');

