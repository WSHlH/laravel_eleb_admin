<?php

namespace App\Http\Controllers;

use App\Model\BusinessCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
            'name'=>'required|min:2|max:5|unique:business_categories',
            'image'=>'required',//|image
        ]);
        //检测成功.保存数据库
//        $fileName = $request->file('image')->store('public/category');
//        $fileUrl = url(Storage::url($fileName));
        BusinessCategory::create([
            'name'=>$request->name,
            'image'=>$request->image,
        ]);
        //保存成功,提示并跳转
        session()->flash('success','添加成功!');
        return redirect()->route('category.index');
    }

    public function edit(BusinessCategory $category)
    {
//        var_dump($category->name);die;
        return view('category.edit',compact('category'));
    }

    public function update(Request $request,BusinessCategory $category)
    {
        //检验
        $this->validate($request,[
            'name'=>['min:2','max:5',Rule::unique('business_categories')->ignore($category->id)],
            'image'=>'required',//|image
        ]);
        //检测成功.保存数据库
//        $fileName = $request->file('image')->store('public/category');
//        $fileUrl = url(Storage::url($fileName));
        $category->update([
            'name'=>$request->name,
            'image'=>$request->image,
        ]);
        //保存成功,提示并跳转
        session()->flash('success','修改成功!');
        return redirect()->route('category.index');
    }
}
