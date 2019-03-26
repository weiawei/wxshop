@extends('master')
@section('title', '宋小可爱的商城')

@section('content')
	<div class="wallet-con">
		<ul class="registerCon clearfix">
			<li><img src="images/goods1.jpg" alt=""></li>
			<li>
				<h3>账户余额</h3>
				<p class="red">￥<i>0</i></p>
			</li>
			<li class="next-icon"><s></s></li>
		</ul>
		<div class="w-item">
			<ul class="w-content clearfix">
				<li>
					<a href="">网银充值</a>
					<s class="fr"></s>
				</li>
				<li>
					<a href="">潮购值&nbsp;<i class="red">107</i>&nbsp;100潮购值=1元</a>
					<s class="fr"></s>
				</li>
				<li>
					<a href="">佣金&nbsp;&nbsp;<i class="red">￥0.00</i></a>
					<s class="fr"></s>
				</li>
				<li>
					<a href="">邀请成员</a>
					<s class="fr"></s>
				</li>


			</ul>

		</div>
	</div>
@endsection

