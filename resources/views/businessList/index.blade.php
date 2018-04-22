@extends('layout.default')
@section('title','店铺管理')
@section('content')
    <a href="{{route('businessList.create')}}" class="btn btn-primary">注册店铺</a>
    <table class="table table-hover table-border table-responsive" id="business">
        <tr>
            <th>id</th>
            <th>店铺名称</th>
            <th>审核通过</th>
            <th>禁用</th>
            <th>操作</th>
        </tr>
        @foreach($businessLists as $businessList)
        <tr data-id="{{$businessList->id}}">
            <td>{{$businessList->id}}</td>
            <td>{{$businessList->shop_name}}</td>
            <td>{{$businessList->is_examine==1?'√':'×'}}</td>
            <td>{{$businessList->status==1?'是':'否'}}</td>
            <td>
                <a href="{{route('businessList.edit',['businessList'=>$businessList])}}" class="btn btn-sm btn-warning">审核</a>
                {{--<button class="btn btn-sm btn-primary business_status">禁用</button>--}}
                <button class="btn btn-sm btn-danger business_delete">删除</button>
            </td>
        </tr>
            @endforeach
    </table>
@stop

@section('jquery')
    <script>
        $('#business .business_delete').click(function(){
            if (confirm('删除后不可恢复,是否确认删除?')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type:'DELETE',
                    url:'businessList/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function(mag){
                        tr.fadeOut();
                    },
                    error:function(msg){
                        alert('服务器请求失败!');
                    }
                });
            }
        });

        {{--$('#business .business_status').click(function(){--}}
            {{--var tr = $(this).closest('tr');--}}
            {{--var id = tr.data('id');--}}
            {{--var that = this;--}}
            {{--{'_token':'{{csrf_token()}}','status':1},--}}
            {{--$.getJSON('business/'+id,function(msg){--}}
                {{--$(that).html('启用');--}}
            {{--});--}}
            {{--$.ajax({--}}
                {{--type:'GET',--}}
                {{--url:'business/'+id,--}}
                {{--data:'_token={{csrf_token()}}',--}}
                {{--success:function(mag){--}}
                    {{--$(that).html('启用');--}}
                {{--}--}}
            {{--});--}}
//        })

    </script>
    @stop