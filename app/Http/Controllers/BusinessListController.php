<?php

namespace App\Http\Controllers;

use App\Model\BusinessList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessListController extends Controller
{
    public function index()
    {
        $shops = BusinessList::paginate();
        return view('shop.index',compact('shops'));
    }

    public function create()
    {
        $categories = DB::table('business_categories')->get();
//        var_dump($categories);die;
        return view('shop.create',compact('businessList','categories'));
    }

    public function store(Request $request)
    {
        //检验
        $this->validate($request,[
            'phone'=>'required|max:11|unique:businesses',
            'password'=>'required|min:3|max:16',
            "shop_name"=>'required|min:3|max:15',
            "shop_img"=>'required|image',
            'business_categories_id'=>'required',
            "brand"=>'required',
            "on_time"=>'required',
            "humming"=>'required',
            "promise"=>'required',
            "invoice"=>'required',
            "start_send"=>'required|numeric',
            "send_cost"=>'required|numeric',
            "estimate_time"=>'required|numeric',
            "notice"=>'required|max:120',
            "discount"=>'required|max:50',
            'is_examine'=>'required',
        ]);
        //检验成功,保存至数据库
        $fileName = $request->file('shop_img')->store('public/shop');
       BusinessList::create([
            "shop_name"=>$request->shop_name,
            'business_categories_id'=>$request->business_categories_id,
            "shop_img"=>$fileName,
            "on_time"=>$request->on_time,
            "humming"=>$request->humming,
            "promise"=>$request->promise,
            "invoice"=>$request->invoice,
            "start_send"=>$request->start_send,
            "send_cost"=>$request->send_cost,
            "estimate_time"=>$request->estimate_time,
            "notice"=>$request->notice,
            "discount"=>$request->discount,
           'is_examine'=>$request->is_examine,
        ]);
        DB::table('businesses')->insert(['phone'=>$request->phone,'password'=>bcrypt($request->password)]);
        //保存成功,提示并跳转
        session()->flash('success','注册成功!');
        return redirect()->route('shopIndex');
    }
}
