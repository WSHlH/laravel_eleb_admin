<?php

namespace App\Http\Controllers;

use App\Model\Business;
use App\Model\BusinessList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class BusinessListController extends Controller
{
    public function index()
    {
        $businessLists = BusinessList::paginate(5);
        return view('businessList.index',compact('businessLists'));
    }

    public function create()
    {
        $categories = DB::table('business_categories')->get();
//        var_dump($categories);die;
        return view('businessList.create',compact('businessList','categories'));
    }

    public function store(Request $request)
    {
        //检验
        $this->validate($request,[
            'phone'=>'required|max:11|unique:businesses',
            'password'=>'required|min:3|max:16',
            "shop_name"=>'required|min:3|max:15',
            "shop_img"=>'required',//|image
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
        //检验成功,开启事务保存至数据库
        DB::transaction(function () use($request){
//            $fileName = $request->file('shop_img')->store('public/shop');
//            $fileUrl = url(Storage::url($fileName));
//        var_dump($fileUrl);die;
            BusinessList::create([
                "shop_name"=>$request->shop_name,
                'business_categories_id'=>$request->business_categories_id,
                "shop_img"=>$request->shop_img,
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
        });
//保存成功,提示并跳转
        session()->flash('success','注册成功!');
        return redirect()->route('businessList.index');
    }

    public function edit(BusinessList $businessList)
    {
        $category = DB::table('business_categories')->where('id','=',$businessList->business_categories_id)->get();
        $business = DB::table('businesses')->where('id','=',$businessList->id)->get();
//        var_dump()
        return view('businessList.edit',compact('businessList','business','category'));
    }

    public function update(Request $request,BusinessList $businessList)
    {
        //验证
        $this->validate($request,[
            'is_examine'=>'required',
        ]);
        //修改
        $businessList->update([
            'is_examine'=>$request->is_examine,
            'status'=>$request->status,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('businessList.index');
    }

    public function destroy(BusinessList $businessList)
    {
//
//        var_dump($business);die;
        $business = new Business();
        DB::transaction(function ()use($businessList,$business){
            $businessList->delete();
            $business->delete();
        });
        session()->flash('success','删除成功!');
    }

//    public function status(BusinessList $businessList)
//    {
//        DB::table('businesses')->where('id','=',$businessList->id)->update(['status'=>0]);
//        session()->flash('success','禁用成功!');
//    }
}
