<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pozza list
    public function pizzaList(Request $request){
        // logger($request->status);
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        return response()->json($data,200);
    }

    //add to cart
    public function addToCart(Request $request){
        // logger($request->all());
        $data = $this->getOrderData($request);
        // logger($data);

        Cart::create($data);

        $response = [
            'message' => 'Add to Cart Complete',
            'status' => 'success'
        ];
        return response()->json($response, 200);
    }

    //order
    public function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);

            $total += $data->total;
        }
        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+3000,
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'Order Completed'
        ],200);
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clear current product
    public function clearCurrentProduct(Request $request){
        // logger($request->all());
        Cart::where('user_id',Auth::user()->id)
            ->where('product_id',$request->productId)
            ->where('id',$request->primaryId)
            ->delete();
    }

    //increase view count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->productId)->first();
        // logger($pizza->all());

        $viewCount = ['view_count' => $pizza->view_count + 1];
        Product::where('id',$request->productId)->update($viewCount);
    }

     //change role from admin account
    public function changeRole(Request $request){
        // logger($request->all());
        $data = [
            'role' => $request->currentRole,
            'updated_at' => Carbon::now(),
        ];

        User::where('id',$request->userId)->update($data);
    }

    //get order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
