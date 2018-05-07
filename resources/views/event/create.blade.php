@extends('layout.default')
@section('title','添加抽奖活动')
@section('content')
    <p style="color:#c8c8cf;font-size: 20px">添加抽奖活动</p>
    <form action="{{route('event.store')}}" method="POST" class="col-xs-6">
        <div class="form-group">
            <label>活动名称:</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label>活动内容:</label>
            <textarea name="content" cols="30" rows="3" class="form-control">{{old('content')}}</textarea>
        </div>
        <div class="form-group">
            <label>报名开始时间:</label>
            <input type="date" name="signup_start" class="form-control" value="{{old('signup_start')}}">
        </div>
        <div class="form-group">
            <label>报名结束时间:</label>
            <input type="date" name="signup_end" class="form-control" value="{{old('signup_end')}}">
        </div>
        <div class="form-group">
            <label>开奖时期:</label>
            <input type="date" name="prize_date" class="form-control" value="{{old('prize_date')}}">
        </div>
        <div class="form-group">
            <label>人数上限:</label>
            <input type="text" name="signup_num" class="form-control" value="{{old('signup_num')}}">
        </div>
        <input type="submit" value="添加" class="btn btn-group btn-block">
        {{csrf_field()}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
