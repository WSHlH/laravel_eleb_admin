@extends('layout.default')
@section('title','注册店铺')
@section('content')
    <form action="{{route('shopSave')}}" method="post" enctype="multipart/form-data" class="col-xs-6">
        <div class="form-group">
            <label for="shop_name">店铺名称:</label>
            <input type="text" name="shop_name" class="form-control" id="shop_name" value="{{old('shop_name')}}">
        </div>
        <div class="form-group">
            <label for="brand">店铺是否为品牌:</label>
            <label class="radio-inline"><input type="radio" name="brand" value="1" {{old('brand')==1?'checked':''}}> 是</label>
            <label class="radio-inline"><input type="radio" name="brand" value="0" {{old('brand')==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="phone">店铺所属分类:</label>
            <select name="business_categories_id"   class="form-control" >
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="phone">电话号码:</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{old('phone')}}">
        </div>
        <div class="form-group">
            <label>店铺图片:</label>
            <input type="file" name="shop_img" >
        </div>
        <div class="form-group">
            <label for="start_send">起送价:</label>
            <input type="text" name="start_send"  value="{{old('start_send')}}"  class="form-control" id="start_send">
        </div>
        <div class="form-group">
            <label for="send_cost">配送费:</label>
            <input type="text" name="send_cost" value="{{old('send_cost')}}"    class="form-control" id="send_cost">
        </div>
        <div class="form-group">
            <label for="humming">店铺是否蜂鸟配送:</label>
            <label class="radio-inline"><input type="radio" name="humming" value="1" {{old('humming')==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="humming" value="0" {{old('humming')==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="estimate_time">预约时间:</label>
            <input type="text" name="estimate_time" value="{{old('estimate_time')}}"  class="form-control" id="estimate_time">
        </div>
        <div class="form-group">
            <label for="on_time">店铺是否准时达:</label>
            <label class="radio-inline"><input type="radio" name="on_time" value="1" {{old('on_time')==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="on_time" value="0" {{old('on_time')==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="promise">店铺是否晚到必赔:</label>
            <label class="radio-inline"><input type="radio" name="promise" value="1" {{old('promise')==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="promise" value="0" {{old('promise')==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="invoice">店铺是否开具发票:</label>
            <label class="radio-inline"><input type="radio" name="invoice" value="1" {{old('invoice')==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="invoice" value="0" {{old('invoice')==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="notice">店铺公告:</label>
            <input type="text" name="notice" value="{{old('notice')}}"  class="form-control" id="notice">
        </div>
        <div class="form-group">
            <label for="discount">店铺优惠:</label>
            <input type="text" name="discount" value="{{old('discount')}}" class="form-control" id="discount">
        </div>
        <div class="form-group">
            <label for="invoice">审核通过:</label>
            <label class="radio-inline"><input type="radio" name="is_examine" value="1" {{old('is_examine')==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="is_examine" value="0" {{old('is_examine')==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="discount">初始密码:</label>
            <input type="text" name="password" value="{{old('password')}}" class="form-control" id="password">
        </div>
        <div class="form-group">
            <input type="submit" value="注册店铺" class="form-control btn-block">
        </div>
        {{csrf_field()}}
    </form>
    <div>&emsp;</div>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/7.jpg" alt="" width="40%">
@stop
