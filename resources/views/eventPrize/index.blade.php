@extends('layout.default')
@section('title','奖品列表')
@section('content')
    <table class="table table-hover table-border table-responsive" id="eventPrize_del">
        <tr>
            <th>id</th>
            <th>活动名</th>
            <th>奖品</th>
            <th>中奖商家</th>
            <th>操作</th>
        </tr>
        @foreach ($eventPrizes as $eventPrize)
            <tr data-id="{{$eventPrize->id}}">
                <td>{{$eventPrize->id}}</td>
                <td>{{$eventPrize->event->title}}</td>
                <td>
                    <a href="{{route('eventPrize.show',['eventPrize'=>$eventPrize])}}">{{$eventPrize->name}}</a>
                </td>
                <td>{{$eventPrize->business_lists_id==0?'无中奖商家':$eventPrize->business->shop_name}}</td>
                <td>
                    <a href="{{route('eventPrize.edit',['eventPrize'=>$eventPrize])}}" class="btn btn-sm btn-warning">编辑</a>
                    <button class="btn btn-danger eventPrize_del">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$eventPrizes->links()}}
@stop

@section('jquery')
    <script>
        $('#eventPrize_del .eventPrize_del').click(function(){
            if (confirm('删除后不可恢复,是否确认删除?')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type:'DELETE',
                    url:'eventPrize/'+id,
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
