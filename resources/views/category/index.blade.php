@extends('layout.default')
@section('title','分类列表')
@section('content')
    <table class="table table-hover table-border table-responsive" id="category_delete">
        <tr>
            <th>id</th>
            <th>分类图片</th>
            <th>分类名称</th>
            <th>操作</th>
        </tr>
        @foreach ($categories as $category)
            <tr data-id="{{$category->id}}">
                <td>{{$category->id}}</td>
                <td>
                    <img src="{{\Illuminate\Support\Facades\Storage::url($category->image)}}" alt="" width="100">
                </td>
                <td>{{$category->name}}</td>
                <td>
                    <a href="{{route('category.edit',['category'=>$category])}}" class="btn btn-sm btn-warning">编辑</a>
                    <button class="btn btn-sm btn-info package_delete">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$categories->links()}}
@stop
