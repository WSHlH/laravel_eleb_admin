@extends('layout.default')
@section('title','添加菜单')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">添加菜单</p>
    <form action="{{route('menu.store')}}" method="POST" class="col-xs-6">
        <div class="form-group">
            <label>菜单名称:</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label>上级菜单:</label>
            <select name="parent_id" class="form-control">
                <option value="0">==请选择上级菜单==</option>
                    @foreach($parent_ids as $parent_id)
                <option value="{{$parent_id->id}}">{{$parent_id->name_txt}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>菜单地址:</label>
            <input type="text" name="url" class="form-control" value="{{old('url')}}">
        </div>

        <div class="form-group">
            <label>菜单排序:</label>
            <input type="text" name="sort" class="form-control" value="{{old('sort')}}">
        </div>
        <input type="submit" value="添加" class="btn btn-group btn-block">
        {{csrf_field()}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
