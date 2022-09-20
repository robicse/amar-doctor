<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommonProfileCollections;
use App\Http\Resources\UserProfileCollections;
use App\Model\BusinessSetting;
use App\Model\DeliveryMan;
use App\Model\SecmoDr;
use App\Model\SpecialistDr;
use App\Model\VerificationCode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    public $successStatus = 201;
    public $failStatus = 401;
    public function login(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
            'password' => 'required',
        ]);
        $credentials = [
            'phone' => $request->phone,
            'password' => $request->password,
            'banned' => 0,
        ];
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('Doctor Pathao')-> accessToken;
            $success['user'] = $user;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Unauthorised'], 401);
        }
    }

    //========================== patient registration  ============================//
    public function register(Request $request)
    {
        //dd(mobileVerification($request->phone));
       $this->validate($request,[
           'email' => 'email|unique:users',
           'phone' => 'required|min:11|numeric|unique:users',
           'district_id'=> 'required',
           'password'=> 'required',
        ]);
        $userReg = new User();
        $userReg->name = $request->name;
        $userReg->email = $request->email;
        $userReg->phone = $request->phone;
        $userReg->password = Hash::make($request->password);
        $userReg->user_type = 'patient';
        $userReg->gender = $request->gender;
        $userReg->dob = $request->dob;
        $userReg->district_id = $request->district_id;
        $userReg->view = 0;
        $userReg->banned = 0;
        $userReg->save();

        if (!empty($userReg)){
            //for mobile verification
            mobileVerification($userReg);
            $success['token'] = $userReg->createToken('Doctor Pathao')-> accessToken;
            $success['details'] = $userReg;
            return response()->json(['success'=>true,'response' =>$success], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }
    //========================== Logout  ============================//
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function userDetails()
    {
        return new  UserProfileCollections(User::where('id',Auth::id())->get());
    }
    public function userImageGet($userId)
    {
        //dd($id);
        $userImage = User::find($userId);
        if (!empty($userImage)){
            return response()->json(['success'=>true,'response' =>'/uploads/profile/'.$userImage->avatar_original], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }
    public function userProfileUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:users,email,'.$id,
            'district_id' => 'required'
        ]);
        $userReg =  User::find($id);
        $userReg->name = $request->name;
        $userReg->email = $request->email;
        $userReg->gender = $request->gender;
        $userReg->dob = $request->dob;
        $userReg->district_id = $request->district_id;
        $userReg->save();
        if (!empty($userReg)){
            //$userData = new UserProfileCollections(User::where('id',$userReg->id)->get());
            return response()->json(['success'=>true,'response' =>$userReg], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }

    //================================== change password ======================================//
    public function changePass(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required'
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(['success'=>true,'response' => 'Password Updated Successfully'], $this->successStatus);
            } else {
                return response()->json(['success'=>false,'response' => 'New password cannot be the same as old password.'], $this->failStatus);
            }
        } else {
            return response()->json(['success'=>false,'response' => 'Current password not match.' ], $this->failStatus);
        }

    }
    public function forgetPassCheck(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
        ]);
        $user = User::where('phone', $request->phone)->first();
        if (!empty($user)){
            mobileVerification($user);
            return response()->json(['success'=>true,'response' => 'otp successfully send!'], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' => 'Your entered mobile number does not exist in our system.' ], $this->failStatus);
        }
    }
    public function CreateNewPass(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('phone', $request->phone)->first();
        $user->password = Hash::make($request->password);
        if ($user->save()){
            return response()->json(['success'=>true,'response' => 'Password changed successfully'], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' => 'Something went wrong!' ], $this->failStatus);
        }
    }

    //specialist doctor, SACMO doctor and delivery man login....
    public function serviceProviderLogin(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required',
            'password' => 'required',
        ]);
        $credentials = [
            'phone' => $request->phone,
            'password' => $request->password,
            'banned' => 0,
        ];
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('Doctor Pathao')-> accessToken;
            $success['user_type'] = $user->user_type;
            $success['is_profile_complete'] = $user->is_profile_complete;
            if ($user->user_type == 'specialist_dr'){
                $success['is_approved'] = SpecialistDr::where('user_id', $user->id)->first()->is_approved;
            } elseif ($user->user_type == 'secmo_dr') {
                $success['is_approved'] = SecmoDr::where('user_id', $user->id)->first()->is_approved;
            } elseif ($user->user_type == 'delivery_man') {
                $success['is_approved'] = DeliveryMan::where('user_id', $user->id)->first()->is_approved;
            }
            $success['userFullData'] = new CommonProfileCollections(User::where('id',$user->id)->get());

            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Unauthorised'], 401);
        }
    }

}
