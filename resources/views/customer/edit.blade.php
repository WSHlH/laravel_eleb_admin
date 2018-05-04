@extends('layout.default')
@section('title','操作用户')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">操作用户</p>
    <form action="{{route('customer.update',['customer'=>$customer])}}" method="post" class="col-xs-6">
        <div class="form-group">
            <label>用户名:</label>
            <input type="text" value="{{$customer->username}}" class="form-control" readonly="readonly">
        </div>
        <div class="form-group">
            <label> 联系方式:</label>
            <input type="text" value="{{$customer->tel}}" class="form-control"  readonly="readonly">
        </div>
        <div class="form-group">
            <label>会员状态:</label>
            <label><input type="checkbox" name="status" value="-1" {{$customer->status==0?'':'checked'}}>禁用</label>
        </div>
        <div class="form-group">
            <input type="submit" value="确认" class="btn-block form-control" >
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/6.jpg" alt="" width="40%">
@stop
