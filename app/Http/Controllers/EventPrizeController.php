<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventPrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventPrizes = EventPrize::orderBy('events_id')->paginate(5);
        return view('eventPrize.index',compact('eventPrizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::all();
        return view('eventPrize.create',compact('events'));
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
            'events_id'=>'required',
            'name'=>'required|max:20',
            'description'=>'required|min:5',
        ]);
        EventPrize::create([
            'events_id'=>$request->events_id,
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect()->route('eventPrize.index')->with('success','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\EventPrize  $eventPrize
     * @return \Illuminate\Http\Response
     */
    public function show(EventPrize $eventPrize)
    {
        return view('eventPrize.show',compact('eventPrize'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\EventPrize  $eventPrize
     * @return \Illuminate\Http\Response
     */
    public function edit(EventPrize $eventPrize)
    {
//        var_dump($eventPrize);die;
        $events = Event::all();
        return view('eventPrize.edit',compact('events','eventPrize'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\EventPrize  $eventPrize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventPrize $eventPrize)
    {
        $this->validate($request,[
            'events_id'=>'required',
            'name'=>'required|max:20',
            'description'=>'required|min:5',
        ]);
        $eventPrize->update([
            'events_id'=>$request->events_id,
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect()->route('eventPrize.index')->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\EventPrize  $eventPrize
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventPrize $eventPrize)
    {
        $business = DB::table('event_prizes')->where('business_lists_id',$eventPrize->business_lists_id)->first()->business_lists_id;
        if ($business==0){
            return json_encode(0);
        }else{
            $eventPrize->delete();
            session()->flash('success','删除成功');
            return json_encode(1);
        }

    }
}
