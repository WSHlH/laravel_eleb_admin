<?php

namespace App\Http\Controllers;

use App\Model\BusinessList;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //统计
    public function index()
    {
//        echo '平台订单量统计<br>';
//        echo '累计';
        $count1 = DB::table('orders')->where('order_status','<>','4')->count();
//        echo $count1;
//        echo '<br>当月';
        $start = date('Y-m-01');
        $end = date('Y-m-t 23:59:59');
        $count2 = DB::table('orders')->where([
            ['order_status','<>','4'],
            ['created_at','>=',$start],
            ['created_at','<=',$end],
//            ['shop_id',$shop_id] //根据商家ID进行统计
        ])->count();
//        echo $count2;
//        echo '<br>当天';
        $start = date('Y-m-d');
        $end = date('Y-m-d 23:59:59');
        $count3 = DB::table('orders')->where([
            ['order_status','<>','4'],
            ['created_at','>=',$start],
            ['created_at','<=',$end]
        ])->count();
//        echo $count3;
//
//        echo '<hr>';
//        echo '平台菜品销量统计';
        $rows = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('business_lists','orders.shop_id','=','business_lists.id')
            ->select('business_lists.shop_name','orders.shop_id','order_goods.goods_name','order_goods.goods_id',DB::raw('sum(order_goods.amount) as amounts'))
            ->groupBy('business_lists.shop_name','orders.shop_id','order_goods.goods_id','order_goods.goods_name')
            ->orderBy('amounts','desc')
            //根据订单时间和商家id统计
//            ->where([
//                ['orders.created_at','>=',$start],
//                ['orders.created_at','<=',$end],
//                ['orders.shop_id',$shop_id]
//            ])
            ->get();
        //dd($rows);
        return view('orders.index',compact('count1','count2','count3','rows'));
    }




    public function index1()
    {
        //根据订单表 查询所有店铺id
        $shop_ids = DB::select("select shop_id from `orders` group by shop_id ");
//        var_dump($shop_ids);die;
        //根据店铺id查询  订单表  获得店铺名
        $shop = [];
        foreach($shop_ids as $shop_id){
//            var_dump($shop_id);die;
            //将每个店铺所有订单信息重新保存
            $shop[] = DB::table('orders')->where('shop_id',$shop_id->shop_id)->get();
            //将店铺名放入shop_ids
            $shop_id->shop_name = DB::select("select distinct shop_name from orders WHERE shop_id=?",[$shop_id->shop_id])[0]->shop_name;
//            var_dump($shop_id);die;
        }
//        var_dump($shop);die;
        //遍历出店铺
        foreach($shop as $item){
            $order_id=[];
            //获取订单ID
            foreach($item as $value){
                $order_id[]=$value->id;
            }
            //将订单id数组转为字符串
            $order_str = implode(',',$order_id);

            //将每日,每月,总计保存为数组

            static $days=[];static $months=[];static $totals=[];
            $days[] = DB::select("select goods_id,sum(amount) as d from order_goods WHERE order_id  in ($order_str) and created_at like ? group by goods_id order by d desc",[date('Y-m-d').'%']);
            $months[] = DB::select("select goods_id,sum(amount) as m from order_goods WHERE order_id  in ($order_str) and created_at like ? group by goods_id order by m desc",[date('Y-m').'%']);
            $totals[] = DB::select("select goods_id,sum(amount) as t from order_goods WHERE order_id  in ($order_str) group by goods_id order by t desc");
        }
//        var_dump($totals);die;
        $totals = array_filter($totals);
        $months = array_filter($months);
        $days = array_filter($days);
//        var_dump($totals);die;
        /**遍历每条数据把菜品名字写进去  start**/
        foreach ($totals as $total_val){
            foreach ($total_val as $total){
                $total->goods_id = DB::table('order_goods')->where('goods_id',$total->goods_id)->first()->goods_name;
            }
        }
        foreach ($months as $month_val){
            foreach ($month_val as $month){
                $month->goods_id = DB::table('order_goods')->where('goods_id',$month->goods_id)->first()->goods_name;
            }
        }
        foreach ($days as $day_val){
            foreach ($day_val as $day){
                $day->goods_id = DB::table('order_goods')->where('goods_id',$day->goods_id)->first()->goods_name;
            }
        }
//        var_dump($totals);die;
        /**遍历每条数据把菜品名字写进去  end**/

        /**统计出总计的数量  start**/
        $totalCount = 0;
        $monthCount = 0;
        $dayCount = 0;
        $totalCount += DB::select("select sum(amount) as t from `order_goods`")[0]->t;
        $monthCount += DB::select("select sum(amount) as m from `order_goods` where created_at like ?",[date('Y-m').'%'])[0]->m;
        $dayCount += DB::select("select sum(amount) as d from `order_goods` where created_at like ?",[date('Y-m-d').'%'])[0]->d;
        /**统计出总计的数量  start**/
//        dd($totalCount,$monthCount,$dayCount);
//var_dump($totals);die;
//        dd($shop_ids,$day,$month,$total);
        return view('orders.index',compact('shop_ids','totals','months','days','totalCount','monthCount','dayCount'));
    }

    public function store(Request $request)
    {
//        var_dump($request->datetime1);die;
        //获取所有店铺id
        $shop_ids = DB::select("select shop_id from orders group by shop_id");
        //根据店铺id获取店铺名,并重新保存
        $shop=[];
        foreach($shop_ids as $shop_id){
            $shop[]=DB::table('orders')->where('shop_id',$shop_id->shop_id)->get();
            $shop_id->shop_name = DB::select("select distinct shop_name from orders WHERE shop_id=?",[$shop_id->shop_id])[0]->shop_name;
        }
//        var_dump($shop_ids);die;
        //遍历店铺,获取订单id
        foreach($shop as $value){
            $order_id = [];
            foreach($value as $item){
                $order_id[]=$item->id;
            }
            $str = implode(',',$order_id);
            static $count=[];
            if ($request->datetime1==null or $request->datetime2==null){
                return back()->withInput()->with('warning','请输入要搜索的日期');
            }
            if($request->datetime1!=null and $request->datetime2!=null){
                $date = $request->datetime1;
                $date1 = $request->datetime2;
                $count[] = DB::select("select goods_id,sum(amount) as d from `order_goods` where order_id in ($str) and created_at between ? and ? GROUP by `goods_id` order BY d desc",[$date,$date1]);
        }
//        var_dump($str);die;
            }
        $count = array_filter($count);
        foreach ($count as $value){
            foreach($value as $val){
                $val->goods_id = DB::table('order_goods')->where('goods_id',$val->goods_id)->first()->goods_name;
            }
        }
//        var_dump($count);die;
        return view('orders.sale',compact('shop_ids','count'));
    }







