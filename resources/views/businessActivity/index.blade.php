@extends('layout.default')
@section('title','店铺活动')
@section('content')
    <a href="{{route('businessActivity.create')}}" class="btn btn-primary">添加店铺活动</a>
    <table class="table table-hover table-border table-responsive" id="businessActivity">
        <tr>
            <th>id</th>
            <th>活动名称</th>
            <th>活动内容</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($businessActivities as $businessActivity)
            <tr data-id="{{$businessActivity->id}}">
                <td>{{$businessActivity->id}}</td>
                <td><a href="{{route('businessActivity.show',['businessActivity'=>$businessActivity])}}">{{$businessActivity->title}}</a></td>
                <td>{!! mb_substr($businessActivity->content,0,15) !!}...</td>
                <td>{{$businessActivity->start}}</td>
                <td>{{$businessActivity->end}}</td>
                <td>
                    {{--{{route('activity.edit',['activity'=>$businessActivity])}}--}}
                    <a href="{{route('businessActivity.edit',['businessActivity'=>$businessActivity])}}" class="btn btn-sm btn-warning">修改</a>
                    <button class="btn btn-sm btn-danger businessActivity">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    {{$businessActivities->links()}}
@stop
@section('jquery')
    <script>
        $('#businessActivity .businessActivity').click(function(){
            if (confirm('删除后无法恢复!是否确认删除?')) {
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type: 'DELETE',
                    url: 'businessActivity/' + id,
                    data: '_token={{csrf_token()}}',
                    success: function (msg) {
//                        console.debug(msg);
                        if (msg == 1) {
//                            if (confirm('删除后无法恢复!是否确认删除?')) {
                                tr.fadeOut();
                            } else {
                                alert('活动时间未截止,无法删除!');
                            }
//                        }
                    }
                });
            }
        })
    </script>
    @stop
