@extends('layout.default')
@section('title','权限列表')
@section('content')
    <a href="{{route('permission.create')}}" class="btn btn-primary">添加权限</a>
    <table class="table table-hover table-border table-responsive" id="permission_delete">
        <tr>
            <th>id</th>
            <th>权限内容</th>
            <th>权限简述</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach ($permissions as $permission)
            <tr data-id="{{$permission->id}}">
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->display_name}}</td>
                <td>{{$permission->description}}</td>
                <td>
                    <a href="{{route('permission.edit',['permission'=>$permission])}}" class="btn btn-sm btn-warning">编辑</a>
                    <button class="btn btn-sm btn-danger permission_delete">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$permissions->links()}}
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
                    success:function(msg){
                        console.debug(msg);
//                        if (msg==1){
//                            alert('有角色拥有该权限,不可删除');
//                        }else {
                            tr.fadeOut();
//                        }
                    },
                    error:function(msg){
                        alert('服务器请求失败!');
                    }
                });
            }
        });
    </script>
@stop