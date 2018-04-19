@extends('layout.default')
@section('title','注册管理员')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">注册管理员</p>
    <form action="{{route('user.store')}}" method="POST" class="col-xs-6" enctype="multipart/form-data">
        分类名:
        <input type="text" name="name" class="form-control" value="{{old('name')}}"><br>
        <input type="submit" value="添加" class="btn btn-group btn-block">
        {{csrf_field()}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
