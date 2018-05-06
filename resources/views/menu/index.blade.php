@extends('layout.default')
@section('title','菜单列表')
@section('content')
    <a href="{{route('menu.create')}}" class="btn btn-primary">添加菜单</a>
    <table class="table table-hover table-border table-responsive" id="menu_delete">
        <tr>
            <th>id</th>
            <th>菜单名称</th>
            <th>上级菜单</th>
            <th>菜单地址</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        @foreach ($menus as $menu)
            <tr data-id="{{$menu->id}}">
                <td>{{$menu->id}}</td>
                <td>{{$menu->name}}</td>
                <td>{{$menu->parent_id}}</td>
                <td>{{$menu->url}}</td>
                <td>{{$menu->sort}}</td>
                <td>
                    <a href="{{route('menu.edit',['menu'=>$menu])}}" class="btn btn-sm btn-warning">编辑</a>
                    <button class="btn btn-sm btn-danger menu_delete">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$menus->links()}}
@stop

@section('jquery')
    <script>
        $('#menu_delete .menu_delete').click(function(){
            if (confirm('删除后不可恢复,是否确认删除?')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type:'DELETE',
                    url:'menu/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function(msg){
                        console.debug(msg);
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
