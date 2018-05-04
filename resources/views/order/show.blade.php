@extends('layout.default')
@section('title','店铺订单信息')
@section('content')
    <table class="table table-hover table-border table-responsive" id="order_delete">
        <tr>
            <th>id</th>
            <th>订单编号</th>
            <th>付款人</th>
            <th>总付款</th>
            <th>收货人</th>
            <th>联系方式</th>
            <th>收货地址</th>
            <th>操作</th>
        </tr>
        @foreach ($orders as $order)
            <tr data-id="{{$order->id}}">
                <td>{{$order->id}}</td>
                <td>{{$order->order_code}}</td>
                <td>{{$order->customer->username}}</td>
                <td>{{$order->order_price}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->provence.$order->city.$order->area.$order->detail_address}}</td>
                <td>
                    <a href="" class="btn btn-sm btn-warning" >订单详情</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$orders->links()}}
@stop