//    public function show(Order $order)
//    {
////        var_dump($order->id);die;
//        //查询所有订单
//        $orders = Order::where('shop_id',$order->id)->paginate(8);
////        var_dump($orders);die;
//        return view('order.show',compact('orders'));
//    }
//
//    public function edit(Order $order)
//    {
//        $shop_id = $order->id;
//        $orders = Order::where('shop_id',$shop_id)->get();
//        $ids = [];
//        foreach ($orders as $row){
//            $ids[] = $row->id;
//        }
//        $str = implode(',',$ids);
////        var_dump($order->id);die;
//        $total = DB::select("select goods_id,sum(amount) as total from `order_goods` where order_id in ($str) GROUP by `goods_id` order BY total desc");
//        $month = DB::select("select goods_id,sum(amount) as m from `order_goods` WHERE order_id in ($str) and created_at like ? GROUP by `goods_id` order BY m desc",[date('Y-m').'%']);
//        $day = DB::select("select goods_id,sum(amount) as d from `order_goods` where order_id  in ($str) and created_at like ? GROUP by `goods_id` order BY d desc",[date('Y-m-d').'%']);
////        var_dump($month);die;
//        return view('order.orders',compact('total','month','day'));
//    }
//
//    public function store(Request $request)
//    {
//        var_dump($request->id);die;
//        $shop_id = $request->id;
//        $orders = Order::where('shop_id',$shop_id)->get();
//        $ids = [];
//        foreach ($orders as $row){
//            $ids[] = $row->id;
//        }
//        $str = implode(',',$ids);
//        if ($request->date==null and $request->month==null and ($request->datetime1==null or $request->datetime2==null)){
//            return back()->withInput()->with('warning','请输入要搜索的日期');
//        }
//        if ($request->date!=null){
//            $date = $request->date;
//            $count = DB::select("select goods_id,sum(amount) as d from `order_goods` where order_id in ($str) and created_at like ? GROUP by `goods_id` ORDER by d desc",[$date.'%']);
//        }
//        elseif ($request->month!=null){
//            $date = $request->month;
//            $count = DB::select("select goods_id,sum(amount) as d from `order_goods` WHERE order_id in ($str) and created_at like ? GROUP by `goods_id` order BY d desc",[$date.'%']);
//        }
//        elseif($request->datetime1!=null and $request->datetime2!=null){
//            $date = $request->datetime1;
//            $date1 = $request->datetime2;
//            $count = DB::select("select goods_id,sum(amount) as d from `order_goods` where order_id in ($str) and created_at between ? and ? GROUP by `goods_id` order BY d desc",[$date,$date1]);
//        }
//        return view('order.sale',compact('count'));
//    }

}
