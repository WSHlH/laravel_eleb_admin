@extends('layout.default')
@section('title','修改管理员信息')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">修改管理员信息</p>
    <form action="{{route('user.update',['user'=>$user])}}" method="POST" class="col-xs-6" enctype="multipart/form-data">

        <div class="form-group">
            <label for="name">管理员名</label>
            <input type="text" name="name" class="form-control" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">原密码</label>
            <input type="password" name="old_password" class="form-control"  placeholder="原密码">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">新密码</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="新密码">
        </div>
        <div class="form-group">
            <label >确认密码</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
        </div>
        <input type="submit" value="修改" class="btn btn-group btn-block">
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
