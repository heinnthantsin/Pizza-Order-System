<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','users.id','orders.user_id')
                        ->orderBy('created_at','desc')
                        ->get();
        // dd($order->toArray());
        return view('admin.order.list',compact('order'));
    }

    //sorting with ajax status
    public function changeStatus(Request $request){
        // dd($request->all());
        $order = Order::select('orders.*','users.name as user_name')
                       ->leftJoin('users','users.id','orders.user_id')
                       ->orderBy('created_at','desc');

        if($request->orderStatus == null){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->orderStatus)->get();
        }
        return view('admin.order.list',compact('order'));
    }

    //ajax change status
    public function ajaxChangeStatus(Request $request){
        $order = Order::where('id',$request->orderId)->update([
                    'status' => $request->status
                ]);

        $order = Order::select('orders.*','users.name as user_name')
                       ->leftJoin('users','users.id','orders.user_id')
                       ->orderBy('created_at','desc')
                       ->get();

        return response()->json($order,200);
    }

    //direct order list
    public function listInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        // dd($order->toArray());
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
                             ->leftJoin('users','users.id','order_lists.user_id')
                             ->leftJoin('products','products.id','order_lists.product_id',)
                             ->where('order_code',$orderCode)
                             ->get();
        // dd($orderList->toArray());
        return view('admin.order.productList',compact('orderList','order'));
    }
}
