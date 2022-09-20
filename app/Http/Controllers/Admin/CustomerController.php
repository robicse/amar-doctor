<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Patients;
use App\Model\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customerInfos = User::where('user_type','patient')->get();
        //dd($customerInfos);
        return view('backend.admin.customer.index',compact('customerInfos'));
    }
    public function patientList($id)
    {
        $patientLists = Patients::where('user_id',$id)->get();
       //dd($patientLists);
        return view('backend.admin.customer.patientList',compact('patientLists'));
    }

    public function transaction(Request $request,$id){
        $patientLists =  Transaction::where('user_id', $id)->latest()->get();
        //dd($patientLists);
        return view('backend.admin.customer.transaction',compact('patientLists'));
    }

    public function profileShow($id)
    {

        $userInfo = User::find($id);
        if($userInfo->view == 0){
            $userInfo->view = 1;
            $userInfo->save();
        }
        return view('backend.admin.customer.profile', compact('userInfo'));
    }


    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'name' =>  'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone,'.$id,
            'email' =>  'required|email|unique:users,email,'.$id,
        ]);

        $user =  User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        Toastr::success('Customer Profile Updated Successfully','Success');
        return redirect()->back();
    }
    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' =>  'required|confirmed|min:6',
        ]);

        $user =  User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        Toastr::success('Customer Password Updated Successfully','Success');
        return redirect()->back();
    }
    public function banCustomer($id){
        $user =  User::find($id);
        $user->banned = 1;
        $user->save();
        Toastr::success('Customer has been banned Successfully','Success');
        return redirect()->back();
    }
    public function ban($id) {
        $user = User::findOrFail($id);

        if($user->banned == 1) {
            $user->banned = 0;
        } else {
            $user->banned = 1;
        }

        $user->save();
        return back();
    }
}












