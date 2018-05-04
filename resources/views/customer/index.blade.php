@extends('layout.default')
@section('title','会员列表')
@section('content')
    <table class="table table-hover table-border table-responsive">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>联系方式</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach ($customers as $customer)
            <tr data-id="{{$customer->id}}">
                <td>{{$customer->id}}</td>
                <td>
                    <a href="{{route('customer.show',['customer'=>$customer])}}">{{$customer->username}}</a>
                </td>
                <td>{{$customer->tel}}</td>
                <td>{{$customer->status==0?'正常':'禁用'}}</td>
                <td>
                    <a href="{{route('customer.edit',['customer'=>$customer])}}" class="btn btn-sm btn-warning">编辑</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$customers->links()}}
@stop
