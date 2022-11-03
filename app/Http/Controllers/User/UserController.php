<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;

class UserController extends Controller
{
    //direct home page
    public function homePage(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        // dd(count($cart));
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //direct change password Page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    // change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['changeSuccess' => 'password changed successfully...']);
        }else{
            return back()->with(['notMatch'=>'Old Password is not Matched...Try Again !']);
        }
    }

    // user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //USER ACCOUNT INFO CHANGE
    public function accountChange($id,Request $request){
        // dd($id,$request->all());
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;

        }

        User::where('id',$id)->update($data);
        return back()->with(['successChange' => 'User Account Updated...']);

    }

    //FILTER PIZZA
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    // direct pizza details
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //direct to cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();
        // dd($cartList);

        $totalPrice = 0;
        foreach ($cartList as $c) {
           $totalPrice +=  $c->pizza_price*$c->qty;
        }

        // dd($totalPrice);
        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    // direct history page
    public function historyPage(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }

      //direct user list page
    public function userList(){
        $users = User::when(request('key'),function($query){
                    $query->where('name','like','%'.request('key').'%');
                })
                ->where('role','user')
                ->paginate(5);
        return view('admin.user.userList',compact('users'));
    }

    // change status
    public function changeRole(Request $request){
        // logger($request->all());
        User::where('id',$request->userId)->update(['role' => $request->role]);
    }

    public function deleteUser($id){
        // dd($id);
        User::where('id',$id)->delete();
        return redirect()->route('user#listPage')->with(['deleteSuccess' => 'User Deleted...']);
    }

    //contact page
    public function contactPage(Request $request){
        $messages = Contact::get();
        return view('admin.user.contactPage',compact('messages'));
    }

    //contact form
    public function contactForm(){
        return view('user.contact.contactPage');
    }

    //message submit
    public function sendMessage(Request $request){
        $this->messageValidationCheck($request);
        $data = $this->getMessages($request);
        Contact::create($data);
        return redirect()->route('user#homePage')->with(['successSend' => 'Message Delivered...Thanks For Your Feedback']);
    }


    // change password validationcheck
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }

    //account validation
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp|file'
        ])->validate();
    }

    //get user data
    private function getUserData($request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'created_at'=>Carbon::now()
        ];

        return $data;
    }

    private function messageValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ])->validate();
    }

    private function getMessages($request){
        $messages = [
            'name' => $request->name,
            'email' => $request->email,
            'message'=> $request->message
        ];
        return $messages;
    }
}
