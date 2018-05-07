@extends('layout.default')
@section('title','抽奖活动列表')
@section('content')
    <table class="table table-hover table-border table-responsive" id="event_del">
        <tr>
            <th>id</th>
            <th>活动名</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>开奖时期</th>
            <th>活动人数上限</th>
            <th>是否已开奖</th>
            <th>操纵</th>
        </tr>
        @foreach ($events as $event)
            <tr data-id="{{$event->id}}">
                <td>{{$event->id}}</td>
                <td>
                    <a href="{{route('event.show',['event'=>$event])}}">{{$event->title}}</a>
                </td>
                <td>{{date('Y-m-d',$event->signup_start)}}</td>
                <td>{{date('Y-m-d',$event->signup_end)}}</td>
                <td>{{$event->prize_date}}</td>
                <td>{{$event->signup_num}}</td>
                <td>{{$event->is_prize==0?'×':'√'}}</td>
                <td>
                    <a href="{{route('event.edit',['event'=>$event])}}" class="btn btn-sm btn-warning">编辑</a>
                    <button class="btn btn-danger event_del">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$events->links()}}
@stop

@section('jquery')
    <script>
        $('#event_del .event_del').click(function(){
            if (confirm('删除后不可恢复,是否确认删除?')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type:'DELETE',
                    url:'event/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function(msg){
                        if (msg==0){
                            alert('抽奖活动未到开奖日期,不可删除!')
                        }else{
                            tr.fadeOut();
                        }
                    }
                });
            }
        });
    </script>
@stop
