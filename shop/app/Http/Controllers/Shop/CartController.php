<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Cart;
class CartController extends Controller
{
    //改变购买数量
    public function changenum(Request $request)
    {
        $goods_id=$request->goods_id;
        $buy_number=$request->buy_number;
        $cart=new Cart;
        $res=$cart->where(['goods_id'=>$goods_id])->update(['buy_number'=>$buy_number]);
    }
    //单商品删除
    public function cartDel(Request $request)
    {
        $goods_id=$request->goods_id;
        $cart=new Cart;
        $res=$cart->where(['goods_id'=>$goods_id])->update(['cart_status'=>2]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
}
