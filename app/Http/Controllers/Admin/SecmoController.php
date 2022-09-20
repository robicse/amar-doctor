<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\SecmoDr;
use App\Model\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecmoController extends Controller
{
    public function index(){
        $doctors = SecmoDr::latest()->get();
        return view('backend.admin.doctor_secmo.index',compact('doctors'));
    }
    public function show($id){
        $doctors = SecmoDr::find($id);
        if($doctors->user->view == 0){
            $doctors->user->view = 1;
            $doctors->user->save();
        }
        // dd($doctors);
        return view('backend.admin.doctor_secmo.profile',compact('doctors'));
    }
    public function transaction($id){
        $doctor_transactions =  Transaction::where('user_id', $id)->latest()->get();
       // dd($doctor_transactions);
        return view('backend.admin.doctor_secmo.transaction',compact('doctor_transactions'));
    }

    public function updateDoctorProfile(Request $request, $id)
    {
        // dd($request->all());
        //dd($request->user_id);
        $doctors = SecmoDr::find($id);
        $doctors->user_id =  $request->user_id;
        $doctors->save();
        $user =  User::where('id',$request->user_id)->first();
        //dd($user);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        Toastr::success('Secmo Doctor Profile Updated Successfully','Success');
        return redirect()->back();
    }
    public function updatePassword(Request $request, $id)
    {
// dd($request->all());
        $hashedPassword = $request->password_confirmation;
        if ($request->password == $hashedPassword) {
            $user = \App\User::find($request->user_id);
            $user->password = Hash::make($hashedPassword);
            $user->save();
            Toastr::success('Password Updated Successfully','Success');
            return redirect()->back();
        } else {
            Toastr::error('Password Does Not Match.', 'Error');
            return redirect()->back();
        }
    }
    public function is_approved(Request $request)
    {
        $doctors = SecmoDr::find($request->id);
        $doctors->is_approved = $request->status;
        if ($doctors->save()) {
            return 1;
        }
        return 0;
    }
    public function is_active(Request $request)
    {
        $doctors = SecmoDr::find($request->id);
        $doctors->is_active = $request->status;
        if ($doctors->save()) {
            return 1;
        }
        return 0;
    }
    public function ban($id) {
        //  dd('dd');
        $doctors = SecmoDr::findOrFail($id);

        if($doctors->user->banned == 1) {
            $doctors->user->banned = 0;
        } else {
            $doctors->user->banned = 1;
        }

        $doctors->user->save();

        return back();
    }


}


