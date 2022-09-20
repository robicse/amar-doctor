<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\DeliveryMan;
use App\Model\DeliveryManRequest;
use App\Model\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeliveryController extends Controller
{
    public function index(){
        $delivery_mans = DeliveryMan::latest()->get();
       // dd($delivery_mans);
        return view('backend.admin.delivery_man.index',compact('delivery_mans'));
    }
    public function show($id){
        $delivery_mans = DeliveryMan::find($id);
        if($delivery_mans->user->view == 0){
            $delivery_mans->user->view = 1;
            $delivery_mans->user->save();
        }
        //dd($delivery_mans);
        return view('backend.admin.delivery_man.profile',compact('delivery_mans'));
    }
    public function transaction($id){
        $delivery_mans =  Transaction::where('user_id', $id)->latest()->get();
        //dd($delivery_mans);
        return view('backend.admin.delivery_man.transaction',compact('delivery_mans'));
    }

    public function updateDeliveryManProfile(Request $request, $id)
    {
        // dd($request->all());
        //dd($request->user_id);
        $delivery_mans = DeliveryMan::find($id);
        $delivery_mans->user_id =  $request->user_id;
        $delivery_mans->save();
        $delivery_mans =  User::where('id',$request->user_id)->first();
        //dd($user);
        $delivery_mans->name = $request->name;
        $delivery_mans->email = $request->email;
        $delivery_mans->phone = $request->phone;
        $delivery_mans->save();
        Toastr::success('Delivery MAn Profile Updated Successfully','Success');
        return redirect()->back();
    }
    public function updatePassword(Request $request, $id)
    {

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
    public function pending()
    {
        $delivery_man_pending_request = DeliveryManRequest::where('status','pending')->latest()->get();
        return view('backend.admin.delivery_man.pending',compact('delivery_man_pending_request'));
    }
    public function processing()
    {
        $delivery_man_processing_request = DeliveryManRequest::where('status','processing')->latest()->get();
        return view('backend.admin.delivery_man.processing',compact('delivery_man_processing_request'));
    }
    public function complete()
    {
        $delivery_man_complete_request = DeliveryManRequest::where('status','complete')->latest()->get();
        return view('backend.admin.delivery_man.complete',compact('delivery_man_complete_request'));
    }
    public function cancle()
    {
        $delivery_man_cancle_request = DeliveryManRequest::where('status','cancel')->latest()->get();
        return view('backend.admin.delivery_man.cancle',compact('delivery_man_cancle_request'));
    }
    public function requestShow($id)
    {
        $delivery_man_show_request = DeliveryManRequest::where('id',$id)->first();
        return view('backend.admin.delivery_man.show',compact('delivery_man_show_request'));


    }

    public function is_approved(Request $request)
    {
        $delivery_mans = DeliveryMan::find($request->id);
        $delivery_mans->is_approved = $request->status;
        if ($delivery_mans->save()) {
            return 1;
        }
        return 0;
    }
    public function is_active(Request $request)
    {
        $delivery_mans = DeliveryMan::find($request->id);
        $delivery_mans->is_active = $request->status;
        if ($delivery_mans->save()) {
            return 1;
        }
        return 0;
    }

    public function ban($id) {
        $delivery_mans = DeliveryMan::findOrFail($id);

        if($delivery_mans->user->banned == 1) {
            $delivery_mans->user->banned = 0;
        } else {
            $delivery_mans->user->banned = 1;
        }

        $delivery_mans->user->save();

        return back();
    }

}
