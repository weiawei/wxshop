<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>宋小可爱的商城</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/address.css')}}">
    <link rel="stylesheet" href="{{url('css/sm.css')}}">



</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">地址管理</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="{{url('user/writeaddr')}}" class="m-index-icon">添加</a>
</div>
<div class="addr-wrapp">
    @foreach($rea as $v)
        @if($v['is_default']==1)
            @csrf
            <div class="addr-list" style="background-color: #faff99;" address_id="{{$v->address_id}}">
                <ul>
                    <li class="clearfix">
                        <span class="fl">{{$v->address_name}}</span>
                        <span class="fr">{{$v->address_tel}}</span>
                    </li>
                    <li>
                        <p>{{$v->province}}{{$v->city}}{{$v->area}}{{$v->address_detail}}</p>
                    </li>
                    <li class="a-set" >
                        <div >
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <span class="edit">编辑</span>
                            &nbsp;
                            <span class="remove">删除</span>
                        </div>
                    </li>
                </ul>
            </div>
        @elseif($v['is_default']==2)
            @csrf
            <div class="addr-list" address_id="{{$v->address_id}}">
                <ul>
                    <li class="clearfix">
                        <span class="fl">{{$v->address_name}}</span>
                        <span class="fr">{{$v->address_tel}}</span>
                    </li>
                    <li>
                        <p>{{$v->province}}{{$v->city}}{{$v->area}}{{$v->address_detail}}</p>
                    </li>
                    <li class="a-set">
                        <s class="z-set" style="margin-top: 6px;"></s>
                        <span class="moren">设为默认</span>
                        <div class="fr">
                            <span class="edit">编辑</span>
                            <span class="remove">删除</span>
                        </div>
                    </li>
                </ul>
            </div>
        @endif

    @endforeach
        <br>
</div>


<script src="{{url('js/zepto.js')}}" charset="utf-8"></script>
<script src="{{url('js/sm.js')}}"></script>
<script src="{{url('js/sm-extend.js')}}"></script>
<script src="{{url('js/jquery-3.2.1.min.js')}}"></script>

<!-- 单选 -->
<script>


    // 删除地址
    $(document).on('click','span.remove', function () {
        var address_id=$(this).parents('.addr-list').attr('address_id');
        var _token=$(this).parents('.addr-list').prev().val();
        var buttons1 = [
            {
                text: '删除',
                bold: true,
                color: 'danger',
                onClick: function() {
                    $.post(
                        '{{url('user/addressdel')}}',
                        {address_id:address_id,_token:_token},
                        function (res) {
                            if(res==1){
                                alert('删除成功');
                                history.go();
                            }else{
                                alert('删除失败');
                                history.go(0);
                            }
                        }
                    );
                }
            }
        ];
        var buttons2 = [
            {
                text: '取消',
                bg: 'danger'
            }
        ];
        var groups = [buttons1, buttons2];
        $.actions(groups);
    });
    //点击默认
    $(document).on('click','.moren',function () {
        var address_id=$(this).parents('.addr-list').attr('address_id');
        var _token=$(this).parents('.addr-list').prev().val();
        $.post(
            '{{url('user/addressmoren')}}',
            {address_id:address_id,_token:_token},
            function (res) {
                if(res==1){
                    alert('设置成功');
                    history.go(0);
                }else{
                    alert('设置失败');
                }
            }
        );
    });
    //点击编辑
    $(document).on('click','.edit',function () {
        var address_id=$(this).parents('.addr-list').attr('address_id');
        var _token=$(this).parents('.addr-list').prev().val();
        $.post(
            '{{url('user/addressEdit')}}',
            {address_id:address_id,_token:_token},
            function (res) {
                console.log(res);
            }
        );
    });
</script>

<script>
    var $$=jQuery.noConflict();
    $$(document).ready(function(){
        // jquery相关代码
        $$('.addr-list .a-set s').toggle(
            function(){
                if($$(this).hasClass('z-set')){

                }else{
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }
            },
            function(){
                if($$(this).hasClass('z-defalt')){
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }

            }
        )

    });

</script>



</body>
</html>
