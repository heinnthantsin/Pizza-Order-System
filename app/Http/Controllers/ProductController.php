<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct product list page
    public function productListPage(){
        $pizzas = Product::select('products.*','categories.name as category_name')
                ->when(request('key'),function($query){
                  $query->where('name','like','%'.request('key').'%');
                })
                ->leftJoin('categories','products.category_id','categories.id')
                ->orderBy('products.created_at','desc')
                ->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //direct create pizza page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    //create pizza
    public function createPizza(Request $request){
        $this->productionValidationCheck($request,"create");
        $data = $this->getPizzaData($request);

        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#listPage')->with(['createSuccess'=>'Product Created...']);
    }

    //delete Pizza
    public function deletePizza($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#listPage')->with(['deleteSuccess'=>'Product Deleted...']);
    }

    //pizza details page
    public function detailPizzaPage($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                 ->leftJoin('categories','products.category_id','categories.id')
                 ->where('products.id',$id)->first();
        return view('admin.product.productDetail',compact('pizza'));
    }

    //edit pizza page
    public function editPizzaPage($id){
        $pizza = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.product.edit',compact('pizza','categories'));
    }

    //update pizza
    public function updatePizza(Request $request){
        $this->productionValidationCheck($request,"update");
        $data = $this->getPizzaData($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public/',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#listPage')->with(['updateSuccess'=>'Updated Successfully...']);
    }



    //get create pizza data
    private function getPizzaData($request){
        return [
            'name' => $request->pizzaName,
            'category_id' => $request->pizzaCategory,
            'description' => $request->pizzaDescription,
            'waiting_time'=> $request->waitingTime,
            'price' => $request->pizzaPrice
        ];
    }

    //product create validation
    private function productionValidationCheck($request,$action){
        $validationRules = [
            'pizzaName'=>'required|min:4|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription' => 'required',
            'waitingTime' => 'required',
            'pizzaPrice'=>'required',
        ];

        $validationRules['pizzaImage'] = $action == "create"? 'required|mimes:jpg,jpeg,png,webp|file':'mimes:jpg,jpeg,png,webp|file';

        Validator::make($request->all(),$validationRules)->validate();
    }

}
