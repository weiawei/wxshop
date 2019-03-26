@extends('master')
@section('title', '宋小可爱的商城')
@section('content')
    <div class="page-group">
        <div id="page-infinite-scroll-bottom" class="page">
                {{--搜索--}}
                <div class="pro-s-box thin-bor-bottom" id="divSearch">
                <div class="box">
                    <div class="border">
                        <div class="border-inner"></div>
                    </div>
                    @csrf
                    <div class="input-box">
                        <i class="s-icon"></i>
                        <input type="text" placeholder="输入“汽车”试试" id="txtSearch"/>
                        <i class="c-icon" id="btnClearInput" style="display: none"></i>
                    </div>
                </div>
                <a href="javascript:;" class="s-btn" id="btnSearch">搜索</a>
            </div>

                <!--搜索时显示的模块-->
                <div class="search-info" style="display: none;">
                <div class="hot">
                    <p class="title">热门搜索</p>
                    <ul id="ulSearchHot" class="hot-list clearfix"><li wd='iPhone'><a class="items">iPhone</a></li><li wd='三星'><a class="items">三星</a></li><li wd='小米'><a class="items">小米</a></li><li wd='黄金'><a class="items">黄金</a></li><li wd='汽车'><a class="items">汽车</a></li><li wd='电脑'><a class="items">电脑</a></li></ul>
                </div>
                <div class="history" style="display: none">
                    <p class="title">历史记录</p>
                    <div class="his-inner" id="divSearchHotHistory">
                        <ul class="his-list thin-bor-top">
                            <li wd="小米移动电源" class="thin-bor-bottom"><a class="items">小米移动电源</a></li>
                            <li wd="苹果6" class="thin-bor-bottom"><a class="items">苹果6</a></li>
                            <li wd="苹果电脑" class="thin-bor-bottom"><a class="items">苹果电脑</a></li>
                        </ul>
                        <div class="cle-cord thin-bor-bottom" id="btnClear">清空历史记录</div>
                    </div>
                </div>
            </div>

            <div class="all-list-wrapper">

                <div class="menu-list-wrapper" id="divSortList">
                {{--分类--}}
                @csrf
                <ul id="sortListUl" class="list">
                    @if($id==0)
                        <li cate_id=0 class='current'>
                            <span class='items'>全部商品</span>
                        </li>
                        @foreach($rea as $v)
                            <li cate_id='{{$v->cate_id}}'>
                                <span class='items'>{{$v->cate_name}}</span>
                            </li>
                        @endforeach
                    @elseif($id!=0)
                        <li cate_id=0 >
                            <span class='items'>全部商品</span>
                        </li>
                        @foreach($rea as $v)
                            @if($id==$v->cate_id)
                                <li cate_id="{{$v->cate_id}}" class='current'>
                                    <span class='items'>{{$v->cate_name}}</span>
                                </li>
                            @elseif($id!=$v->cate_id)
                                <li cate_id='{{$v->cate_id}}'>
                                    <span class='items'>{{$v->cate_name}}</span>
                                </li>
                            @endif
                         @endforeach
                    @endif
                </ul>
            </div>


                <div class="good-list-wrapper">
                    {{--人气--}}
                    <div class="good-menu thin-bor-bottom">
                        @csrf
                        <ul class="good-menu-list" id="ulOrderBy">
                            <li orderflag="20"><a href="javascript:;" id="host">人气</a></li>
                            <li orderflag="50"><a href="javascript:;" id="new">最新</a></li>
                            <li orderflag="30"><a href="javascript:;">价格</a>
                                <span class="i-wrap">
                                    <i class="up" id="asc" style="cursor: pointer"></i>
                                    <i class="down" id="desc" style="cursor: pointer"></i>
                                </span>
                            </li>
                            <!--价值(由高到低30,由低到高31)-->
                        </ul>
                    </div>
                    {{--商品--}}
                    <div class="good-list-inner">
                        <div  class="good-list-box  mui-content mui-scroll-wrapper">
                            <div class="goodList mui-scroll">
                                <ul id="ulGoodsList" class="mui-table-view mui-table-view-chevron">
                                    @foreach($res as $v)
                                        <li id="23468">
                                    <span class="gList_l fl">
                                        <a href="{{url('index/shopcontent').'/'.$v->goods_id}}" class="g-pic">
                                            <img class="lazy" data-original="{{url('uploads/goodsImg/'.$v->goods_img)}}" >
                                        </a>
                                    </span>
                                        <div class="gList_r">
                                            <h3 class="gray6">{{$v->goods_name}}</h3>
                                            <em class="gray9">价值：￥{{$v->self_price}}</em>
                                            <div class="gRate">
                                                <div class="Progress-bar">
                                                    <p class="u-progress">
                                                    <span style="width: 91.91286930395593%;" class="pgbar">
                                                        <span class="pging"></span>
                                                    </span>
                                                    </p>
                                                    <ul class="Pro-bar-li">
                                                        <li class="P-bar01"><em>7342</em>已参与</li>
                                                        <li class="P-bar02"><em>7988</em>总需人次</li>
                                                        <li class="P-bar03"><em>646</em>剩余</li>
                                                    </ul>
                                                </div>
                                                @csrf
                                                <a codeid="12785750" class="gouwu" canbuy="646" goods_id="{{$v->goods_id}}"><s></s></a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{url('js/lazyload.min.js')}}"></script>
