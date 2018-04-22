@extends('layout.default')
@section('title','管理员列表')
@section('content')
    <table class="table table-hover table-border table-responsive" id="admin_delete">
        <tr>
            <th>id</th>
            <th>管理员名称</th>
            <th>操作</th>
        </tr>
        @foreach ($users as $user)
            <tr data-id="{{$user->id}}">
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>
                    <a href="{{route('user.edit',['user'=>$user])}}" class="btn btn-sm btn-warning">编辑</a>
                    <button class="btn btn-sm btn-info admin_delete">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$users->links()}}
@stop
@section('jquery')
    <script>
        $('#admin_delete .admin_delete').click(function(){
            if (confirm('删除后不可恢复,是否确认删除?')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type:'DELETE',
                    url:'user/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function(mag){
                        tr.fadeOut();
                    }
                });
            }
        })
    </script>
    @stop
