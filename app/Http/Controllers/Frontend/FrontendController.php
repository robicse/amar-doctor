<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\Prescriptions;
use App\Model\SpecialistDr;
use App\Model\TelemedicineRequest;
use App\Model\VerificationCode;
use App\User;
use PDF;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->take(3)->get();
        $doctors = SpecialistDr::where('is_active',1)->where('is_online',1)->take(4)->get();
        return view('frontend.index',compact('blogs','doctors'));
    }

    public function details($title){
        $doctors = SpecialistDr::where('title',$title)->first();
        $allDoctors = SpecialistDr::where('is_active',1)->where('is_online',1)->get();
        //dd($doctors);

        return view('frontend.pages.doctor_details.',compact('doctors','allDoctors'));
    }



    public function register(Request $request) {
        $this->validate($request, [
            'name' =>  'required',
            'email' =>  'required|email|unique:users,email',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users',
            'password' => 'required|min:6',
        ]);
        $phn1 = (int)$request->phone;
        $check = User::where('phone',$phn1)->first();
        if (!empty($check)){
            Toastr::error('This phone number already exist');
            return back();
        }
        $userReg = new User();
        $userReg->name = $request->name;
        $userReg->email = $request->email;
        $userReg->phone= $request->phone;
        $userReg->password = Hash::make($request->password);
        $userReg->user_type = 'customer';
        $userReg->banned = 1;
        $userReg->save();
//        dd($userReg);

        Session::put('phone',$request->phone);
        Session::put('password',$request->password);
        Session::put('user_type','customer');

        Toastr::success('Your registration successfully done!');
        return redirect()->route('get-verification-code',$userReg->id);
//        return redirect()->route('user.dashboard');
    }
    public function getPhoneNumber(){
        return view('auth.password_verification.check_phone_number');
    }

    public function checkPhoneNumber(Request $request){
        $user = User::where('phone',$request->phone)->first();
        if (!empty($user)) {
            $verification = VerificationCode::where('phone',$user->phone)->first();
            if (!empty($verification)){
                $verification->delete();
            }
            $verCode = new VerificationCode();
            $verCode->phone = $user->phone;
            $verCode->code = mt_rand(1111,9999);
            $verCode->status = 0;
            $verCode->save();
            $text = "Dear ".$user->name.", Your Mudi Hat OTP is ".$verCode->code;
//        echo $text;exit();
            UserInfo::smsAPI("88".$verCode->phone,$text);
            Toastr::success('Thank you for your registration. We send a verification code in your mobile number. please verify your phone number.' ,'Success');
            return view('auth.password_verification.verification_code',compact('verCode'));
        }else{
            Toastr::error('This phone number does not exist to the system');
            return redirect()->back();
        }
    }
    public function otpStore(Request $request) {
        if ($request->isMethod('post')){
            $check = VerificationCode::where('code',$request->code)->where('phone',$request->phone)->where('status',0)->first();
            if (!empty($check)) {
                $check->status = 1;
                $check->update();
                $user = User::where('phone',$request->phone)->first();
                $user->verification_code = $request->code;
                $user->banned = 0;
                $user->save();
                Toastr::success('Your phone number successfully verified.' ,'Success');
                return view('auth.password_verification.reset_password',compact('user'));
            }else{
                //$verCode = $request->phone;
                $verCode = VerificationCode::where('phone',$request->phone)->where('status',0)->first();
                Toastr::error('Invalid Code' ,'Error');
                return view('auth.password_verification.verification_code',compact('verCode'));
            }
        }
    }
    public function passwordUpdate(Request $request, $id) {
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        Toastr::success('Your Password Updated successfully verified.' ,'Success');
        return redirect()->route('login');
    }

    public function prescriptionDownload($id) {
        $prescription = Prescriptions::find($id);
        $pdf = PDF::setOptions([
            //'defaultFont' => 'Kalpurush',
            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/'),
            'defaultPaperSize'=> "a4"

        ])->loadView('backend.admin.prescription.show', compact('prescription'));
        return $pdf->download('prescription_'.$id.'.pdf');
    }

    public function invoiceDownload($id) {
        //dd($id);
        $telemedicine_invoice = TelemedicineRequest::find($id);
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
            'logOutputFile' => storage_path('logs/log.html'),
            'tempDir' => storage_path('logs/'),
            'defaultPaperSize'=> "a4"
        ])->loadView('backend.admin.service_invoice.show', compact('telemedicine_invoice'));
        return $pdf->download('telemedicine_invoice_'.$telemedicine_invoice->code.'.pdf');
    }
    public function smsApiCheck() {
        $text = " is your One-Time Password (OTP) for Doctor Pathao. Enjoy with Doctor Pathao ";
        UserInfo::smsAPI("8801723144515",$text);
        return 'ooooook';
    }




}
