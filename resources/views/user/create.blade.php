@extends('layout.default')
@section('title','注册管理员')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">注册管理员</p>
    <form action="{{route('user.store')}}" method="post" class="col-xs-6">
        <div class="form-group">
            <label for="name">管理员名称</label>
            <input type="text" name="name" class="form-control" id="shop_name" placeholder="管理员名称">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
        </div>
        <div class="form-group">
            <label >确认密码</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
        </div>
        <button type="submit" class="btn btn-default btn-block">注册管理员</button>
        {{csrf_field()}}
    </form>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
