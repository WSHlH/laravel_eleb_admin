@extends('layout.default')
@section('title','添加权限')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">添加权限</p>
    <form action="{{route('permission.store')}}" method="POST" class="col-xs-6">
        <div class="form-group">
            <label>权限内容:</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label>权限简述:</label>
            <input type="text" name="display_name" class="form-control" value="{{old('display_name')}}">
        </div>
        <div class="form-group">
            <label>描述:</label>
            <textarea name="description" cols="30" rows="6" class="form-control">{{old('description')}}</textarea>
        </div>
        <input type="submit" value="添加" class="btn btn-group btn-block">
        {{csrf_field()}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
