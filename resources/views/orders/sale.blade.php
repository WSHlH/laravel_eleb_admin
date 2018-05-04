@extends('layout.default')
@section('title','查询统计')
@section('content')
    <table class="table table-bordered">
        <tr>
            <td>店铺</td>
            <td>菜品</td>
            <td>菜品数量</td>
        </tr>
        @foreach($count as $key=>$row)
            <tr>
                <td rowspan="{{count($row)+1}}">{{$shop_ids[$key]->shop_name}}</td>
            </tr>
        @foreach($row as $item)
            <tr>
                <td>{{$item->goods_id}}</td>
                <td>{{$item->d}}</td>
            </tr>
        @endforeach
        @endforeach
    </table>
@stop
