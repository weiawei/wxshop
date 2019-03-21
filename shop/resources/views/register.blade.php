@extends('master')
@section('title', '宋小可爱的商城')
@if($errors->any())
    <div>
        @foreach($errors->all() as $v)
            <p>{{$v}}</p>
        @endforeach
    </div>
@endif
@section('content')

    <div class="wrapper">
        <input name="hidForward" type="hidden" id="hidForward" />
        <div class="registerCon">
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <s class="phone"></s><input id="userMobile" maxlength="11" type="number" placeholder="请输入您的手机号码" value="" name="user_tel"/>
                        <span class="clear">x</span>
                    </dl>
                    <dl>
                        <s class="phone"></s><input id="userCode" maxlength="4" type="" placeholder="请输入验证码" style="width: 180px;height: 40px;" name="user_code"/>
                        <input type="submit" class="weui-btn weui-btn_disabled weui-btn_primary" value="点击获取验证码" style="width: 170px;height: 40px;background-color: grey;color: wheat" id="duan">
                        @csrf
                    </dl>

                    <br>
                    <dl>
                        <s class="password"></s>
                        <input class="pwd" maxlength="11" type="text" placeholder="6-16位数字、字母组成" value="" name="user_pwd"/>
                        <input class="pwd" maxlength="11" type="password" placeholder="6-16位数字、字母组成" value="" style="display: none" />
                        <span class="mr clear">x</span>
                        <s class="eyeclose"></s>
                    </dl>
                    <dl>
                        <s class="password"></s>
                        <input class="conpwd" maxlength="11" type="text" placeholder="请确认密码" value="" name="user_conpwd"/>
                        <input class="conpwd" maxlength="11" type="password" placeholder="请确认密码" value="" style="display: none" />
                        <span class="mr clear">x</span>
                        <s class="eyeclose"></s>
                    </dl>
                    <dl class="a-set">
                        <i class="gou"></i><p>我已阅读并同意《666潮人购购物协议》</p>
                    </dl>

                </li>
                <li><a id="btnNext" href="javascript:;" class="orangeBtn loginBtn">下一步</a></li>
            </ul>
        </div>

        <div class="layui-layer-move"></div>
@endsection


