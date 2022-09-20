<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultationDataCollections;
use App\Http\Resources\ConsultationHistoryCollections;
use App\Http\Resources\DoctorListDataCollections;
use App\Http\Resources\CommonProfileCollections;
use App\Http\Resources\QueueCollections;
use App\Http\Resources\SpDrEarningHistoryCollections;
use App\Http\Resources\SpecialityWiseDrsDataCollections;
use App\Model\CallQueue;
use App\Model\DrSpecialist;
use App\Model\MedicineList;
use App\Model\Patients;
use App\Model\Prescriptions;
use App\Model\Review;
use App\Model\SpecialistDr;
use App\Model\TelemedicineRequest;
use App\Model\Withdrawal;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Kreait\Firebase\Database;

class DoctorController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function doctorCreate(Request $request)

    {
        //dd($request->all());
        //dd(Auth::user()->name);
        $doctors = new SpecialistDr();
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
        $doctors->discount_expiry =  $request->discount_expiry;
        $doctors->acc_holder_name =  $request->acc_holder_name;
        $doctors->account_number =  $request->account_number;
        $doctors->mob_bank_name =  $request->mob_bank_name;
        $doctors->mob_bank_number =  $request->mob_bank_number;
        $doctors->bank_name =  $request->bank_name;

        $affectedRow = $doctors->save();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => $doctors], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }
    public function getDoctorsListForHome()
    {
//       $test =  DB::table('telemedicine_requests')
//            ->leftJoin('specialist_drs','specialist_drs.id','=','telemedicine_requests.specialist_dr_id')
//            ->select('telemedicine_requests.status','specialist_drs.doctor_code',
//                DB::raw('SUM(telemedicine_requests.status) as total'))
//            ->groupBy('specialist_drs.id','telemedicine_requests.specialist_dr_id','specialist_drs.doctor_code')
//            ->orderBy('total','desc')
//            //->limit(6)
//            ->get();


//        $reports = DB::table('telemedicine_requests')
//            ->join('specialist_drs','telemedicine_requests.specialist_dr_id','=','specialist_drs.id')
//
//            // ->where('telemedicine_requests.status', '=','complete')
//            ->where('specialist_drs.is_approved',1)->where('specialist_drs.is_active',1)
//            ->select('telemedicine_requests.specialist_dr_id',DB::raw('COUNT(telemedicine_requests.id) as total_req_sold'))
//            ->groupBy('telemedicine_requests.specialist_dr_id')
//            ->orderBy('total_req_sold', 'DESC')
//            ->limit(30)
//            ->get();

        $reports = DB::table('specialist_drs')
            ->leftJoin('telemedicine_requests','specialist_drs.id','=','telemedicine_requests.specialist_dr_id')
            ->where('specialist_drs.is_approved',1)->where('specialist_drs.is_active',1)
            ->where('specialist_drs.is_online',1)

            ->where('telemedicine_requests.status', '=','complete')
//            ->where('telemedicine_requests.specialist_dr_id', '!=',null)
            ->select('specialist_drs.id',DB::raw('COUNT(telemedicine_requests.id) as total_req_sold'))
            ->groupBy('specialist_drs.id')
            ->orderBy('total_req_sold', 'DESC')
            ->limit(30)
            ->get();
        //dd($reports);
        //return response()->json(['success'=>true,'response' => $reports], $this->successStatus);

        //$doctors = SpecialistDr::where('is_approved',1)->where('is_active',1)->get();
        if (!empty($reports)) {
            $doctorsData = new DoctorListDataCollections($reports);
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function getDoctorsList()
    {
//       $test =  DB::table('telemedicine_requests')
//            ->leftJoin('specialist_drs','specialist_drs.id','=','telemedicine_requests.specialist_dr_id')
//            ->select('telemedicine_requests.status','specialist_drs.doctor_code',
//                DB::raw('SUM(telemedicine_requests.status) as total'))
//            ->groupBy('specialist_drs.id','telemedicine_requests.specialist_dr_id','specialist_drs.doctor_code')
//            ->orderBy('total','desc')
//            //->limit(6)
//            ->get();


//        $reports = DB::table('telemedicine_requests')
//            ->join('specialist_drs','telemedicine_requests.specialist_dr_id','=','specialist_drs.id')
//            ->where('telemedicine_requests.status', '=','complete')
//            ->where('specialist_drs.is_approved',1)->where('specialist_drs.is_active',1)
//            ->select('telemedicine_requests.specialist_dr_id',DB::raw('COUNT(telemedicine_requests.id) as total_req_sold'))
//            ->groupBy('telemedicine_requests.specialist_dr_id')
//            ->orderBy('total_req_sold', 'DESC')
//            ->limit(30)
//            ->get();

        //return response()->json(['success'=>true,'response' => $reports], $this->successStatus);

        $doctors = SpecialistDr::where('is_approved',1)->where('is_active',1)->get();
        if (!empty($doctors)) {
            $doctorsData = new DoctorListDataCollections($doctors);
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function getDoctorsDetails($doctorId)
    {
        $doctor = SpecialistDr::find($doctorId);
        if (!empty($doctor)){
            $doctorsData = new CommonProfileCollections(User::where('id', $doctor->user_id)->get());
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }

    }
    public function specialityWiseDrsGet($specialityId)
    {
        $doctors = DrSpecialist::where('specialities_id',$specialityId)->get();
        if (!empty($doctors)){
            $doctorsData = new SpecialityWiseDrsDataCollections($doctors);
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['specialist_dr_id'] == $id) {
                return $key;
            }
        }
        return null;
    }

    public function specialityDrIsOnline(Request $request)
    {
        $doctors = SpecialistDr::find($request->specialist_dr_id);
        $doctors->is_online = $request->is_online;
        $values = $this->database->getReference('spdrstatus')->getValue();
        $fbKey =  $this->searchForId($doctors->id , $values);
        $updateData = [
            "specialist_dr_id" => $request->specialist_dr_id,
            "is_online" => $request->is_online,
        ];
        $dataGet = $this->database->getReference('spdrstatus/'.$fbKey)->update($updateData);
        if (!$dataGet){
            return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], $this->failStatus);
        }
        if ($doctors->save()){
            return response()->json(['success'=>true,'response' => "Status Change Successfully"], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function consultationHistory($drId)
    {
       $histories = TelemedicineRequest::where('specialist_dr_id', $drId)->where('status', 'complete')->get();
       //dd($histories);
        if ($histories){
            $doctorsData = new ConsultationHistoryCollections($histories);
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function earningHistory($drId)
    {

        $histories = DB::table('telemedicine_requests')
            ->where('specialist_dr_id', $drId)
            ->where('status', 'complete')
            ->select('specialist_dr_id',DB::raw('sum(specialist_dr_amount) as `sum_total_amount`'),DB::raw('DATE(created_at) date'))
            ->groupBy(DB::raw('DATE(created_at)'),'specialist_dr_id')
            ->get();
        //dd($histories);
        //dd($histories);
        $total = DB::table('telemedicine_requests')
            ->where('specialist_dr_id', $drId)
            ->where('status', 'complete')->sum('specialist_dr_amount');

        if ($histories){
            $arr = new SpDrEarningHistoryCollections($histories);
            $doctorsData['total'] = $total;
            $doctorsData['balance'] = SpecialistDr::find($drId)->user->balance;
            $doctorsData['main_data'] = $arr;
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function dashboard($drId)
    {
        $doctor = SpecialistDr::find($drId);
        $currentDate =  Carbon::now()->format('Y-m-d');
        $histories = TelemedicineRequest::whereDate('created_at', $currentDate)->where('specialist_dr_id', $drId)->where('status', 'complete');
        $historiesData =  $histories->get();
        $todayEarned =  $histories->sum('specialist_dr_amount');
        $consultedToday = count($historiesData);
        $currentBalance = $doctor->user->balance;
        $withdraw= Withdrawal::where('user_id', $doctor->user_id)->where('status', 'complete')->latest()->first();
        if ($withdraw !== null) {
            $nextPaymentDate1 = $withdraw->updated_at->addDays(7)->format('d-m-Y') ;
            $nextPaymentDate = date('M d, Y', strtotime($nextPaymentDate1));
        }else{
            $nextPaymentDate = 'No Withdraw Yet!';
        }
        $newDr = SpecialistDr::all()->count();
        $responseArr = [
            'todayEarn' => $todayEarned,
            'todayConsulted' => $consultedToday,
            'nextPaymentDate' => $nextPaymentDate,
            'currentBalance' => $currentBalance,
            'newDr' => $newDr,
            'newPatient' => Patients::all()->count(),
        ];
        if (!empty($doctor)){

            return response()->json(['success'=>true,'response' => $responseArr], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }

    }
    public function addMedicine(Request $request)
    {
        $medicine = MedicineList::where('name', $request->name)->first();
        if ($medicine) {
            return response()->json(['success'=>false,'response'=>'Already exist this name!'], $this->failStatus);
        }else{
            $medicineObj = new MedicineList();
            $medicineObj->name = $request->name;
            $medicineObj->save();
            return response()->json(['success'=>true,'response'=>'Successfully added!'], 200);
        }
    }

    public function getMedicine()
    {
        $medicines = MedicineList::all();
        if (!empty($medicines)){
            return response()->json(['success'=>true,'response' => $medicines], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function getWithdrawHistory($useId)
    {
        $withdraw['balance'] = User::find($useId)->balance;
        $withdraw['data'] = Withdrawal::where('user_id', $useId)->latest()->get();
        if (!empty($withdraw)){
            return response()->json(['success'=>true,'response' => $withdraw], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function submitWithdraw(Request $request)
    {
        //dd($request->amount);
        $user = User::find($request->user_id);
        if ($request->amount < 100) {
            return response()->json(['success'=>false,'response'=>'Minimum withdraw limit is: 100tk'], $this->failStatus);
        }
        if ($user->balance <= $request->amount) {
            return response()->json(['success'=>false,'response'=>'Your Entered amount greater than your balance.'], $this->failStatus);
        }



        $withdraw = new Withdrawal();
        $withdraw->user_id = $request->user_id;
        $withdraw->amount = $request->amount;
        $withdraw->charge = 0;
        $withdraw->trx = getTrx();
        $withdraw->final_amount = $request->amount - $withdraw->charge;
        $withdraw->withdraw_information = $request->withdraw_information;
        $withdraw->status = 'pending';
        if ($withdraw->save()){
            $user->balance -= $request->amount;
            $user->save();
            //Transaction helper function..
            transaction($request->user_id,$request->amount,$user->balance,0,'Withdraw Req',$withdraw->trx,'-');
            return response()->json(['success'=>true,'response' => "Withdraw request successfully sent."], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    //update consultation fee.......
    public function consultationFee(Request $request)
    {
        $consultation = SpecialistDr::find($request->specialist_dr_id);
        //if ($request->is_followup == 1) {
            $consultation->follow_up_fee = $request->follow_up_fee;
            $consultation->follow_up_within = $request->follow_up_within;
        //}
        $consultation->is_followup = $request->is_followup;
        if ($request->isDiscount == 1) {
            $consultation->discount_percentage = $request->discount_percentage;
            $consultation->discount_expiry = $request->discount_expiry;
        }
        $consultation->consultation_duration = $request->consultation_duration;
        $consultation->consultation_fee = $request->consultation_fee;
        $consultation->availability = $request->availability;
        $consultation->consultation_time = $request->consultation_time;
        $consultation->save();
        if ($consultation->save()){
            return response()->json(['success'=>true,'response' => "Consultation Fee Successfully Updated."], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function consultationFeeGet($docId){
        $consultation = SpecialistDr::where('id',$docId)->get();
        if ($consultation){
            $consultationData = new ConsultationDataCollections($consultation);
            return response()->json(['success'=>true,'response' => $consultationData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }

    }

    public function updateAvailability(Request $request)
    {
        $doctor = SpecialistDr::find($request->specialist_dr_id);
        $doctor->consultation_time = $request->consultation_time;
        $doctor->availability = $request->availability;
        if ($doctor->save()){
            return response()->json(['success'=>true,'response' => "Availability Successfully Updated."], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function signatureUpdate(Request $request){
        $dr = SpecialistDr::find($request->drId);
        $image = $request->file('signature');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/signature/', 0);
        } else {
            $imagename = $dr->signature;
        }
        $dr->signature = $imagename;
        if ($dr->save()) {
            // $userData = new  UserProfileCollections(User::where('id', $patients->id)->get());
            return response()->json(['success' => true, 'response' => $dr], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'No Successfully Updated!'], $this->failStatus);
        }
    }

    public function experienceInfoUpdate(Request $request){
        $spDr = SpecialistDr::find($request->specialist_dr_id);
        $spDr->experience = $request->experience;
        $spDr->current_employment = $request->current_employment;
        if ($spDr->save()) {
            return response()->json(['success' => true, 'response' => 'Experience Info updated successfully'], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'No Successfully Updated!'], $this->failStatus);
        }
    }



}
