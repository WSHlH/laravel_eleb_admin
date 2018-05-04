@extends('layout.default')
@section('title','销售量')
@section('content')
    <div class="panel panel-info">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <tr>
                        <form action="{{route('orders.store')}}" method="post" class="form-control">
                            <th>
                                范围查询:
                                <input type="date" name="datetime1">--
                                <input type="date" name="datetime2">
                                <button class="btn btn-group-sm btn-info">查询</button>
                            </th>
                            {{ csrf_field() }}
                        </form>
                    </tr>
                </table>
            </div>
        </div>
    <div class="row">
        <div class="col-sm-4">
        <table class="table table-bordered">
            <tr>
                <th colspan="3">平台菜品销量统计</th>
            </tr>
            <tr>
                <td>店铺</td>
                <td>菜品</td>
                <td>菜品数量</td>
            </tr>
            @forelse($rows as $row)
                    <tr>
                        <td>{{$row->shop_name}}</td>
                        <td>{{$row->goods_name}}</td>
                        <td>{{$row->amounts}}</td>
                    </tr>
            @empty
            @endforelse
        </table>
    </div>
            <div class="col-sm-2">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2">总计</th>
                    </tr>
                    <tr>
                        <td>菜品数量</td>
                        <td>{{$count1}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-2">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2">月统计</th>
                    </tr>
                    <tr>
                        <td>菜品数量</td>
                        <td>{{$count2}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-2">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2">日统计</th>
                    </tr>
                    <tr>
                        <td>菜品数量</td>
                        <td>{{$count3}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    {{--<div class="panel panel-info">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-4">--}}
                {{--<table class="table table-bordered">--}}
                    {{--<tr>--}}
                        {{--<th colspan="3">菜品日统计</th>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>店铺</td>--}}
                        {{--<td>菜品</td>--}}
                        {{--<td>菜品数量</td>--}}
                    {{--</tr>--}}
                    {{--@forelse($days as $key=>$val)--}}
                        {{--<tr>--}}
                            {{--<td rowspan="{{count($val)+1}}">{{$shop_ids[$key]->shop_name}}</td>--}}
                        {{--</tr>--}}
                        {{--@foreach($val as $row)--}}
                            {{--<tr>--}}
                                {{--<td>{{$row->goods_id}}</td>--}}
                                {{--<td>{{$row->d}}</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--@empty--}}
                    {{--@endforelse--}}
                    {{--<tr>--}}
                        {{--<td></td>--}}
                        {{--<td>总计:</td>--}}
                        {{--<td>{{$dayCount}}</td>--}}
                    {{--</tr>--}}
                {{--</table>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<table class="table table-bordered">--}}
                    {{--<tr>--}}
                        {{--<th colspan="3">菜品月统计</th>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>店铺</td>--}}
                        {{--<td>菜品</td>--}}
                        {{--<td>菜品数量</td>--}}
                    {{--</tr>--}}
                    {{--@forelse($months as $key=>$val)--}}
                        {{--<tr>--}}
                            {{--<td rowspan="{{count($val)+1}}">{{$shop_ids[$key]->shop_name}}</td>--}}
                        {{--</tr>--}}
                        {{--@foreach($val as $row)--}}
                            {{--<tr>--}}
                                {{--<td>{{$row->goods_id}}</td>--}}
                                {{--<td>{{$row->m}}</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--@empty--}}
                    {{--@endforelse--}}
                    {{--<tr>--}}
                        {{--<td></td>--}}
                        {{--<td>总计:</td>--}}
                        {{--<td>{{$monthCount}}</td>--}}
                    {{--</tr>--}}
                {{--</table>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<table class="table table-bordered">--}}
                    {{--<tr>--}}
                        {{--<th colspan="3">菜品总统计</th>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>店铺</td>--}}
                        {{--<td>菜品</td>--}}
                        {{--<td>菜品数量</td>--}}
                    {{--</tr>--}}
                    {{--@forelse($totals as $key=>$val)--}}
                        {{--<tr>--}}
                            {{--<td rowspan="{{count($val)+1}}">{{$shop_ids[$key]->shop_name}}</td>--}}
                        {{--</tr>--}}
                        {{--@foreach($val as $row)--}}
                            {{--<tr>--}}
                                {{--<td>{{$row->goods_id}}</td>--}}
                                {{--<td>{{$row->t}}</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--@empty--}}
                    {{--@endforelse--}}
                    {{--<tr>--}}
                        {{--<td></td>--}}
                        {{--<td>总计:</td>--}}
                        {{--<td>{{$totalCount}}</td>--}}
                    {{--</tr>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-12">--}}
                {{--<table class="table table-bordered">--}}
                    {{--<tr>--}}
                        {{--{{route('food.time')}}--}}
                        {{--<form action="{{route('orders.store')}}" method="post" class="form-control">--}}
                            {{--<th>--}}
                                {{--范围查询:--}}
                                {{--<input type="date" name="datetime1">----}}
                                {{--<input type="date" name="datetime2">--}}
                                {{--<button class="btn btn-group-sm btn-info">查询</button>--}}
                            {{--</th>--}}
                            {{--{{ csrf_field() }}--}}
                        {{--</form>--}}
                    {{--</tr>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop

