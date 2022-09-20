<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonProfileCollections;
use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\Model\SecmoDr;
use App\Model\SpecialistDr;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Database;

class DoctorAuthController extends Controller
{
    public $successStatus = 201;
    public $failStatus = 401;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function specialistDocReg(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'email' => 'email|unique:users',
            'phone' => 'required|min:11|numeric|unique:users',
            'bmdc' => 'required|unique:specialist_drs',
            'title' => 'required',
        ]);

        $userReg = new User();
        $userReg->name = $request->name;
        $userReg->email = $request->email;
        $userReg->phone = $request->phone;
        $userReg->password = Hash::make($request->password);
        $userReg->user_type = "specialist_dr";
        $userReg->gender = $request->gender;
        $userReg->dob = $request->dob;
        $userReg->district_id = 1;
        $userReg->view = 0;
        $userReg->banned = 1;
        $userReg->save();
        if ($userReg !== null){
            $specialistDr = new SpecialistDr();
            $specialistDr->user_id = $userReg->id;
            $specialistDr->bmdc = $request->bmdc;
            $specialistDr->title = $request->title;
            $specialistDr->doctor_code = 'DP'.mt_rand(111111,999999);
            $specialistDr->save();
        }
        if ($userReg !== null){
            //for mobile verification
            mobileVerification($userReg);
            $postData = [
                'specialist_dr_id' => $specialistDr->id,
                'is_online' =>0,
            ];
            $dataPostFirebase = $this->database->getReference('spdrstatus')->push($postData);
            if (!$dataPostFirebase){
                return response()->json(['success'=>false,'response' =>'Something went wrong in firebase!'], $this->failStatus);
            }

            $success['token'] = $userReg->createToken('Doctor Pathao')-> accessToken;
            $success['details'] = $userReg;
            return response()->json(['success'=>true,'response' =>$success], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }

    public function doctorRegisterDetailsData(Request $request)
    {
        $userReg =  User::find($request->user_id);
        $image = $request->file('avatar_original');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/profile/',0);
        }else {
            $imagename = "default.png";
        }
        $userReg->avatar_original = $imagename;

        //nid front
        $image = $request->file('nid_pp_front');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/nid/',0);
        }else {
            $imagename = "default.png";
        }
        $userReg->nid_pp_front = $imagename;
        //nid back side
        $image2 = $request->file('nid_pp_back');
        if (isset($image2)) {
            $imagename2 = imageUpload($image2, 'uploads/nid/',0);
        }else {
            $imagename2 = "default.png";
        }
        $userReg->nid_pp_back = $imagename2;
        $userReg->is_profile_complete = $request->is_profile_complete;
        $userReg->save();

        if (!empty($userReg)){
            $specialistDr =  SpecialistDr::where('user_id', $userReg->id)->first();
            $specialistDr->professional_derees = $request->professional_derees;
            $specialistDr->experience = $request->experience;
            $specialistDr->current_employment = $request->current_employment;
            $specialistDr->consultation_fee = $request->consultation_fee;
            $specialistDr->is_followup = $request->is_followup;
            if ($request->follow_up_fee == null){
                $specialistDr->follow_up_fee = 0;
            }else{
                $specialistDr->follow_up_fee = $request->follow_up_fee;
            }
            if ($request->discount_percentage == null){
                $specialistDr->discount_percentage = 0;
            }else{
                $specialistDr->discount_percentage = $request->discount_percentage;
            }
            $specialistDr->discount_expiry = $request->discount_expiry;
            $specialistDr->follow_up_within = $request->follow_up_within;
            $specialistDr->availability = $request->availability;
            $specialistDr->consultation_time = $request->consultation_time;
            $specialistDr->consultation_duration = $request->consultation_duration;
            $specialistDr->bank_name = $request->bank_name;
            $specialistDr->bank_branch = $request->bank_branch;
            $specialistDr->bank_routing_number = $request->bank_routing_number;
            $specialistDr->acc_holder_name = $request->acc_holder_name;
            $specialistDr->account_number = $request->account_number;
            $specialistDr->mob_bank_name = $request->mob_bank_name;
            $specialistDr->mob_bank_number = $request->mob_bank_number;
            $specialistDr->save();
            if (!empty($specialistDr)){
                if (isset($request->specialities_id) ){
                    foreach ($request->specialities_id as $drSData){
                        $drSpecialities = new DrSpecialist();
                        $drSpecialities->specialities_id = $drSData;
                        $drSpecialities->specialist_dr_id = $specialistDr->id;
                        $drSpecialities->save();
                    }
                }
            }
        }
        if (!empty($specialistDr)){
            $experiencesInfosArr = json_decode($request->experiencesInfos);
            if ($experiencesInfosArr) {
                foreach ($experiencesInfosArr as $experienceInfo){
                    $experience = new Experience();
                    $experience->specialist_dr_id = $specialistDr->id;
                    $experience->department = $experienceInfo->department;
                    $experience->institute_name = $experienceInfo->institute_name;
                    $experience->designation = $experienceInfo->designation;
                    $experience->employment_period_from = $experienceInfo->employment_period_from;
                    $experience->employment_period_to = $experienceInfo->employment_period_to;
                    $experience->period = '';
                    $experience->save();
                }
            }
        }
        if (!empty($specialistDr)){
            $educationalQualificationsArr = json_decode($request->educationalQualifications);
            if ($educationalQualificationsArr){
                foreach ($educationalQualificationsArr as $eduQual){
                    $eduQualifiation = new EducationalQualification();
                    $eduQualifiation->specialist_dr_id = $specialistDr->id;
                    $eduQualifiation->degree_id = $eduQual->degree_id;
                    $eduQualifiation->institute_name = $eduQual->institute_name;
                    $eduQualifiation->country_name = $eduQual->country_name;
                    $eduQualifiation->passing_year = $eduQual->passing_year;
                    $eduQualifiation->duration = $eduQual->duration;
                    $eduQualifiation->save();
                }
            }
        }

        if (!empty($userReg)){
            $success['token'] = $userReg->createToken('Doctor Pathao')-> accessToken;
            $success['details'] = $userReg;
            return response()->json(['success'=>true,'response' =>$success], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }

    //new method
    public function secmoDocReg(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'email' => 'email|unique:users',
            'phone' => 'required|min:11|numeric|unique:users',
            'bmdc_number' => 'required|unique:secmo_drs',
        ]);
        $userReg = new User();
        $userReg->name = $request->name;
        $userReg->email = $request->email;
        $userReg->phone = $request->phone;
        $userReg->password = Hash::make($request->password);
        $userReg->user_type = "secmo_dr";
        $userReg->gender = $request->gender;
        $userReg->dob = $request->dob;
        $userReg->district_id = 1;
        $userReg->view = 0;
        $userReg->banned = 1;
        $image = $request->file('nid_pp_front');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/nid/',0);
        }else {
            $imagename = "default.png";
        }
        $userReg->nid_pp_front = $imagename;
        //nid back side
        $image2 = $request->file('nid_pp_back');
        if (isset($image2)) {
            $imagename2 = imageUpload($image2, 'uploads/nid/',0);
        }else {
            $imagename2 = "default.png";
        }
        $userReg->nid_pp_back = $imagename2;

        //profile image
        $image = $request->file('avatar_original');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/profile/',0);
        }else {
            $imagename = "default.png";
        }
        $userReg->avatar_original = $imagename;
        $userReg->save();
        if ($userReg !== null){
            $SecmoDr = new SecmoDr();
            $SecmoDr->user_id = $userReg->id;
            $SecmoDr->bmdc_number = $request->bmdc_number;
            $SecmoDr->bank_name = $request->bank_name;
            $SecmoDr->bank_branch = $request->bank_branch;
            $SecmoDr->bank_routing_number = $request->bank_routing_number;
            $SecmoDr->acc_holder_name = $request->acc_holder_name;
            $SecmoDr->account_number = $request->account_number;
            $SecmoDr->mob_bank_name = $request->mob_bank_name;
            $SecmoDr->mob_bank_number = $request->mob_bank_number;
            $SecmoDr->save();
        }
        if ($userReg !== null){
            //for mobile verification
            mobileVerification($userReg);
            $success['token'] = $userReg->createToken('Doctor Pathao')-> accessToken;
            $success['details'] = $userReg;
            $postData = [
                'secmo_dr_id' => $SecmoDr->id,
                'is_online' =>0,
            ];
            $dataPostFirebase = $this->database->getReference('sacmostatus')->push($postData);
            return response()->json(['success'=>true,'response' =>$success], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }

    //get full data
    public function specialistDoctorFullData()
    {
        $doctor = User::where('id',Auth::id())->get();
        if (!empty($doctor)){
            $doctorData =  new CommonProfileCollections($doctor);
            return response()->json(['success'=>true,'response' =>$doctorData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }
    //old data post
    public function secmoDoctorRegister(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:11|numeric|unique:users',
            //'title' => 'required',

        ]);
        $userReg = new User();
        $userReg->name = $request->name;
        $userReg->email = $request->email;
        $userReg->phone = $request->phone;
        $userReg->password = Hash::make($request->password);
        $userReg->user_type = 'secmo_dr';
        $userReg->gender = $request->gender;
        $userReg->dob = $request->dob;
        $userReg->district_id = $request->district_id;
        $userReg->view = 0;
        $userReg->banned = 1;
        //nid front
        $image = $request->file('nid_pp_front');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/nid/',0);
        }else {
            $imagename = "default.png";
        }
        $userReg->nid_pp_front = $imagename;
        //nid back side
        $image2 = $request->file('nid_pp_back');
        if (isset($image2)) {
            $imagename2 = imageUpload($image2, 'uploads/nid/',0);
        }else {
            $imagename2 = "default.png";
        }
        $userReg->nid_pp_back = $imagename2;
        $userReg->save();
        if (!empty($userReg)){
            $SecmoDr = new SecmoDr();
            $SecmoDr->user_id = $userReg->id;
            $SecmoDr->designation = $request->designation;
            //$specialistDr->designation = $request->designation;
            $SecmoDr->about = $request->about;
            $SecmoDr->bmdc_number = $request->bmdc_number;
            //$SecmoDr->professional_degree = $request->professional_degree;
            //$SecmoDr->experience = $request->experience;
            //$SecmoDr->current_employment = $request->current_employment;
            $SecmoDr->save();
            //$SecmoDr->doctor_code = 'DP'.mt_rand(111111,999999);
        }

        if (!empty($userReg)){
            //for mobile verification
            mobileVerification($userReg);
            $success['token'] = $userReg->createToken('Doctor Pathao')->accessToken;
            $success['details'] = $userReg;
            return response()->json(['success'=>true,'response' =>$success], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }

}


