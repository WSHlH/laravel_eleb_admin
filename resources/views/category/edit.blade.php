@extends('layout.default')
@section('title','编辑分类')
@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <p style="color:#c8c8cf;font-size: 24px">编辑分类</p>
    <form action="{{route('category.update',['category'=>$category])}}" method="POST" class="col-xs-6" enctype="multipart/form-data">
        分类名:
        <input type="text" name="name" class="form-control" value="{{$category->name}}"><br>
        {{--分类图片:--}}
        {{--<input type="file" name="image"><br>--}}
    <!--dom结构部分-->
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">分类图片</div>
            <br>
            <img src="" id="cat-image" width="200">
            <input type="hidden" name="image" value="" id="image" class="form-control">
        </div>
        <br>
        <input type="submit" value="确认修改" class="btn btn-group btn-block">
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form><img src="" alt="" class="col-xs-1">
    <div>原图片:</div>
    <img src="{{$category->image}}" alt="" width="40%">
@stop
@section('jquery')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            //因为是仿表单提交,需要传token
            formData:{"_token":"{{csrf_token()}}"},

            // swf文件路径
            swf: '/webuploader/Uploader.swf',

            // 文件接收服务端。
//            server: 'http://webuploader.duapp.com/server/fileupload.php',
            server: '/businessCatAdd',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        // 监听文件上传成功事件,回显
        uploader.on( 'uploadSuccess', function( file,response ) {
//            $( '#'+file.id ).addClass('upload-state-done');
            var url = response.url;
            $('#cat-image').attr('src',url);
            $('#image').val(url);
        });
    </script>
@stop