<script src="{{url('js/mui.min.js')}}"></script>
<script>
jQuery(document).ready(function() {
    $("img.lazy").lazyload({
        placeholder : "{{url('images/loading2.gif')}}",
        effect: "fadeIn",
    });
});
// 点击切换类别
$('#sortListUl li').click(function(){
    $(this).addClass('current').siblings('li').removeClass('current');
})
mui.init({
    pullRefresh: {
        container: '#pullrefresh',
        down: {
            contentdown : "下拉可以刷新",//可选，在下拉可刷新状态时，下拉刷新控件上显示的标题内容
            contentover : "释放立即刷新",//可选，在释放可刷新状态时，下拉刷新控件上显示的标题内容
            contentrefresh : "正在刷新...",
            callback: pulldownRefresh
        },
        up: {
            contentrefresh: '正在加载...',
            callback: pullupRefresh
        }
    }
});
/**
 * 下拉刷新具体业务实现
 */
function pulldownRefresh() {
    setTimeout(function() {
        var table = document.body.querySelector('.mui-table-view');
        var cells = document.body.querySelectorAll('.mui-table-view-cell');
        for (var i = cells.length, len = i + 3; i < len; i++) {
            var li = document.createElement('li');
            var str='';
            // li.className = 'mui-table-view-cell';
            str += '<span class="gList_l fl">';
            str += '<img class="lazy" data-original="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" src="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" style="display: block;"/>';
            str += '</span>';
            str += '<div class="gList_r">';
            str += '<h3 class="gray6">(第'+i+'云)苹果（Apple）iPhone 7 Plus 256G版 4G手机</h3>';
            str += '<em class="gray9">价值：￥7988.00</em>';
            str += '<div class="gRate">';
            str += '<div class="Progress-bar">'
            str += '<p class="u-progress">';
            str += '<span style="width: 91.91286930395593%;" class="pgbar">';
            str += '<span class="pging"></span>';
            str += '</span>';
            str += '</p>';
            str += '<ul class="Pro-bar-li">';
            str += '<li class="P-bar01"><em>7342</em>已参与</li>';
            str += '<li class="P-bar02"><em>7988</em>总需人次</li>';
            str += '<li class="P-bar03"><em>646</em>剩余</li>';
            str += '</ul>';
            str += '</div>';
            str += '<a codeid="12785750" class="" canbuy="646"><s></s></a>';
            str += '</div>';
            str += '</div>';
            //下拉刷新，新纪录插到最前面；
            li.innerHTML = str;
            table.insertBefore(li, table.firstChild);
        }
        mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
    }, 1500);
}
var count = 0;
/**
 * 上拉加载具体业务实现
 */
