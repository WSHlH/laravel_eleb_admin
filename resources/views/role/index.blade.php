@extends('layout.default')
@section('title','角色列表')
@section('content')
    <a href="{{route('role.create')}}" class="btn btn-primary">添加角色</a>
    <table class="table table-hover table-border table-responsive" id="role_delete">
        <tr>
            <th>id</th>
            <th>角色内容</th>
            <th>角色简述</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach ($roles as $role)
            <tr data-id="{{$role->id}}">
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td>
                    <a href="{{route('role.edit',['role'=>$role])}}" class="btn btn-sm btn-warning">编辑</a>
                    <button class="btn btn-sm btn-danger role_delete">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$roles->links()}}
@stop
@section('jquery')
    <script>
        $('#role_delete .role_delete').click(function(){
            if (confirm('删除后不可恢复,是否确认删除?')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type:'DELETE',
                    url:'role/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function(msg){
                            tr.fadeOut();
                    }
//                    ,
//                    error:function(msg){
//                        alert('服务器请求失败!');
//                    }
                });
            }
        });
    </script>
@stop