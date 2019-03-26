@extends('master')
@section('title', '宋小可爱的商城')

@section('content')
    <div class="sharecon">
        <div class="shareimg clearfix">
            <img src="images/goods1.jpg" alt="">
            <span>(第<i>345</i>潮购)小米/mi红米手机Note4X全网通</span>
        </div>
        <div class="sharecontent">
            <input type="text" placeholder="请输入标题，不少于5个字哦！">
            <textarea name="" id="" cols="30" rows="10" placeholder="来吧，表达一下您激动的心情，不少于20字哦！"></textarea>
        </div>
        <div class="z_photo upimg-div clear">
            <section class="z_file fl">
                <img src="images/upload.png" class="add-img">
                <input type="file" name="file" id="file" class="file" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" multiple="">
            </section>
        </div>
    </div>
@endsection