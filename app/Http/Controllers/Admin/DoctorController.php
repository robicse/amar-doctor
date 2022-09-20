<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorListDataCollections;
use App\Model\SpecialistDr;


use App\Model\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index(){
        $doctors = SpecialistDr::latest()->get();
        return view('backend.admin.doctor.index',compact('doctors'));
    }
    public function show($id){
        $doctors = SpecialistDr::find($id);
        if($doctors->user->view == 0){
            $doctors->user->view = 1;
            $doctors->user->save();
        }
        //dd($doctors);
        return view('backend.admin.doctor.profile',compact('doctors'));
    }

    public function transaction($id){
        $doctor_transactions =  Transaction::where('user_id', $id)->latest()->get();
        //dd($doctor_transactions);
        return view('backend.admin.doctor.transaction',compact('doctor_transactions'));

    }

    public function update(Request $request, $id){

         //dd($request->all());
        $doctors = SpecialistDr::find($id);
        $doctors->user_id =  $request->user_id;
        $doctors->professional_derees =  $request->professional_derees;
        $doctors->bmdc =  $request->bmdc;
        $doctors->experience =  $request->experience;
        $doctors->rating =  $request->rating;
        $doctors->nid_pp_no =  $request->nid_pp_no;
        $doctors->doctor_code =  $request->doctor_code;
        $doctors->consultation_fee =  $request->consultation_fee;
        $doctors->follow_up_fee =  $request->follow_up_fee;
        $doctors->follow_up_within =  $request->follow_up_within;
        $doctors->availability =  $request->availability;
        $doctors->consultation_time =  $request->consultation_time;
        $doctors->discount_percentage =  $request->discount_percentage;

        $doctors->bank_name =  $request->bank_name;
        $doctors->mob_bank_name =  $request->mob_bank_name;
        $doctors->account_number =  $request->account_number;
        $doctors->acc_holder_name =  $request->acc_holder_name;
        $doctors->mob_bank_name =  $request->mob_bank_name;



        $doctors->save();

//        $user = User::where('id',$request->user_id)->first();
//        $user->name =  $request->name;
//        $user->save();
        return redirect()->route('admin.doctor.list');
    }
    public function updateDoctorProfile(Request $request, $id)
    {
       // dd($request->all());
    //dd($request->user_id);
        $doctors = SpecialistDr::find($id);
        $doctors->user_id =  $request->user_id;
        $doctors->save();
        $user =  User::where('id',$request->user_id)->first();
        //dd($user);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        Toastr::success('Doctor Profile Updated Successfully','Success');
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
        $doctors = SpecialistDr::find($request->id);
        $doctors->is_approved = $request->status;
        if ($doctors->save()) {
            return 1;
        }
        return 0;
    }
    public function is_active(Request $request)
    {
        $doctors = SpecialistDr::find($request->id);
        $doctors->is_active = $request->status;
        if ($doctors->save()) {
            return 1;
        }
        return 0;
    }
    public function ban($id) {
        $doctors = SpecialistDr::findOrFail($id);

        if($doctors->user->banned == 1) {
            $doctors->user->banned = 0;
        } else {
            $doctors->user->banned = 1;
        }

        $doctors->user->save();

        return back();
    }



}
