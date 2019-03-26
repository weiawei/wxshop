<?php

namespace App\Http\Controllers\Shop;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Cart;
use App\Http\Model\Goods;
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
    //提交订单执行
    public function paymentdo(Request $request)
    {   $user_tel=session('userInfo');
        $user=new User;
        $res=$user->where(['user_tel'=>$user_tel])->first();
        $user_id=$res['user_id'];
        if($user_tel!=''){
            $goods_id=$request->goods_id;
            $goods_id=rtrim($goods_id,',');
            $goods_id=explode(',',$goods_id);
            $cart=new Cart;
            $goods=new Goods;
            $rea=$goods
                ->where(['cart_status'=>1])
                ->where(['user_id'=>$user_id])
                ->whereIn('goods.goods_id',$goods_id)
                ->join('cart','cart.goods_id','=','goods.goods_id')
                ->get();
           session(['rea'=>$rea]);
           echo 1;
        }else{
           echo 2;
        }
    }
    //提交点单
    public function payment(){
        $rea=session('rea');
        return view('payment',['rea'=>$rea]);
    }
    //支付成功
    public function paysuccess()
    {
        return view('paysuccess');
    }
}
