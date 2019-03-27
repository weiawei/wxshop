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
    <link rel="stylesheet" href="{{url('css/writeaddr.css')}}">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('dist/css/LArea.css')}}">
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="javascript:;" class="m-index-icon" id="add">保存</a>
</div>
<div class=""></div>

<form class="" action="">
    <div class="addrcon">
        <ul>
            @csrf
            <li><em>收货人</em><input type="text" id="address_name" placeholder="请填写真实姓名"></li>
            <li><em>手机号码</em><input type="number" id="address_tel" placeholder="请输入手机号"></li>
            <li>
                <em>所在区域</em>
                <select class="area" id="province" name="province" >
                    <option value="0" selected="selected">&nbsp;&nbsp;---请选择---</option>
                    @foreach($province as $v)
                        <option value="{{$v->id}}" >{{$v->name}}</option>
                    @endforeach
                </select>

                <select class="area" id="city" name="city">
                    <option value="0" selected="selected" >---请选择---</option>
                </select>

                <select class="area" id="area" name="area">
                    <option value="0" selected="selected">---请选择---</option>
                </select>
                （必填）
            </li>
            @csrf
            <li class="addr-detail"><em>详细地址</em><input type="text" placeholder="20个字以内" id="address_detail" class="addr"></li>
        </ul>

    </div>
</form>
<form class="layui-form" action="">

    <div class="setnormal">
        <span >设为默认地址</span>
        <input type="checkbox"  id="status" lay-skin="switch">
    </div>

</form>

<!-- SUI mobile -->
<script src="{{url('dist/js/LArea.js')}}"></script>
<script src="{{url('dist/js/LAreaData1.js')}}"></script>
<script src="{{url('dist/js/LAreaData2.js')}}"></script>
<script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{url('layui/layui.js')}}"></script>

<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form();

        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });
    });

    // var areaa = new LArea();
    // areaa.init({
    //     'trigger': '#demo1',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置
    //     'valueTo':'#value1',//选择完毕后id属性输出到该位置
    //     'keys':{id:'id',name:'name'},//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
    //     'type':1,//数据源类型
    //     'data':LAreaData//数据源
    // });


</script>
<script>
    $(function () {
        //事件改变
        $(document).on('change','.area',function(){
            var _this=$(this);
            var id=_this.val();
            var _token=_this.parent().next().val();
            var _option="<option selected value='0'>&nbsp;&nbsp;--请选择-- </option>";
            $.post(
                "{{url('user/getArea')}}",
                {id:id,_token:_token},
                function(res){
                    if(res.code==1){
                        _this.nextAll('select').html(_option);
                        for(var i in res['areaInfo']){
                            _option+="<option value=' "+res['areaInfo'][i]['id']+"'>"+res['areaInfo'][i]['name']+"</option>";
                        }
                        _this.next('select').html(_option);
                    }else{
                        layer.msg(res.font,{icon:res.code});
                    }
                },
                'json'
            );
        });
        //点击保存
        $(document).on('click','#add',function(){
            var status=$('#status').prop('checked');
            var obj={};
            obj.province=$('#province').val();
            obj.city=$('#city').val();
            obj.area=$('#area').val();
            obj.address_name=$('#address_name').val();
            obj.address_tel=$('#address_tel').val();
            obj.address_detail=$('#address_detail').val();
            obj.status=status;
            obj._token=$('#address_name').parent().prev().val();
            if(obj.status==true){
                obj.is_default=1;
            }else{
                obj.is_default=2;
            }

            //验证
            //验证收件人姓名
            if(obj.address_name==''){
                layer.msg('请填写收件人姓名',{icon:2});
                return false;
            }

            //验证收件人联系方式
            if(obj.address_tel==''){
                layer.msg('手机号不能为空',{icon:2});
                return false;
            }else{
                var reg=/^1[3,5,7,8]\d{9}$/;
                if(!reg.test(obj.address_tel)){
                    layer.msg('请填写正确的手机号格式',{icon:2});
                    return false;
                }
            }
            //验证省
            if(obj.province==0){
                layer.msg('请选择完善的配送地区',{icon:2});
                return false;
            }
            //验证市
            if(obj.city==0){
                layer.msg('请选择完善的配送地区',{icon:2});
                return false;
            }
            //验证县
            if(obj.area==0){
                layer.msg('请选择完善的配送地区',{icon:2});
                return false;
            }

            //验证详细地址
            if(obj.address_detail==''){
                layer.msg('请写清详细地址',{icon:2});
                return false;
            }

            //添加
            $.post(
                "{{url('user/addressDo')}}",
                obj,
                function(res){
                    if(res==1){
                        layer.msg('添加成功',{icon:1});
                        location.href="{{url('user/address')}}";
                    }else{
                        layer.msg('添加失败',{icon:2});
                    }
                },
                'json'
            );
        });
    });
</script>

</body>
</html>
