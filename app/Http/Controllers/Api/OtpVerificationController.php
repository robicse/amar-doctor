<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Model\VerificationCode;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OtpVerificationController extends Controller
{
    public function OtpSend(Request $request)
    {
        //return 'ok';
        $verification = VerificationCode::where('phone',$request->phone)->where('status',0)->first();
        if (!empty($verification)){
            $text = $verification->code. " is your One-Time Password (OTP) for Doctor Pathao. Enjoy with Doctor Pathao.";
//        echo $text;exit();
            UserInfo::smsAPI("88".$verification->phone,$text);
            return response()->json([
                'message' => 'OTP successfully sent to user'
            ], 401);
        }else{
            return response()->json([
                'message' => 'Phone Number does not match or this number already verified!!'
            ], 401);
        }

    }

    public function OtpCheck(Request $request)
    {
        //return $request->all();
        $verification = VerificationCode::where('phone',$request->phone)->where('status',0)->where('code',$request->code)->first();
        if (!empty($verification)){
            $verification->status = 1;
            $verification->save();
            if ($request->isRegistration == 1){
                //dd($request->isRegistration);
                //$user = User::where('phone',$request->phone)->where('banned',1)->first();
                $user = User::where('phone',$request->phone)->first();
                $user->banned = 0;
                $user->save();
            }
            if (!empty($verification)) {
                return response()->json([
                    'message' => 'OTP Checked successfully 1'
                ], 201);
            }
        }else{
            return response()->json([
                'message' => 'OTP Code does not match!!'
            ], 401);
        }

    }

}
