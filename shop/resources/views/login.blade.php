@extends('master')
@section('title', '宋小可爱的商城')

@section('content')

    <div class="wrapper">
        <div class="registerCon">
            <div class="binSuccess5">
                <ul>
                    <li class="accAndPwd">
                        <dl>
                            <div class="txtAccount">
                                <input id="txtAccount" type="text" placeholder="请输入您的手机号码/邮箱" name="user"><i></i>
                            </div>
                            <cite class="passport_set" style="display: none"></cite>
                        </dl>
                        <dl>
                            <input id="txtPassword" type="password" placeholder="密码" value="" maxlength="20" name="user_pwd"/><b></b>
                        </dl>
                        <dl>
                            <input id="txtcode" type="text" placeholder="请输入验证码" value="" maxlength="4" style="width: 250px;height: 50px;" name="code"/><b></b>
                            <img src="{{url('verify/create')}}" alt="" id="img">
                        </dl>
                    </li>
                </ul>
                @csrf
                <a id="btnLogin" href="javascript:;" class="orangeBtn loginBtn">登录</a>
            </div>
            <div class="forget">
                <a href="https://m.1yyg.com/v44/passport/FindPassword.do">忘记密码？</a>
                <b></b>
                <a href="{{url('login/register')}}">新用户注册</a>
            </div>
        </div>
        <div class="oter_operation gray9" style="display: none;">

            <p>登录666潮人购账号后，可在微信进行以下操作：</p>
            1、查看您的潮购记录、获得商品信息、余额等<br />
            2、随时掌握最新晒单、最新揭晓动态信息
        </div>
    </div>

@endsection
@section('my-js')
    <script type="text/javascript">
        $(function () {
            {{--隐藏底部--}}
            $('.footer').attr('style','display:none');
            {{--点击图片改变图片--}}
            $('#img').click(function () {
                $(this).attr('src',"{{url('/verify/create')}}"+"?"+Math.random())
            });
            $('#btnLogin').click(function () {
                var user=$("[name='user']").val();
                var user_pwd=$("[name='user_pwd']").val();
                var code=$("[name='code']").val();
                var _token=$(this).prev().val();
                $.post(
                    "{{url('login/logindo')}}",
                    {user:user,user_pwd:user_pwd,code:code,_token:_token},
                    function (res) {
                        if(res==1){
                            layer.msg('登陆成功',{icon:1});
                            location.href="{{url('/')}}";
                        }else{
                            layer.msg('登陆失败',{icon:2});
                        }
                    }
                );
            });
        })
    </script>
@endsection


