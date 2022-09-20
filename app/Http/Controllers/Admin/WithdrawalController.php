<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Withdrawal;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function pending()

    {
        $withdraw_pending_request = Withdrawal::where('status', 'pending')->latest()->get();
        //dd($withdraw_pending_request);
        return view('backend.admin.withdraw.pending', compact('withdraw_pending_request'));
    }
    public function complete()
    {
        $withdraw_complete_request = Withdrawal::where('status', 'complete')->latest()->get();
        //dd($withdraw_complete_request);

        return view('backend.admin.withdraw.complete', compact('withdraw_complete_request'));
    }
    public function reject()

    {
        $withdraw_reject_request = Withdrawal::where('status', 'reject')->latest()->get();
        //dd($withdraw_reject_request);

        return view('backend.admin.withdraw.cancle', compact('withdraw_reject_request'));
    }
    public function detailsModal(Request $request){
        $withdraw_details = Withdrawal::find($request->id);
        return view('backend.admin.withdraw.details_modal',compact('withdraw_details'));
    }
    public function changeStatus(Request $request){

        $withdraw_details = Withdrawal::find($request->id);
        if($request->status == 'complete'){
            $withdraw_details->status = 'complete';

        }
        elseif($request->status == 'reject'){
            $withdraw_details->status = 'reject';
            $user = User::find($withdraw_details->user_id);
            $user->balance += $withdraw_details->amount;
            $user->save();
            transaction($user->id,$withdraw_details->amount,$user->balance,0,'Withdraw Reject',$withdraw_details->trx,'+');
        }
        $withdraw_details->admin_feedback = $request->admin_feedback;
       // dd($withdraw_details);
        $withdraw_details->save();
        Toastr::success('status successfully changed');
        return redirect()->back();
    }

}





