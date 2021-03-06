<?php

namespace App\Http\Controllers\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Goods;
use App\Http\Model\Categories;
use App\Http\Model\Cart;
use App\Http\Model\User;
class IndexController extends Controller
{
    /**网站首页*/
    public function index(){
        $goods=new Goods;
        //商品列表
        $res=$goods->get();
        //猜你喜欢
        $rea=$goods->limit(4)->get();
        //分类
        $cate=new Categories;
        $rec=$cate->where(['cate_navshow'=>1])->get();
        return view('index',['res'=>$res,'rea'=>$rea,'rec'=>$rec]);
    }
    /**所有商品*/
    public function  allshops($id)
    {
        $cate=new Categories;
        //获取分类
        $where=[
            'pid'=>0
        ];
        $rea=$cate->where($where)->get();
        $goods=new Goods;
        if($id==0){
            //获得所有商品
            $res=$goods->get();
        }else{
            //获取当前分类商品
            $cate_id=$id;
            $cateInfo=$cate->get();
            $allId=$this->getSonCateInfo($cateInfo,$cate_id);
//            dd($allId);
            $res=$goods->whereIn('cate_id',$allId)->get();
        }
        return view('allshops',['res'=>$res,'rea'=>$rea,'id'=>$id]);
    }
    /**商品详情*/
    public function shopcontent($id)
    {
        $goods=new Goods;
        $res=$goods->where(['goods_id'=>$id])->first();
        $imgs=rtrim($res['goods_imgs'],"|");//去掉右边特殊符号
        $goods_imgs=[];
        $goods_imgs+=explode('|',$imgs);
        return view('shopcontent',['res'=>$res,'goods_imgs'=>$goods_imgs]);
    }
    /**商品详情*/
    public function memcache($id)
    {
        $goods=new Goods;
        $res=$goods->where(['goods_id'=>$id])->first();
        return view('memcache',['res'=>$res]);
    }
    /**购物车*/
    public function  shopcart(){
        $user_tel=session('userInfo');
        $user=new User;
        $res=$user->where(['user_tel'=>$user_tel])->first();
        $user_id=$res['user_id'];
        $cart=new Cart;
        //商品
        $res=$cart
            ->join('goods', 'goods.goods_id', '=', 'cart.goods_id')
            ->where('cart_status',1)
            ->where(['user_id'=>$user_id])
            ->get();
        //人气
        $rea=$cart
            ->join('goods', 'goods.goods_id', '=', 'cart.goods_id')
            ->orderby('buy_number','desc')
            ->get();
        return view('shopcart',['res'=>$res,'rea'=>$rea]);
    }
    /**我的*/
    public function  userpage(){
        $user_name=session('userInfo');
        $user=new User;
        $res=$user->where(['user_tel'=>$user_name])->first();
        return view('userpage',$res);
    }
    /**商品分类*/
    public function cateshop(Request $request){
        $cate_id=$request->cate_id;
        $cate=new Categories;
        $info=$cate->get();
        $allId=$this->getSonCateInfo($info,$cate_id);
        $goods=new Goods;
        $res=$goods->whereIn('cate_id',$allId)->get();
        return view('div',['res'=>$res]);
    }
    /**最火*/
    public function host(Request $request){
        $cart=new Cart;
        $res=$cart
            ->join('goods', 'goods.goods_id', '=', 'cart.goods_id')
            ->orderby('buy_number','desc')
            ->get();
        return view('div',['res'=>$res]);
    }
    /**最新*/
    public function news(Request $request){
        $goods=new Goods;
        $res=$goods
            ->orderby('create_time','desc')
            ->get();
        return view('div',['res'=>$res]);
    }
    /**价格升*/
    public function asca(Request $request){
        $goods=new Goods;
        $res=$goods
            ->orderby('self_price','asc')
            ->get();
        return view('div',['res'=>$res]);
    }
    /**价格降*/
    public function desca(Request $request){
        $goods=new Goods;
        $res=$goods
            ->orderby('self_price','desc')
            ->get();
        return view('div',['res'=>$res]);
    }
    /**搜索*/
    public function search(Request $request){
        $search=$request->search;
        $goods=new Goods;
        $res=$goods->where('goods_name','like',"%$search%")->get();
        return view('div',['res'=>$res]);
    }
    /**递归*/
    function getSonCateInfo($cateInfo,$pid){
        static $cate_id=[];
        foreach($cateInfo as $k=>$v){
            if($v->pid==$pid){
                $cate_id[]=$v->cate_id;
                $this->getSonCateInfo($cateInfo,$v->cate_id);
            }
        }
        return $cate_id;
    }
    /**加入购物车*/
    public function addcart(Request $request){
        $user_name=session('userInfo');
        $user=new User;
        $res=$user->where(['user_tel'=>$user_name])->first();
        $user_id=$res['user_id'];
        if($user_name!=''){
            $user=new User;
            $res=$user->where(['user_tel'=>$user_name])->first();//获取到用户id
            $cart=new Cart;
            $goods_id=$request->goods_id;
            $reb=$cart
                ->where(['goods_id'=>$goods_id])
                ->where(['user_id'=>$user_id])
                ->first();
            if($reb!=''){
                $buy_number=$reb['buy_number']+1;
                $rea=$cart->where(['goods_id'=>$goods_id])->update(['buy_number'=>$buy_number]);
            }else{
                $cart->goods_id=$request->goods_id;
                $cart->user_id=$res['user_id'];
                $cart->buy_number=1;
                $rea=$cart->save();
            }
            if($rea){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            return redirect('login/login');
        }
    }
}
