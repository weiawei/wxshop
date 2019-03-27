@extends('master')
@section('title', '宋小可爱的商城')

@section('content')
    <div class="welcome" style="display: none">
        <p>Hi，等你好久了！</p>
        <a href="{{url('login/login')}}" class="orange">登录</a>
        <a href="{{url('login/register')}}" class="orange">注册</a>
    </div>
    <div class="welcome">
        <i class="set"></i>
        <div class="login-img clearfix">
            <ul>
                <li><img src="http://i0.hdslb.com/bfs/archive/ffe9735cdb517513b7de05d95767eef31abe3da9.jpg" alt=""></li>
                <li class="name">
                    <h3>{{$user_tel}}</h3>
                    <p>ID：{{substr($create_time,'3')}}{{$user_id}}</p>
                </li>
                <li class="next fr"><s></s></li>
            </ul>
        </div>

    </div>
    <!--获得的商品-->
    <!--导航菜单-->
    <div class="sub_nav marginB person-page-menu">
        <a href="{{url('user/buyrecord')}}"><s class="m_s1"></s>潮购记录<i></i></a>
        {{--<a href="/v44/member/orderlist.do"><s class="m_s2"></s>获得的商品<i></i></a>--}}
        <a href="{{url('user/willshare')}}"><s class="m_s3"></s>我的晒单<i></i></a>
        <a href="{{url('user/mywallet')}}"><s class="m_s4"></s>我的钱包<i></i></a>
        <a href="{{url('user/address')}}"><s class="m_s5"></s>收货地址<i></i></a>

        <a href="{{url('user/safeset')}}" class="mt10"><s class="m_s6"></s>安全设置<i></i></a>
        <a href="{{url('user/invite')}}"><s class="m_s7"></s>二维码分享<i></i></a>
        <p class="colorbbb">客服热线：400-666-2110  (工作时间9:00-17:00)</p>
    </div>
@endsection

@section('my-js')
    <script>
        function goClick(obj, href) {
            $(obj).empty();
            location.href = href;
        }
        if (navigator.userAgent.toLowerCase().match(/MicroMessenger/i) != "micromessenger") {
            $(".m-block-header").show();
        }
    </script>
    <script type="text/javascript">
        $('#div-header').attr('style','display:none');
    </script>
@endsection

