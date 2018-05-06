<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    private function getChildren($categoryList,$pkey,$deep=0){
        static $children = [];//保存找到的儿子
        //循环所有的数据，比对每条数据中的parent_id,如果等于传入的$parent_id说明儿子找到了
        foreach ($categoryList as $child){
            if($child['parent_id'] == $pkey){
                //将找到的儿子保存到数组中
                $child['name_txt'] = str_repeat("&emsp;",$deep*2).$child['name'];//保存有缩进的名称
                $children[] = $child;//节点AAA
                //由于找到的 节点AAA 它还有儿子 继续查找
                $this->getChildren($categoryList,$child['id'],$deep+1);
            }
        }
        //返回找到的儿子
        return $children;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(10);
        return view('menu.index',compact('menus'));
    }


//

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_ids = $this->getChildren(Menu::all(),0);
//        var_dump($parent_ids);die;
        return view('menu.create',compact('parent_ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:10|unique:menus',
//            'url'=>'required',
            'parent_id'=>'required',
            'sort'=>'required',
        ]);
        Menu::create([
            'name'=>$request->name,
            'url'=>$request->url,
            'parent_id'=>$request->parent_id,
            'sort'=>$request->sort,
        ]);
        return redirect()->route('menu.index')->with('success','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $parent_ids = $this->getChildren(Menu::all(),0);
        return view('menu.edit',compact('menu','parent_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request,[
            'name'=> ['required','max:10',Rule::unique('menus')->ignore($menu->id)],
//            'url'=>'required',
            'parent_id'=>'required',
            'sort'=>'required',
        ]);
        $menu->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'parent_id'=>$request->parent_id,
            'sort'=>$request->sort,
        ]);
        return redirect()->route('menu.index')->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        session()->flash('success','删除成功');
    }
}
