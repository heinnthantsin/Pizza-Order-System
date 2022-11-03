<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    // changePassword
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::where('id',Auth::user()->id)->first();
        // dd($user->toArray());
        $hashedValue = $user->password;
        // dd($hashValue);
        if(Hash::check($request->oldPassword, $hashedValue)){
            $data = [ 'password' => Hash::make($request->newPassword) ];
            User::where('id',Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage');

        }else{
            return back()->with(['notMatch'=>'The Old Password is not correct ! Try Again']);
        }
    }

    //direct main details page
    public function details(){
        return view('admin.account.details');
    }

    //account editPage
    public function editPage(){
        return view('admin.account.edit');
    }

    //account update
    public function updateAccount($id,Request $request){
        // dd($request->all());
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage  = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName =  uniqid() .$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;


        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Account Updated...']);
    }
    //admin list
    public function list(){
        $admins = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%');
            $query->orWhere('email','like','%'.request('key').'%');
            $query->orWhere('phone','like','%'.request('key').'%');
            $query->orWhere('address','like','%'.request('key').'%');
            $query->orWhere('gender','like','%'.request('key').'%');
        })
        ->where('role','admin')->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.list',compact('admins'));
    }

    //admin acount delete
    public function delete($id){
      User::where('id',$id)->delete();
      return back()->with(['deleteSuccess' => 'Admin Account Deleted']);
    }

    //change Role page
    public function changeRolePage($id){
       $account =  User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //change role
    public function changeRole($id,Request $request){
        $data = [ 'role' => $request->role ];

       User::where('id',$id)->update($data);
       return redirect()->route('admin#list');
    }


    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }

    // request userdata
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ];
    }

    //accountUpdate validation
    private function accountValidationCheck($request){
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'gender' => 'required',
        ])->validate();
    }
}
