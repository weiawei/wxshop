@extends('master')
@section('title', '宋小可爱的商城')

@section('content')
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />

        <div class="g-Cart-list">
            <ul id="cartBody">
                @foreach($res as $v)
                <li goods_id="{{$v->goods_id}}">
                    <s class="xuan current"></s>
                    <a class="fl u-Cart-img" href="{{url('index/shopcontent'.'/'.$v->goods_id)}}">
                        <img src="{{url('uploads/goodsImg'.'/'.$v->goods_img)}}" border="0" alt="">
                    </a>
                    <div class="u-Cart-r" >
                        <a href="{{url('index/shopcontent'.'/'.$v->goods_id)}}" class="gray6">{{$v->goods_name}}</a>

                        <span>价格：￥<b>{{$v->self_price}}</b></span>
                        @csrf
                        <div class="num-opt" goods_num="{{$v->goods_num}}" goods_id="{{$v->goods_id}}">
                            <em class="num-mius dis min"><i></i></em>
                            <input class="text_box" name="buy_number" maxlength="6" type="text" value="{{$v->buy_number}}" codeid="12501977">
                            <em class="num-add add"><i></i></em>
                        </div>
                        <a href="javascript:;" name="delLink" cid="12501977" isover="0" class="z-del"><s class="del"></s></a>
                    </div>
                </li>
                @endforeach
            </ul>
            <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>0</em></p>

                </dt>
                <dd>
                    @csrf
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account">去结算</a>
                </dd>
            </dl>
        </div>
    {{--人气推荐--}}
        <div class="hot-recom">
            <div class="title thin-bor-top gray6">
                <span><b class="z-set"></b>人气推荐</span>
                <em></em>
            </div>
            <div class="goods-wrap thin-bor-top">
                <ul class="goods-list clearfix">
                    @foreach($rea as $v)
                    <li>
                        <a href="{{url('index/shopcontent'.'/'.$v->goods_id)}}" class="g-pic">
                            <img src="{{url('uploads/goodsImg'.'/'.$v->goods_img)}}" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="{{url('index/shopcontent'.'/'.$v->goods_id)}}">
                                {{$v->goods_name}}</a>
                        </p>
                        <ins class="gray9 ">价格:￥{{$v->self_price}}</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>

                            <div class="gRate" data-productid="23458" goods_id="{{$v->goods_id}}">
                                <a href="javascript:;"><s></s></a>
                            </div>
                            @csrf
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
@endsection

