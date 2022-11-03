<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
       $products =  Product::get();
       return response()->json($products,200);
    }

    //get all user
    public function userList(){
        $users = User::get();
        $category = Category::get();
        $data = [
            'users' => $users,
            'category' => $category
        ];
        return response()->json($data, 200);
    }

    // create category
    public function createData(Request $request){
        // logger($request->all());
        $data = [
            'name' => $request->name,
            'product_name' => $request->product_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $res = Category::create($data);
        return response()->json($res, 200);
    }

    // create contact
    public function createContact(Request $request){

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $contact = Contact::orderBy('created_at','desc')->get();

        return response()->json($contact, 200);
    }

    // create user
    public function createUser(Request $request){
        $user = $this->getUserData($request);
        User::create($user);

        return response()->json([
            'status' => true,
            'message' => 'User Created',
            'Created User' => $user['name']
        ],200);
    }

    // get userData
    private function getUserData($request){
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'role' => $request->role,
            'password' => $request->password,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        return $userData;
    }

    // delete category with get method
    public function deleteCategory($id){
       $categoryId = Category::where('id',$id)->first();

       if(isset($categoryId)){
         Category::where('id',$id)->delete();

         return response()->json(
            [
                'status' => true,
                'message' => 'Category Deleted',
                'Deleted CategoryId' => $categoryId
            ]
            );
       }else{
          return response()->json(['status'=> false ,'message' => 'there is no Id here'],200);
       }

    }

    // delete user with post method
    public function deleteUser(Request $request){
        $user = User::where('id',$request->id)->get();

        if(!empty($user)){
            User::where('id',$request->id)->delete();
            return response()->json(
                [
                    'status' => true,
                    'message' => 'User Deleted',
                    'Deleted User' => $user
                ],200
                );
        }else{
            return response()->json(['status'=>false,'message'=>'There is no user'],200);
        }
    }

    // product details
    public function productDetails(){
        $data = Product::get();
        return response()->json([
            'status' => true,
            'message' => $data
        ],200);
    }

    //update category
    public function productDetail($id){
        $product = Product::where('id',$id)->first();

        if(isset($product)){
            return response()->json([
                'status' => true,
                'product' => $product
            ],200);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'There is no product with this ID'
            ],200);
        }
    }

    // user update
    public function updateUser(Request $request){

        $userId = $request->user_id;
        // return dd($userId);
        $dbSource = User::where('id',$userId)->first();
        // return dd($dbSource);
        if(isset($dbSource)){
            $data = $this->getUpdateData($request);
            User::where('id',$userId)->update($data);
            return response()->json([
                'status' => true,
                'message' => ' UserData was updated...',
                'Updated Data' => $data
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'There is no User Id for updating',
            ],500);
        }
    }

    //get updateData
    public function getUpdateData($request){
        return [
            'name' => $request->updated_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
