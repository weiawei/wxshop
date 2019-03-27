<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Cart;
use App\Http\Model\Area;
use App\Http\Model\User;
use App\Http\Model\Address;
class userController extends Controller
{
    //潮购记录
    public function buyrecord()
    {
        $cart=new Cart;
        $res=$cart
            ->join('goods','cart.goods_id','=','goods.goods_id')
            ->orderby('buy_number','desc')
            ->limit(4)
            ->get();
        return view('buyrecord',['res'=>$res]);
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
        $user_name=session('userInfo');
        $user=new User;
        $res=$user->where(['user_tel'=>$user_name])->first();
        $user_id=$res['user_id'];//得到用户id
        $where=[
            'user_id'=>$user_id,
            'address_status'=>1
        ];//查当前用户id且在展示的
        $address_model=new Address;
        $area_model=new Area;
        $addressInfo=$address_model->where($where)->orderby('is_default','asc')->get();//当前用户的所有收货地址
        if(!empty($addressInfo)){
            //处理省市区
            foreach($addressInfo as $k=>$v){
                $addressInfo[$k]['province']=$area_model->where(['id'=>$v['province']])->value('name');
                $addressInfo[$k]['city']=$area_model->where(['id'=>$v['city']])->value('name');
                $addressInfo[$k]['area']=$area_model->where(['id'=>$v['area']])->value('name');
            }
            return view('address',['rea'=>$addressInfo]);
        }
    }
    //收货地址添加
    public function writeaddr(){
        $area=new Area;
        $province=$this->getAreaInfo(0);
        return view('writeaddr',['province'=>$province]);
    }
    //收货地址添加执行
    public function addressDo(Request $request)
    {
        $data=$request->all();
        unset($data['_token']);
        $user_name=session('userInfo');
        $user=new User;
        $rea=$user->where(['user_tel'=>$user_name])->first();
        $user_id=$rea['user_id'];
        $data['user_id']=$user_id;
        $address=new Address;
        $address->user_id=$data['user_id'];
        $address->address_name=$data['address_name'];
        $address->address_tel=$data['address_tel'];
        $address->address_detail=$data['address_detail'];
        $address->province=$data['province'];
        $address->city=$data['city'];
        $address->area=$data['area'];
        $address->is_default=$data['is_default'];
        $address->user_id=$data['user_id'];
        $address->address_mail=100000;
        $where=[
            'user_id'=>$user_id
        ];

       if($data['is_default']==1){
            $res1 = $address->where($where)->update(['is_default'=>2]);
            $res2 = $address->save();
            if($res1!=false&&$res2){
                echo $res=1;
            }else{
                echo $res=2;
            }
       }else{
            $res=$address->save();
            if($res){
                echo 1;
            }else{
                echo 2;
            }
       }
    }
    //收货地址删除
    public function addressdel(Request $request)
    {
        $address_id=$request->address_id;
        $address=new Address;
        $where=[
            'address_id'=>$address_id,
            'address_status'=>1
        ];
        $res=$address->where($where)->update(['address_status'=>2]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    //点击默认
    public function addressmoren(Request $request){
        $user_name=session('userInfo');
        $user=new User;
        $rea=$user->where(['user_tel'=>$user_name])->first();
        $user_id=$rea['user_id'];
        $address_id=$request->address_id;
        $address=new Address;
        $where=[
            'address_id'=>$address_id,
        ];
        $wherea=[
            'user_id'=>$user_id,
        ];
        $res1=$address->where($wherea)->update(['is_default'=>2]);
        $res2=$address->where($where)->update(['is_default'=>1]);
        if($res1&&$res2){
            echo $res=1;
        }else{
            echo $res=2;
        }
    }
    //点击修改
    public function addressEdit(Request $request)
    {
        echo 1;
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


    /**获取三级联动数据 */
    public function getAreaInfo($pid){
        $where=[
            'pid'=>$pid
        ];
        $area=new Area;
        $data=$area->where($where)->get();
        if(!empty($data)){
            return $data;
        }else{
            return false;
        }
    }
    /** 获取下一级区域信息*/
    public function getArea(Request $request){
        $id=$request->id;
         //dump($id);die;
        if(empty($id)){
            fail('必须选择一项');
        }
        $areaInfo=$this->getAreaInfo($id);
        echo json_encode(['areaInfo'=>$areaInfo,'code'=>1]);
    }
}
