@extends('layout.default')
@section('title','用户详情')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">用户详情</p>
    <dl class="dl-horizontal col-xs-7 " id="order">
            <dt>用户名</dt>
            <dd>{{$customer->username}}</dd>
            <dt>联系方式</dt>
            <dd>{{$customer->tel}}"</dd>
            <dt>会员状态</dt>
            <dd>{{$customer->status==0?'正常':'禁用'}}</dd>
    </dl>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/6.jpg" alt="" width="40%">
@stop
