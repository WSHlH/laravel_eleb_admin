@extends('layout.default')
@section('title','修改管理员权限')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">修改管理员权限</p>
    <form action="{{route('userRoleSave',['userRole'=>$userRole])}}" method="POST" class="col-xs-6" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">管理员名</label>
            <input type="text" name="name" class="form-control" value="{{$userRole->name}}">
        </div>
        <div class="form-group">
            <label for="shop_name">管理员角色</label><br>
            @foreach($roles as $role)
                <label><input type="checkbox" name="role[]" value="{{$role->id}}" class="form-control-static" {{$userRole->hasRole($role->name)?'checked':''}}>{{$role->display_name}}&emsp;</label>
            @endforeach
        </div>
        <input type="submit" value="修改" class="btn btn-group btn-block">
        {{csrf_field()}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
