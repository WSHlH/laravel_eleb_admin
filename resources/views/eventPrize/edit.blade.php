@extends('layout.default')
@section('title','修改奖品')
@section('content')
    <p style="color:#c8c8cf;font-size: 20px">修改奖品</p>
    <form action="{{route('eventPrize.update',['eventPrize'=>$eventPrize])}}" method="POST" class="col-xs-6">
        <div class="form-group">
            <label>活动名称:</label>
            <select name="events_id" class="form-control">
                @foreach($events as $event)
                <option value="{{$event->id}}" {{$event->id==$eventPrize->events_id?'selected':''}}>{{$event->title}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>奖品名称:</label>
            <input type="text" name="name" class="form-control" value="{{$eventPrize->name}}">
        </div>
        <div class="form-group">
            <label>奖品详情:</label>
            <textarea name="description" cols="30" rows="3" class="form-control">{{$eventPrize->description}}</textarea>
        </div>
        <input type="submit" value="修改" class="btn btn-group btn-block">
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
