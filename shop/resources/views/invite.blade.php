@extends('master')
@section('title', '宋小可爱的商城')

@section('content')
	<div class="invit-box">
		<div class="invit-wrapp">
			<div class="invit-top">
				<s></s>
				<p>邀请好友参与得7%消费返佣！每天分享朋友圈及微博，累计可获得100潮购值</p>
			</div>
			<div class="invit-middle">
				<img src="{{url('images/ewm.png')}}" alt="">
			</div>
			<div class="-mob-share-ui-button -mob-share-open ">分享</div>
			<div class="-mob-share-ui -mob-share-ui-theme -mob-share-ui-theme-slide-bottom" style="display:none">
				<ul class="-mob-share-list">
					<li class="-mob-share-weibo"><p>新浪微博</p></li>
					<li class="-mob-share-qq"><p>QQ好友</p></li>
					<li class="-mob-share-qzone"><p>QQ空间</p></li>

				</ul>
				<div class="-mob-share-close">取消</div>
			</div>
			<div class="-mob-share-ui-bg"></div>
		</div>

	</div>
@endsection

<script id="-mob-share" src="http://f1.webshare.mob.com/code/mob-share.js?appkey=1fdd78296fa81"></script>
@section('my-js')
	<script>
        mobShare.config( {

            appkey: '1fdd78296fa81', // appkey
            params: {
                url: 'http://www.666crg.com/mobile/invitereg?user_id=10050072', // 分享链接
                // title: '中奖了', // 分享标题
                description: '#潮购就来666潮人购#我的天呐！这里的iPhone 7最低只要1块钱，邀请好友一起抢还有现金奖励呢！ ' // 分享内容
            }

        } );
	</script>
@endsection

