@extends('layout.default')
@section('title','角色修改')
@section('content')
    <p style="color:#c8c8cf;font-size: 20px">角色修改</p>
    <form action="{{route('role.update',['role'=>$role])}}" method="POST" class="col-xs-6">
        <div class="form-group">
            <label>角色名:</label>
            <input type="text" name="name" class="form-control" value="{{$role->name}}">
        </div>
        <div class="form-group">
            <label>角色简述:</label>
            <input type="text" name="display_name" class="form-control" value="{{$role->display_name}}">
        </div>
        <div class="form-group">
            <label>描述:</label>
            <textarea name="description" cols="10" rows="2" class="form-control">{{$role->description}}</textarea>
        </div>
        <div class="form-group">
            <label>权限:</label><br>
            @foreach($permissions as $permission)
                <label><input type="checkbox" name="role[]" value="{{$permission->id}}" class="form-control-static" {{$role->hasPermission($permission->name)?'checked':''}}>{{$permission->display_name}}&emsp;</label>
                {{--{{in_array($permission->id,$p)?'checked':''}}--}}
                @endforeach
        </div>
        <input type="submit" value="修改" class="btn btn-group btn-block">
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
