@extends('layout.default')
@section('title','商家抽奖列表')
@section('content')
    <table class="table table-hover table-border table-responsive" id="eventBusiness_del">
        <tr>
            <th>id</th>
            <th>活动名</th>
            <th>商家</th>
            <th>操作</th>
        </tr>
        @foreach ($eventBusinesses as $eventBusiness)
            <tr data-id="{{$eventBusiness->id}}">
                <td>{{$eventBusiness->id}}</td>
                <td>{{$eventBusiness->event->title}}</td>
                <td>{{$eventBusiness->business->shop_name}}</td>
                <td>
                    {{--{{route('eventBusiness.edit',['eventBusiness'=>$eventBusiness])}}--}}
                    <a href="" class="btn btn-sm btn-warning">编辑</a>
                    <button class="btn btn-danger eventBusiness_del">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$eventBusinesses->links()}}
@stop

@section('jquery')
    <script>
        $('#eventBusiness_del .eventBusiness_del').click(function(){
            if (confirm('删除后不可恢复,是否确认删除?')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type:'DELETE',
                    url:'eventBusiness/'+id,
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
