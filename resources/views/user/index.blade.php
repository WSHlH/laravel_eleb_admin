@extends('layout.default')
@section('title','管理员列表')
@section('content')
    <table class="table table-hover table-border table-responsive" id="category_delete">
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
                    <button class="btn btn-sm btn-info package_delete">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$users->links()}}
@stop
