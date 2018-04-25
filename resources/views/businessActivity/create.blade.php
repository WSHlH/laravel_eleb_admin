@extends('layout.default')
@section('title','添加店铺活动')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">添加店铺活动</p>
    <form action="{{route('businessActivity.store')}}" method="POST" class="col-xs-6" enctype="multipart/form-data">
        活动名:
        <input type="text" name="title" class="form-control" value="{{old('title')}}"><br>
        开始时间:
        <input type="date" name="start" class="form-control" value="{{old('start')}}"><br>
        结束时间:
        <input type="date" name="end" class="form-control" value="{{old('end')}}"><br>
        活动内容:
        <div>
            <!-- 加载编辑器的容器 -->
            <textarea id="container" name="content">
                {{old('content')}}
            </textarea>
            <!--配置文件-->
            <script type="text/javascript" src="/demo/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script type="text/javascript" src="/demo/ueditor.all.js"></script>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
            </script>
        </div>
        <br>
        <input type="submit" value="添加" class="btn btn-group btn-block">
        {{csrf_field()}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
