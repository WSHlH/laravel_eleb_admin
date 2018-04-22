@extends('layout.default')
@section('title','管理员登录')
@section('content')
    <form action="{{route('login')}}" method="post" class="col-xs-6">
        <div class="form-group">
            <label for="name">管理员名</label>
            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="管理员名">
        </div>
        <div class="form-group">
            <label for="password">密码</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="密码">
        </div>
        <div>
            <label >验证码</label>
            <div class="row">
                <div class="col-xs-4 form-group">
                    <input id="captcha" class="form-control" name="captcha"  placeholder="验证码">
                </div>
                <div class="col-xs-3">
                    <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="remember" {{old('remember')==1?'checked':''}}> 记住登录
            </label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        {{csrf_field()}}
    </form>
@stop
