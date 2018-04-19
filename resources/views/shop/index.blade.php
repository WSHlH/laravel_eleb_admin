@extends('layout.default')
@section('title','店铺管理')
@section('content')
    <table class="table table-hover table-border table-responsive" id="shop_delete">
        <tr>
            <th>id</th>
            <th>店铺名称</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
        <tr>
            <td>{{$shop->id}}</td>
            <td>{{$shop->shop_name}}</td>
            <td>
                <a href="" class="btn btn-sm btn-warning">编辑</a>
                <button class="btn btn-sm btn-info shop_delete">删除</button>
            </td>
        </tr>
            @endforeach
    </table>
@stop
