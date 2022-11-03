<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function listPage(){

        $categories = Category::when(request('key'),function($query){
                                $query->where('name','like','%'.request('key').'%');
                                })
                                ->orderBy('id','desc')
                                ->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    // direct categroy create page
    public function createPage(){
        return view('admin.category.create');
    }

    // categoryItem Create
    public function createCategory(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('categroy#listPage')->with(['createSuccess' => 'Category Created...']);


    }

    // category delete
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Category Delete !']);
    }

    // category edit page
    public function editPage($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // category edit
    public function editItem(Request $request){
        // dd( $request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);

        return redirect()->route('categroy#listPage')->with(['updateSuccess'=>'Category Updated...']);
    }

    // category validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'.$request->categoryId,
        ],[
           'categoryName.required' => 'You Need to Fill Category Name',
        ])->validate();
    }

    // request category Data
    private function requestCategoryData($request){
        return [
            'name' => $request->categoryName
        ];
    }

}
