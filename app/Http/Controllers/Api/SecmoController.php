<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonProfileCollections;
use App\Http\Resources\SecmoDoctorListDataCollections;
use App\Http\Resources\SecmoDoctorOnlineListDataCollections;
use App\Http\Resources\SecmoEarningHistoryCollections;
use App\Http\Resources\SecmoOrderHistoryCollections;
use App\Http\Resources\SpDrEarningHistoryCollections;
use App\Http\Resources\UserSelectedSecmoDataCollections;
use App\Model\BusinessSetting;
use App\Model\HomeServiceRequest;
use App\Model\HomeServiceReview;
use App\Model\Patients;
use App\Model\SecmoDr;
use App\Model\SpecialistDr;
use App\Model\Withdrawal;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Database;

class SecmoController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    protected  function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['secmo_dr_id'] == $id) {
                return $key;
            }
        }
        return null;
    }

    public function getSecmoDrList()
    {
        $doctors = SecmoDr::where('is_approved',1)->where('is_active',1)->get();
        if (!empty($doctors)) {
            $doctorsData = new SecmoDoctorListDataCollections($doctors);
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function getSecmoDrDetails($secmoDrId)
    {
        $secmoDr = SecmoDr::find($secmoDrId);
        $userModelData = User::where('id', $secmoDr->user_id)->get();
        if (!empty($userModelData)) {
            $doctorsData = new CommonProfileCollections($userModelData);
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function updateProfile(Request $request)
    {

        $user =  User::where('id',$request->user_id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->district_id = $request->district_id;
        $user->dob = $request->dob;
        if($request->hasFile('avatar_original')){
            $user->avatar_original = $request->avatar_original->store('uploads/profile');
        }
        $user->save();
        if ($user->save()){
            return response()->json(['success'=>true,'response' => $user], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function updateBankInfo(Request $request)
    {
       //dd($request->all());
        $doctors =  SecmoDr::where('id',$request->secmo_dr_id)->first();
        $doctors->bank_name = $request->bank_name;
        $doctors->bank_branch = $request->bank_branch;
        $doctors->bank_routing_number = $request->bank_routing_number;
        $doctors->acc_holder_name = $request->acc_holder_name;
        $doctors->account_number = $request->account_number;
        $doctors->mob_bank_name = $request->mob_bank_name;
        $doctors->mob_bank_number = $request->mob_bank_number;
        if ($doctors->save()){
            return response()->json(['success'=>true,'response' => $doctors], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function secmoIsOnline(Request $request)
    {

        $doctors = SecmoDr::find($request->secmo_dr_id);
        $doctors->is_online = $request->is_online;
        $values = $this->database->getReference('sacmostatus')->getValue();
        $fbKey =  $this->searchForId($doctors->id , $values);
        $updateData = [
            "secmo_dr_id" => $request->secmo_dr_id,
            "is_online" => $request->is_online,
        ];
       // dd($doctors);
        $user = User::find($doctors->user_id);
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();

        $dataGet = $this->database->getReference('sacmostatus/'.$fbKey)->update($updateData);
        if (!$dataGet){
            return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], $this->failStatus);
        }
        if ($doctors->save()){
            return response()->json(['success'=>true,'response' => "Status Change Successfully"], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function dashboard($secmoId)
    {
        $secmo = SecmoDr::find($secmoId);
        $currentDate =  Carbon::now()->format('Y-m-d');
        $histories = HomeServiceRequest::whereDate('created_at', $currentDate)->where('secmo_dr_id', $secmoId)->where('status', 'complete');
        $historiesData =  $histories->get();
        $todayEarned =  $histories->sum('secmo_dr_amount');
        $consultedToday = count($historiesData);
        $currentBalance = $secmo->user->balance;
        $withdraw = Withdrawal::where('user_id', $secmo->user_id)->where('status', 'complete')->latest()->first();
        if ($withdraw !== null) {
            $nextPaymentDate1 = $withdraw->updated_at->addDays(7)->format('d-m-Y') ;
            $nextPaymentDate = date('M d, Y', strtotime($nextPaymentDate1));
        }else{
            $nextPaymentDate = 'No Withdraw Yet!';
        }
        $newSecmo = SecmoDr::all()->count();
        $responseArr = [
            'todayEarn' => $todayEarned,
            'todayConsulted' => $consultedToday,
            'nextPaymentDate' => $nextPaymentDate,
            'currentBalance' => $currentBalance,
            'newDr' => $newSecmo,
            'newPatient' => Patients::all()->count(),
        ];
        if (!empty($secmo)){
            return response()->json(['success'=>true,'response' => $responseArr], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function earningHistory($secmoId)
    {

        $histories = DB::table('home_service_requests')
            ->where('secmo_dr_id', $secmoId)
            ->where('status', 'complete')
            ->select('secmo_dr_id',DB::raw('sum(secmo_dr_amount) as `sum_total_amount`'),DB::raw('DATE(created_at) date'))
            ->groupBy(DB::raw('DATE(created_at)'),'secmo_dr_id')
            ->get();
        //dd($histories);
        //dd($histories);
        $total = DB::table('home_service_requests')
            ->where('secmo_dr_id', $secmoId)
            ->where('status', 'complete')->sum('secmo_dr_amount');

        if ($histories){
            $arr = new SecmoEarningHistoryCollections($histories);
            $doctorsData['total'] = $total;
            $doctorsData['balance'] = SecmoDr::find($secmoId)->user->balance;
            $doctorsData['main_data'] = $arr;
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }


    public function getSecmoDrOnlineList(Request $request)
    {
        $lat = $request->latitude;
        $lng = $request->longitude;
        $user = User::find($request->user_id);
        $user->latitude = $lat;
        $user->longitude = $lng;
        $user->save();
        $doctors = SecmoDr::
            join('users', 'users.id', '=', 'secmo_drs.user_id')
            ->where('user_type','secmo_dr')
            ->where('is_approved',1)->where('is_active',1)->where('is_online',1)
            //->whereBetween('latitude',[$lat-0.01,$lat+0.01])->whereBetween('longitude',[$lng-0.01,$lng+0.01])
            ->select('secmo_drs.*')
            ->get();
        if (!empty($doctors)) {
            $doctorsData = new SecmoDoctorOnlineListDataCollections($doctors);
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function userSelectedSecmoData(Request $request)
    {
        //dd($request->all());
        $secmo = SecmoDr::where('id', $request->secmo_dr_id)
            ->where('is_approved',1)->where('is_active',1)->where('is_online',1)
            ->get();
        if (!empty($secmo)) {
            $doctorsData = new UserSelectedSecmoDataCollections($secmo);
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function getSecmoConsultationHistory($sacmoId)
    {
       $homeServiceList =  HomeServiceRequest::where('secmo_dr_id', $sacmoId)->where('status', 'complete')->get();
        if (!empty($homeServiceList)) {
            $secmoOrderData = new SecmoOrderHistoryCollections($homeServiceList);
            return response()->json(['success'=>true,'response' => $secmoOrderData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }

    }
    public function getSecmoConsultationProcessingHistory($sacmoId)
    {
        $homeServiceList =  HomeServiceRequest::where('secmo_dr_id', $sacmoId)->where('status', 'processing')->get();
        if (!empty($homeServiceList)) {
            $secmoOrderData = new SecmoOrderHistoryCollections($homeServiceList);
            return response()->json(['success'=>true,'response' => $secmoOrderData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }

    }
    public function locationUpdate(Request $request){
        $secmoDoctor = SecmoDr::find($request->secmo_dr_id);

        $values = $this->database->getReference('sacmostatus')->getValue();
        $fbKey =  $this->searchForId($secmoDoctor->id , $values);
        $updateData = [
            "secmo_dr_id" => $request->secmo_dr_id,
            "is_online" => 1,
        ];
        $user = User::find($secmoDoctor->user_id);
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();

        $dataGet = $this->database->getReference('sacmostatus/'.$fbKey)->update($updateData);
        if (!$dataGet){
            return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], $this->failStatus);
        }
        if ($secmoDoctor->save()){
            return response()->json(['success'=>true,'response' => "Location Updated Successfully"], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }





}