function pullupRefresh() {
    setTimeout(function() {
        mui('#pullrefresh').pullRefresh().endPullupToRefresh((++count > 2)); //参数为true代表没有更多数据了。
        var table = document.body.querySelector('.mui-table-view');
        var cells = document.body.querySelectorAll('.mui-table-view-cell');
        for (var i = cells.length, len = i + 20; i < len; i++) {
            var li = document.createElement('li');
            // li.className = 'mui-table-view-cell';
            var str='';
            str += '<span class="gList_l fl">';
            str += '<img class="lazy" data-original="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" src="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" style="display: block;"/>';
            str += '</span>';
            str += '<div class="gList_r">';
            str += '<h3 class="gray6">(第'+i+'云)苹果（Apple）iPhone 7 Plus 256G版 4G手机</h3>';
            str += '<em class="gray9">价值：￥7988.00</em>';
            str += '<div class="gRate">';
            str += '<div class="Progress-bar">'
            str += '<p class="u-progress">';
            str += '<span style="width: 91.91286930395593%;" class="pgbar">';
            str += '<span class="pging"></span>';
            str += '</span>';
            str += '</p>';
            str += '<ul class="Pro-bar-li">';
            str += '<li class="P-bar01"><em>7342</em>已参与</li>';
            str += '<li class="P-bar02"><em>7988</em>总需人次</li>';
            str += '<li class="P-bar03"><em>646</em>剩余</li>';
            str += '</ul>';
            str += '</div>';
            str += '<a codeid="12785750" class="" canbuy="646"><s></s></a>';
            str += '</div>';
            str += '</div>';
            li.innerHTML = str;
            table.appendChild(li);
        }
    }, 1500);
}
// if (mui.os.plus) {
//     mui.plusReady(function() {
//         setTimeout(function() {
//             mui('#pullrefresh').pullRefresh().pullupLoading();
//         }, 1000);

//     });
// }
// else {
//     mui.ready(function() {
//         mui('#pullrefresh').pullRefresh().pullupLoading();
//     });
// }


</script>
<script type="text/javascript">
    $('#div-header').attr('style','display:none');
</script>
<script>
    $(function(){
        //不同分类下的数据
        $('.items').click(function () {
            //alert(11);
            var _this=$(this);
            var cate_id=_this.parent('li').attr('cate_id');
            var _token=_this.parents('ul').prev().val();
            $(this).parent('li').siblings('li').attr('class','');
            $(this).parent('li').attr('class','current');
            $.post(
                "{{url('index/cateshop')}}",
                {cate_id:cate_id,_token:_token },
                function (res) {
                    $('.good-list-inner').html(res);
                    $("img.lazy").lazyload({
                        placeholder : "{{url('images/loading2.gif')}}",
                        effect: "fadeIn",
                    });
                }
            );
        });
        //最火
        $('#host').click(function () {
            var _this=$(this);
            var _token=_this.parents('ul').prev().val();
            $.post(
                "{{url('index/host')}}",
                {_token:_token },
                function (res) {
                    $('.good-list-inner').html(res);
                    $("img.lazy").lazyload({
                        placeholder : "{{url('images/loading2.gif')}}",
                        effect: "fadeIn",
                    });
                }
            );
        });
        //最新
        $('#new').click(function () {
            var _this=$(this);
            var _token=_this.parents('ul').prev().val();
            $.post(
                "{{url('index/new')}}",
                {_token:_token },
                function (res) {
                    $('.good-list-inner').html(res);
                    $("img.lazy").lazyload({
                        placeholder : "{{url('images/loading2.gif')}}",
                        effect: "fadeIn",
                    });
                }
            );
        });
        //价格升
        $('#asc').click(function () {
            var _this=$(this);
            var _token=_this.parents('ul').prev().val();
            $.post(
                "{{url('index/asc')}}",
                {_token:_token },
                function (res) {
                    $('.good-list-inner').html(res);
                    $("img.lazy").lazyload({
                        placeholder : "{{url('images/loading2.gif')}}",
                        effect: "fadeIn",
                    });
                }
            );
        });
        //价格降
        $('#desc').click(function () {
            var _this=$(this);
            var _token=_this.parents('ul').prev().val();
            $.post(
                "{{url('index/desc')}}",
                {_token:_token },
                function (res) {
                    $('.good-list-inner').html(res);
                    $("img.lazy").lazyload({
                        placeholder : "{{url('images/loading2.gif')}}",
                        effect: "fadeIn",
                    });
                }
            );
        });
        //搜索
        $('#txtSearch').blur(function () {
            var search=$(this).val();
            var _token=$(this).parent().prev().val();
            $.post(
                "{{url('index/search')}}",
                {search:search,_token:_token},
                function (res) {
                    $('.good-list-inner').html(res);
                    $("img.lazy").lazyload({
                        placeholder : "{{url('images/loading2.gif')}}",
                        effect: "fadeIn",
                    });
                }
            );
        });
        //加入购物车
        $(document).on('click','.gouwu',function () {
            var login="{{session('userInfo')}}";
            if(login!=''){
                var goods_id=$(this).attr('goods_id');
                var _token=$(this).prev().val();
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
    })
</script>
</html>