@section('my-js')
    <script type="text/javascript">
    //点击加号
    $(document).on('click','.add',function(){
        var _this=$(this);
        var buy_number=parseInt(_this.prev("input").val());
        var goods_num=_this.parents('div').attr('goods_num');

        if(buy_number>=goods_num){
            _this.prev("input").val(goods_num);
        }else{
            buy_number+=1;
            _this.prev("input").val(buy_number);
        }
        getGoodsNum(_this,buy_number);
    });
    //点击减号
    $(document).on('click','.min',function(){
        var _this=$(this);
        var buy_number=parseInt(_this.next("input").val());
        if(buy_number<=1){
            _this.next("input").val(1)
        }else{
            buy_number-=1;
            _this.next("input").val(buy_number);
        }
        getGoodsNum(_this,buy_number);
    });
    //购买数量文本框
    $(document).on('blur','.text_box',function(){
        var _this=$(this);
        var buy_number=parseInt(_this.val());//购买数量
        var goods_num=_this.parents('div').attr('goods_num');//库存
        var reg=/^[1-9]\d*$/;
        if(!reg.test(buy_number)){
            _this.val(1);
        }else if(buy_number>=goods_num){
            _this.val(goods_num);
        }else if(buy_number<=1){
            _this.val(1);
        }else{
            _this.val(buy_number);
        }
        getGoodsNum(_this,buy_number);
    });
    //改变购买数量
    function getGoodsNum(_this,buy_number){
        var goods_id=_this.parent().attr('goods_id');
        var _token=_this.parent().prev().val();
        $.post(
            "{{url('cart/changenum')}}",
            {goods_id:goods_id,buy_number:buy_number,_token:_token},
        );
        GetCount();
    }
    //加入购物车
    $('.gRate').click(function () {
        var login="{{session('userInfo')}}";
        if(login!=''){
            var goods_id=$(this).attr('goods_id');
            var _token=$(this).next().val();
            $.post(
                "{{url('index/addcart')}}",
                {goods_id:goods_id,_token:_token},
                function (res) {
                    if(res==1){
                        layer.msg('添加成功',{icon: 1});
                    }else{
                        layer.msg('添加失败',{icon: 2});
                    }
                }
            );
        }else{
            layer.msg('请先登录',{icon:2,time:2000},function(){
                location.href="{{url('login/login')}}";
            });
        }
    });
    //删除单个商品
    $(document).on('click','.del',function(){
            var _this=$(this);
            var goods_id=_this.parent().prev('div').attr('goods_id');
            var _token=$('.num-opt').prev().val();
            layer.confirm('是否确认删除？',{icon:3,title:'提示'},function(index){
                $.post(
                    "{{url('cart/cartDel')}}",
                    {goods_id:goods_id,_token:_token},
                    function(res){
                        if(res==1){
                            layer.msg('删除成功',{icon:1});
                            _this.parents('li').remove();
                            layer.close(index);
                        }else{
                            layer.msg('删除失败',{icon:2});
                        }
                    }

                );
            });
        });
    //全选
    $(".quanxuan").click(function () {
        if($(this).hasClass('current')){
            $(this).removeClass('current');

            $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current");
                } else {
                    $(this).addClass("current");
                }
            });
            GetCount();
        }else{
            $(this).addClass('current');

            $(".g-Cart-list .xuan").each(function () {
                $(this).addClass("current");
                // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
            });
            GetCount();
        }


    });
    // 单选
    $(".g-Cart-list .xuan").click(function () {
    if($(this).hasClass('current')){
            $(this).removeClass('current');
    }else{
            $(this).addClass('current');
    }
    if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
        $('.quanxuan').addClass('current');
    }else{
        $('.quanxuan').removeClass('current');
    }
    // $("#total2").html() = GetCount($(this));
    GetCount();
    //alert(conts);
    });
    // 已选中的总额
    function GetCount() {
    var conts = 0;
    var aa = 0;
    $(".g-Cart-list .xuan").each(function () {
        if ($(this).hasClass("current")) {
            for (var i = 0; i < $(this).length; i++) {
                var buy_number=parseInt($(this).parents('li').find('input.text_box').val());
                //console.log(buy_number);
                var self_price=parseInt($(this).parents('li').find('input.text_box').parent('div').siblings('span').find('b').text());
                conts +=buy_number*self_price;
            }
        }
    });

    $(".total").html('<span>￥</span>'+(conts).toFixed(2));
    }
    GetCount();
    //点击确认结算
    $(document).on('click','#a_payment',function () {
        var user="{{session('userInfo')}}";
        if(user!=''){
            var goods_id='';
            var _this=$(this);
            var _token=$(this).prev().val();
            $('.xuan').each(function (index) {
               if($(this).prop('class')=="xuan current"){
                    goods_id += $(this).parent().attr('goods_id')+',';
               }
            });
           $.post(
               "{{url('cart/paymentdo')}}",
               {goods_id:goods_id,_token:_token},
               function (res) {
                    if(res==1){
                        location.href="{{url('cart/payment')}}";
                    }else{
                        layer.msg('确认订单成功',{icon:2});
                    }
               }
           );
        }else{
            layer.msg('请先登录',{icon:2,time:2000},function(){
                location.href="{{url('login/login')}}";
            });
        }
    });
    </script>
@endsection

