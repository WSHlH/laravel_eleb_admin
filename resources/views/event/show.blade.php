@extends('layout.default')
@section('title','抽奖活动详情')
@section('content')
    <div><p style="color:#9d9da2;font-size: 24px" class="glyphicon glyphicon-time">抽奖活动结束仅剩<span style="font-size: 36px;color: #ef4715;">
                {{ceil(($event->signup_end-time())/(3600*24))}}</span>天</p></div>
    <br>
    <img src="/img/<?=mt_rand(1,12)?>.jpg" width="40%" class="col-xs-5">

    <span class="col-xs-6">
        <h3 style="color: #3597ef">{{$event->title}}</h3>
        <div>开始时间:<span>{{date('Y-m-d',$event->signup_start)}}</span>&emsp;结束时间:<span>{{date('Y-m-d',$event->signup_end)}}</span></div><br>
        <div>开奖日期:{{$event->prize_date}},敬请期待!</div><br>
        <span style="font-size: 21px;">{!! $event->content !!}</span>
    </span>
@if($event->prize_date<=date('Y-m-d') or $event->is_prize==0)
    <a href="{{route('prize',['event'=>$event])}}" class=" btn btn-warning">摇奖</a>
@endif
@stop