@section('my-js')
    <script>
        $('.registerCon input').bind('keydown',function(){
            var that = $(this);
            if(that.val().trim()!=""){

                that.siblings('span.clear').show();
                that.siblings('span.clear').click(function(){
                    // console.log($(this));

                    that.parents('dl').find('input:visible').val("");
                    $(this).hide();
                })

            }else{
                that.siblings('span.clear').hide();
            }

        })
        function show(){
            if($('.registerCon input').attr('type')=='password'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        function hide(){
            if($('.registerCon input').attr('type')=='text'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        $('.registerCon s').bind({click:function(){
                if($(this).hasClass('eye')){
                    $(this).removeClass('eye').addClass('eyeclose');

                    $(this).prev().prev().prev().val($(this).prev().prev().val());
                    $(this).prev().prev().prev().show();
                    $(this).prev().prev().hide();


                }else{
                    // console.log($(this  ));
                    $(this).removeClass('eyeclose').addClass('eye');
                    $(this).prev().prev().val($(this).prev().prev().prev().val());
                    $(this).prev().prev().show();
                    $(this).prev().prev().prev().hide();

                }
            }
        })

        function registertel(){
            // 手机号失去焦点
            $('#userMobile').blur(function(){
                reg=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/;//验证手机正则(输入前7位至11位)
                var that = $(this);

                if( that.val()==""|| that.val()=="请输入您的手机号")
                {
                    layer.msg('请输入您的手机号！');
                }
                else if(that.val().length<11)
                {
                    layer.msg('您输入的手机号长度有误！');
                }
                else if(!reg.test($("#userMobile").val()))
                {
                    layer.msg('您输入的手机号不存在!');
                }
                else if(that.val().length == 11){
                    // ajax请求后台数据
                }
            })
            // 密码失去焦点
            $('.pwd').blur(function(){
                reg=/^[0-9a-zA-Z]{6,16}$/;
                var that = $(this);
                if( that.val()==""|| that.val()=="6-16位数字或字母组成")
                {
                    layer.msg('请设置您的密码！');
                }else if(!reg.test($(".pwd").val())){
                    layer.msg('请输入6-16位数字或字母组成的密码!');
                }
            })

            // 重复输入密码失去焦点时
            $('.conpwd').blur(function(){
                var that = $(this);
                var pwd1 = $('.pwd').val();
                var pwd2 = that.val();
                if(pwd1!=pwd2){
                    layer.msg('您俩次输入的密码不一致哦！');
                }
            })

        }
        registertel();
        // 购物协议
        $('dl.a-set i').click(function(){
            var that= $(this);
            if(that.hasClass('gou')){
                that.removeClass('gou').addClass('none');
                $('#btnNext').css('background','#ddd');

            }else{
                that.removeClass('none').addClass('gou');
                $('#btnNext').css('background','#f22f2f');
            }

        })
        // 下一步提交
        $('#btnNext').click(function(){
            if($('#userMobile').val()==''){
                layer.msg('请输入您的手机号！');
            }else if($('.pwd').val()==''){
                layer.msg('请输入您的密码!');
            }else if($('.conpwd').val()==''){
                layer.msg('请您再次输入密码！');
            }
        })


    </script>
    <script type="text/javascript">
                $('.footer').attr('style','display:none');
            </script>
    <script>
        $(function(){
            var telFlag=false;
            var sec=60;
            //短信验证
            $('#duan').click(function () {
                var mobile=$(this).parent('dl').prev('dl').find('input').val();
                var _token=$(this).next().val();
                reg=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/;//验证手机正则(输入前7位至11位)
                if(mobile==''){
                    layer.msg('手机号不能为空');
                }else if(mobile.length<11){
                    layer.msg('您输入的手机号长度有误！');
                }else if(!reg.test($("#userMobile").val())){
                    layer.msg('您输入的手机号不存在!');
                }else if(mobile.length == 11){
                    $.ajax({
                    method: "POST",
                    url: "{{url('login/checktel')}}",
                    async:false,
                    data: {mobile:mobile,_token:_token}
                    }).done(function(res) {
                        if(res=='no'){
                            layer.msg('此手机已被注册',{icon:2});
                            telFlag=false;
                        }else{
                            //倒计时
                            $('#duan').val(sec+'s');//把获取变成60s
                            _time=setInterval(go,1000);//每一秒，改变一次  这里的1000是毫秒
                            // ajax请求后台数据
                           $.post(
                               "{{url('login/mobile')}}",
                               {mobile:mobile,_token:_token},
                               function (res) {
                                   layer.msg('发送成功',{icon:1});
                               }
                           );
                        }
                    });
                }
            });
            //验证码失焦
            $('#userCode').blur(function () {
                var userCode=$(this).val();
                if(userCode==''){
                    layer.msg('验证码不能为空');
                }else if(userCode.length!=4){
                    layer.msg('请输入正确的验证码');
                }
            });
            //提交信息
            $('#btnNext').click(function () {
                var user_tel=$("[name='user_tel']").val();
                var user_code=$("[name='user_code']").val();
                var user_pwd=$("[name='user_pwd']").val();
                var user_conpwd=$("[name='user_conpwd']").val();
                var _token=$('#duan').next().val();
                $.post(
                    "{{url('login/registerdo')}}",
                    {user_tel:user_tel,user_code:user_code,user_pwd:user_pwd,user_conpwd:user_conpwd,_token:_token},
                    function (res) {
                        if(res==1){
                            layer.msg('注册成功',{icon:1,time:2000});
                            location.href="{{url('login/login')}}";
                        }else{
                            layer.msg('注册失败',{icon:2});
                        }
                    }
                );
            });
            //秒数倒计时
            function go(){
                //获取当前秒数
                var second=parseInt($('#duan').val());
                if(second==0){
                    $('#duan').val('重新获取验证码');
                    clearInterval(_time);
                    $('#duan').css('pointerEvents','auto');
                }else{
                    var s=second-1;
                    $('#duan').val(s+'s');
                    $('#duan').css('pointerEvents','none');
                }
            }

        });
    </script>
@endsection

