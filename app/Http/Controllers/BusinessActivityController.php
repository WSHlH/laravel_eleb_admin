<?php

namespace App\Http\Controllers;

use App\Model\BusinessActivity;
use Illuminate\Http\Request;

class BusinessActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $current = date('Y-m-d');where('end','>',$current)->
        $businessActivities = BusinessActivity::orderBy('end')->paginate(5);
        return view('businessActivity.index',compact('businessActivities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('businessActivity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //检测
        $this->validate($request,[
            'title'=>'required|min:3|max:20',
            'content'=>'required|min:10|max:150',
            'start'=>'required|date|after:today',
            'end'=>'required|date|after:today',
        ]);
        BusinessActivity::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'start'=>$request->start,
            'end'=>$request->end,
        ]);
        session()->flash('success','保存成功!');
        return redirect()->route('businessActivity.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\BusinessActivity  $businessActivity
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessActivity $businessActivity)
    {
        return view('businessActivity.show',compact('businessActivity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\BusinessActivity  $businessActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessActivity $businessActivity)
    {
//        var_dump($businessActivity);die;
        return view('businessActivity.edit',compact('businessActivity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\BusinessActivity  $businessActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessActivity $businessActivity)
    {
        //检测
        $this->validate($request,[
            'title'=>'min:3|max:20',
            'content'=>'min:10|max:150',
            'start'=>'date|after:today',
            'end'=>'date|after:today',
        ]);
        $businessActivity->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'start'=>$request->start,
            'end'=>$request->end,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('businessActivity.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\BusinessActivity  $businessActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessActivity $businessActivity)
    {
        $current = date('Y-m-d');
        if ($businessActivity->end>$current){
//            session()->flash('warning','活动时间未截止,无法删除!');
            echo json_encode(0);
        }else{
            $businessActivity->delete();
            session()->flash('success','删除成功!');
            echo json_encode(1);
        }
    }
}
