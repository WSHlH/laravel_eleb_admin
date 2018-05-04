@extends('layout.default')
@section('title','角色添加')
@section('content')
    <p style="color:#c8c8cf;font-size: 20px">角色添加</p>
    <form action="{{route('role.store')}}" method="POST" class="col-xs-6">
        <div class="form-group">
            <label>角色名:</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label>角色简述:</label>
            <input type="text" name="display_name" class="form-control" value="{{old('display_name')}}">
        </div>
        <div class="form-group">
            <label>描述:</label>
            <textarea name="description" cols="10" rows="2" class="form-control">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <label>权限:</label><br>
            @foreach($permissions as $permission)
                <label><input type="checkbox" name="role[]" value="{{$permission->id}}" class="form-control-static">{{$permission->display_name}}&emsp;</label>
                @endforeach
        </div>
        <input type="submit" value="添加" class="btn btn-group btn-block">
        {{csrf_field()}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
@section('jquery')
    <script>
        $('#permission_delete .permission_delete').click(function(){
            if (confirm('删除后不可恢复,是否确认删除?')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type:'DELETE',
                    url:'permission/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function(mag){
                        tr.fadeOut();
                    },
                    error:function(msg){
                        alert('服务器请求失败!');
                    }
                });
            }
        });
    </script>
@stop
