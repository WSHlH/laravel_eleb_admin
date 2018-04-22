@extends('layout.default')
@section('title','编辑分类')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">编辑分类</p>
    <form action="{{route('category.update',['category'=>$category])}}" method="POST" class="col-xs-6" enctype="multipart/form-data">
        分类名:
        <input type="text" name="name" class="form-control" value="{{$category->name}}"><br>
        分类图片:
        <input type="file" name="image"><br>
        <input type="submit" value="确认修改" class="btn btn-group btn-block">
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form><img src="" alt="" class="col-xs-1">
    <div>原图片:</div>
    <img src="{{$category->image}}" alt="" width="40%">
@stop
