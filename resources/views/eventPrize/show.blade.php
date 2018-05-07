@extends('layout.default')
@section('title','奖品详情')
@section('content')
    <div><p style="color:#9d9da2;font-size: 24px" class="glyphicon glyphicon-time">奖品详情</p></div>
    <br>
    <img src="/img/<?=mt_rand(1,12)?>.jpg" width="40%" class="col-xs-5">

    <span class="col-xs-6">
        <h3 style="color: #3597ef">{{$eventPrize->name}}</h3>

        <span style="font-size: 21px;">{!! $eventPrize->description !!}</span>
    </span>
@stop
