<?php

namespace App\Http\Controllers;

use App\Model\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller
{
    public function index()
    {
        $categories = BusinessCategory::paginate(5);
        return view('category.index',compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        //检验
        $this->validate($request,[
            'name'=>'required|min:2|max:5',
            'image'=>'required|image',
        ]);
        //检测成功.保存数据库
        $fileName = $request->file('image')->store('public/category');
        BusinessCategory::create([
            'name'=>$request->name,
            'image'=>$fileName,
        ]);
        //保存成功,提示并跳转
        session()->flash('success','添加成功!');
        return redirect()->route('category.index');
    }
}
