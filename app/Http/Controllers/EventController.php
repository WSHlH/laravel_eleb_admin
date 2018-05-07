<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(5);
        return view('event.index',compact('events'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:25',
            'content'=>'required|min:5',
            'signup_start'=>'required|after:day',
            'signup_end'=>'required|after:day',
            'prize_date'=>'required|after:day',
        ]);
        Event::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num??10000,
        ]);
        return redirect()->route('event.index')->with('success','活动添加成功');
    }

    public function show(Event $event)
    {
        return view('event.show',compact('event'));
    }

    public function edit(Event $event)
    {
        return view('event.edit',compact('event'));
    }

    public function update(Request $request,Event $event)
    {
        $this->validate($request,[
            'title'=>'required|max:25',
            'content'=>'required|min:5',
            'signup_start'=>'required|after:day',
            'signup_end'=>'required|after:day',
            'prize_date'=>'required|after:day',
        ]);
        $event->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num??10000,
        ]);
        return redirect()->route('event.index')->with('success','活动修改成功');
    }

    public function destroy(Event $event)
    {
        $time = DB::table('events')->where('id',$event->id)->first()->prize_date;
        if ($time>date('Y-m-d')){
            return json_encode(0);
        }else{
            $event->delete();
            session()->flash('success','删除成功');
            return json_encode(1);
        }
    }

    public function prize(Event $prize)
    {
//        var_dump($prize);die;
        //判断该活动有无商家参与抽奖
//        $businesses = DB::table('event_businesses')->where('events_id',$prize->id)->get();
//        $shops=[];
//        foreach($businesses as $business){
//            $shops[]=$business->business_lists_id;
//        }
//        shuffle($shops);
        $businesses = DB::table('event_businesses')->where('events_id',$prize->id)->pluck('business_lists_id')->shuffle();
//        var_dump($businesses);die;
//        if ($businesses->count()==0){
        if ($businesses->count()==0){
            return redirect()->route('event.index')->with('danger','无商家参与,无法摇奖');
        }
        $prize = DB::table('event_prizes')->where('events_id',$prize->id)->first();
        $event = DB::table('events')->where('events_id',$prize->id)->first();
        if ($prize->business_lists_id==0 && $event->prize_date<=date('Y-m-d')){
            DB::table('event_prizes')->where('events_id',$prize->id)->update(['business_lists_id'=>array_pop($businesses)]);
            DB::table('events')->where('id',$prize->id)->update(['is_prize'=>1]);
            return redirect()->route('event.index')->with('success','摇奖成功');
        }else{
            return redirect()->route('event.index')->with('warning','未到开奖日期,不能摇奖');
        }

    }
}
