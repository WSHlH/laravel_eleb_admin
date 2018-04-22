@extends('layout.default')
@section('title','审核店铺')
@section('content')
    <form action="{{route('businessList.update',['businessList'=>$businessList,'business'=>$business,'category'=>$category])}}" method="post" enctype="multipart/form-data" class="col-xs-6">
        <div class="form-group">
            <label >店铺名称:</label>
            <input type="text" name="shop_name" class="form-control" value="{{$businessList->shop_name}}" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="brand">店铺是否为品牌:</label>
            <label class="radio-inline"><input type="radio" name="brand" value="1" {{$businessList->brand==1?'checked':''}} disabled> 是</label>
            <label class="radio-inline"><input type="radio" name="brand" value="0" {{$businessList->brand==0?'checked':''}} disabled>否</label>
        </div>
        <fieldset disabled>
        <div class="form-group">
            <label for="disabledSelect">店铺所属分类:</label>
            <select name="business_categories_id" id="disabledSelect"  class="form-control" >
                @foreach($category as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
            </select>
        </div>
        </fieldset>
        <div class="form-group">
            <label for="phone">电话号码:</label>
            @foreach($business as $item)
            <input type="text" name="phone" class="form-control" id="phone" value="{{$item->phone}}" readonly="readonly">
                @endforeach
        </div>
        <div class="form-group">
            <label>店铺图片:</label>
            <img src="{{$businessList->shop_img}}" alt="" width="200">
        </div>
        <div class="form-group">
            <label for="start_send">起送价:</label>
            <input type="text" name="start_send" value="{{$businessList->start_send}}"  class="form-control" id="start_send" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="send_cost">配送费:</label>
            <input type="text" name="send_cost" value="{{$businessList->send_cost}}"  class="form-control" id="send_cost" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="humming">店铺是否蜂鸟配送:</label>
            <label class="radio-inline"><input type="radio" name="humming" value="1" {{$businessList->humming==1?'checked':''}} disabled>是</label>
            <label class="radio-inline"><input type="radio" name="humming" value="0" {{$businessList->humming==0?'checked':''}} disabled>否</label>
        </div>
        <div class="form-group">
            <label for="estimate_time">预约时间:</label>
            <input type="text" name="estimate_time" value="{{$businessList->estimate_time}}"  class="form-control" id="estimate_time" readonly="readonly">
        </div>
        <div class="form-group">
            <label for="on_time">店铺是否准时达:</label>
            <label class="radio-inline"><input type="radio" name="on_time" value="1" {{$businessList->on_time==1?'checked':''}} disabled>是</label>
            <label class="radio-inline"><input type="radio" name="on_time" value="0" {{$businessList->on_time==0?'checked':''}} disabled>否</label>
        </div>
        <div class="form-group">
            <label for="promise">店铺是否晚到必赔:</label>
            <label class="radio-inline"><input type="radio" name="promise" value="1" {{$businessList->promise==1?'checked':''}} disabled>是</label>
            <label class="radio-inline"><input type="radio" name="promise" value="0" {{$businessList->promise==0?'checked':''}} disabled>否</label>
        </div>
        <div class="form-group">
            <label for="invoice">店铺是否开具发票:</label>
            <label class="radio-inline"><input type="radio" name="invoice" value="1" {{$businessList->invoice==1?'checked':''}} disabled>是</label>
            <label class="radio-inline"><input type="radio" name="invoice" value="0" {{$businessList->invoice==0?'checked':''}} disabled>否</label>
        </div>
        <div class="form-group">
            <label for="notice">店铺公告:</label>
            <textarea name="notice" class="form-control" cols="30" rows="4" readonly="readonly">{{$businessList->notice}}</textarea>
        </div>
        <div class="form-group">
            <label for="discount">店铺优惠:</label>
            <textarea name="discount" class="form-control" cols="30" rows="4" readonly="readonly">{{$businessList->discount}}</textarea>
        </div>
        <div class="form-group">
            <label for="invoice">审核通过:</label>
            <label class="radio-inline"><input type="radio" name="is_examine" value="1" {{$businessList->is_examine==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="is_examine" value="0" {{$businessList->is_examine==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="invoice">禁用:</label>
            <label class="radio-inline"><input type="radio" name="status" value="0" {{$businessList->status==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="status" value="1" {{$businessList->status==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <input type="submit" value="提交审核" class="form-control btn-block">
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>
    <div>&emsp;</div>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/8.jpg" alt="" width="40%">
@stop
