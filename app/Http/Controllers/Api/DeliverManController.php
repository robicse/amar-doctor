<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonProfileCollections;
use App\Http\Resources\DeliveryManDeliveredHistoryCollections;
use App\Http\Resources\DeliveryManEarningHistoryCollections;
use App\Http\Resources\DeliveryManListDataCollections;
use App\Http\Resources\DeliveryManOnlineListDataCollections;
use App\Http\Resources\SecmoEarningHistoryCollections;
use App\Http\Resources\UserSelectedDeliveryManDataCollections;
use App\Model\BusinessSetting;
use App\Model\DeliveryMan;
use App\Model\DeliveryManRequest;
use App\Model\DmServiceReview;
use App\Model\HomeServiceRequest;
use App\Model\Patients;
use App\Model\SecmoDr;
use App\Model\Withdrawal;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Database;

class DeliverManController extends Controller
{
    public $successStatus = 201;
    public $failStatus = 401;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    protected  function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['delivery_man_id'] == $id) {
                return $key;
            }
        }
        return null;
    }

    protected  function searchForDmReqId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['dm_req_id'] == $id) {
                return $key;
            }
        }
        return null;
    }

    public function deliverManRegister(Request $request)
    {
        $this->validate($request,[
            'email' => 'email|unique:users',
            'phone' => 'required|min:11|numeric|unique:users',
            //'title' => 'required',

        ]);
        $userReg = new User();
        $userReg->name = $request->name;
        $userReg->email = $request->email;
        $userReg->phone = $request->phone;
        $userReg->password = Hash::make($request->password);
        $userReg->user_type = 'delivery_man';
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
        //profile image
        $image = $request->file('avatar_original');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/profile/',0);
        }else {
            $imagename = "default.png";
        }
        $userReg->avatar_original = $imagename;
        $userReg->save();

        if (!empty($userReg)){
            $dMan = new DeliveryMan();
            $dMan->user_id = $userReg->id;
            $dMan->bank_branch = $request->bank_branch;
            $dMan->bank_routing_number = $request->bank_routing_number;
            $dMan->acc_holder_name = $request->acc_holder_name;
            $dMan->account_number = $request->account_number;
            $dMan->mob_bank_name = $request->mob_bank_name;
            $dMan->mob_bank_number = $request->mob_bank_number;
            $dMan->save();
        }
        if (!empty($userReg)){
            //for mobile verification
            mobileVerification($userReg);
            $success['token'] = $userReg->createToken('Doctor Pathao')->accessToken;
            $success['details'] = $userReg;

            $postData = [
                'delivery_man_id' => $dMan->id,
                'is_online' =>0,
            ];
            $dataPostFirebase = $this->database->getReference('deliverymanstatus')->push($postData);
            return response()->json(['success'=>true,'response' =>$success], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }
    public function deliverManList()
    {
        $dManList = DeliveryMan::where('is_approved',1)->where('is_active',1)->get();
        if (!empty($dManList)) {
            $deliveryManData = new DeliveryManListDataCollections($dManList);
            return response()->json(['success'=>true,'response' => $deliveryManData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function deliveryManDetails($deliveryManId)
    {
        $dManId = DeliveryMan::find($deliveryManId)->user_id;
        if (!empty($dManId)){
            $doctorsData = new CommonProfileCollections(User::where('id', $dManId->user_id)->get());
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function deliveryManUpdateProfile(Request $request)
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

    public function deliveryManUpdateBankInfo(Request $request)
    {
        //dd($request->all());
        $deliveryManData =  DeliveryMan::where('id',$request->deliveryMan_id)->first();
        $deliveryManData->bank_name = $request->bank_name;
        $deliveryManData->bank_branch = $request->bank_branch;
        $deliveryManData->bank_routing_number = $request->bank_routing_number;
        $deliveryManData->acc_holder_name = $request->acc_holder_name;
        $deliveryManData->account_number = $request->account_number;
        $deliveryManData->mob_bank_name = $request->mob_bank_name;
        $deliveryManData->mob_bank_number = $request->mob_bank_number;
        if ($deliveryManData->save()){
            return response()->json(['success'=>true,'response' => $deliveryManData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function userSelectedDeliveryManData(Request $request){
        $deliveryMan = DeliveryMan::where('id', $request->deliveryMan_id)
            ->where('is_approved',1)->where('is_active',1)->where('is_online',1)
            ->get();
        if (!empty($deliveryMan)) {
            $deliveryManData = new UserSelectedDeliveryManDataCollections($deliveryMan);
            return response()->json(['success'=>true,'response' => $deliveryManData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }


    public function deliveryManIsOnline(Request $request)
    {
        $deliveryMan = DeliveryMan::find($request->delivery_man_id);
        //dd($deliveryMan);
        $deliveryMan->is_online = $request->is_online;
        $values = $this->database->getReference('deliverymanstatus')->getValue();
        $fbKey =  $this->searchForId($deliveryMan->id , $values);
        $updateData = [
            "delivery_man_id" => $request->delivery_man_id,
            "is_online" => $request->is_online,
        ];
        $user = User::find($deliveryMan->user_id);
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();

        $dataGet = $this->database->getReference('deliverymanstatus/'.$fbKey)->update($updateData);
        if (!$dataGet){
            return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], $this->failStatus);
        }
        if ($deliveryMan->save()){
            return response()->json(['success'=>true,'response' => "Status Change Successfully"], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }


    public function getDeliveryManOnlineList(Request $request){
        $lat = $request->latitude;
        $lng = $request->longitude;
        $user = User::find($request->user_id);
        $user->latitude = $lat;
        $user->longitude = $lng;
        $user->save();
        $deliveryMans = DeliveryMan::
        join('users', 'users.id', '=', 'delivery_mans.user_id')
            ->where('users.user_type','delivery_man')
            ->where('is_approved',1)->where('is_active',1)->where('is_online',1)
            ->whereBetween('latitude',[$lat-0.01,$lat+0.01])->whereBetween('longitude',[$lng-0.01,$lng+0.01])
            ->select('delivery_mans.*')
            ->get();
        if (!empty($deliveryMans)) {
            $deliveryMansData = new DeliveryManOnlineListDataCollections($deliveryMans);
            return response()->json(['success'=>true,'response' => $deliveryMansData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function deliveryManRequest(Request $request){
        $deliveryManCheck = DeliveryManRequest::where('delivery_man_id', $request->delivery_man_id)
            ->where('status', 'pending')->latest()->first();
        if (!empty($deliveryManCheck)) {
            return response()->json(['success' => false, 'response' => 'Delivery Man already booked by another service.'], 201);
        }
        //dd(calculatedAmountWithVat($request->amount));
        $this->validate($request,[
            'user_id' => 'required',
            'delivery_man_id' => 'required',
            'delivery_charge' => 'required',
            'discount' => 'required',
        ]);
        $amount = $request->delivery_charge - $request->discount;
        $DMRequest = new DeliveryManRequest();
        $DMRequest->user_id = $request->user_id;
        $DMRequest->prescription_id = $request->prescription_id;
        $DMRequest->delivery_man_id = $request->delivery_man_id;
        $DMRequest->delivery_charge = $request->delivery_charge;
        $DMRequest->note = $request->note;
        $DMRequest->discount = $request->discount;
        $DMRequest->grand_total = calculatedAmountWithVat($amount);
        $DMRequest->total_vat = calculatedVatResult($amount);
        $DMRequest->admin_fees = $amount - DeliveryManRequestReceivableAmount($request->delivery_charge);
        $DMRequest->code = date('Ymd-his');
        $DMRequest->delivery_man_status = 'pending';
        $DMRequest->delivery_man_cost = DeliveryManRequestReceivableAmount($request->delivery_charge);
        $image = $request->file('is_prescription_photo');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/prescription_photo/',0);
            $DMRequest->is_prescription_photo = $imagename;
        }
        //$HSRequest->specialist_dr_amount = homeServiceSpDrReceivableAmount($request->amount);
        // $HSRequest->admin_fees = $request->amount - ($HSRequest->specialist_dr_amount + $HSRequest->secmo_dr_amount);
        $DMRequest->status = 'pending';
        $DMRequest->ssl_status = 'Pending';
        $DMRequest->payment_type = 'later';
        $DMRequest->total_vat_pecentage = vat();
        $DMRequest->service_charge_percentage =  BusinessSetting::where('type','delivery_man_cost')->first()->value;
        if ($DMRequest->save()) {
            $postData = [
                'dm_req_id' => $DMRequest->id,
                'delivery_man_id' => $request->delivery_man_id,
                'status' =>'pending',
                'delivery_man_status' => 'pending',
            ];
            $dataPostFirebase = $this->database->getReference('deliveryManRequest')->push($postData);
            return response()->json(['success' => true, 'response' => $DMRequest], 200);
        } else {
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }
    }

    public function dashboard($dmId)
    {
        $deliveryMan = DeliveryMan::find($dmId);
        $currentDate =  Carbon::now()->format('Y-m-d');
        $histories = DeliveryManRequest::whereDate('created_at', $currentDate)->where('delivery_man_id', $dmId)->where('status', 'complete');
        $historiesData =  $histories->get();
        $todayEarned =  $histories->sum('delivery_man_cost');
        $consultedToday = count($historiesData);
        $currentBalance = $deliveryMan->user->balance;
        $withdraw = Withdrawal::where('user_id', $deliveryMan->user_id)->where('status', 'complete')->latest()->first();
        if ($withdraw !== null) {
            $nextPaymentDate1 = $withdraw->updated_at->addDays(7)->format('d-m-Y') ;
            $nextPaymentDate = date('M d, Y', strtotime($nextPaymentDate1));
        }else{
            $nextPaymentDate = 'No Withdraw Yet!';
        }
        $newDelivery = DeliveryMan::all()->count();
        $responseArr = [
            'todayEarn' => $todayEarned,
            'todayDelivery' => $consultedToday,
            'nextPaymentDate' => $nextPaymentDate,
            'currentBalance' => $currentBalance,
            'newDelivery' => $newDelivery,
            'newPatient' => Patients::all()->count(),
        ];
        if (!empty($deliveryMan)){
            return response()->json(['success'=>true,'response' => $responseArr], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }

    public function getDeliveryManDetails($deliveryManId)
    {
        $deliveryMan = DeliveryMan::find($deliveryManId);
        $userModelData = User::where('id', $deliveryMan->user_id)->get();
        if (!empty($userModelData)) {
            $doctorsData = new CommonProfileCollections($userModelData);
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function earningHistory($deliveryManId)
    {
        $histories = DB::table('delivery_man_requests')
            ->where('delivery_man_id', $deliveryManId)
            ->where('status', 'complete')
            ->select('delivery_man_id',DB::raw('sum(delivery_man_cost) as `sum_total_amount`'),DB::raw('DATE(created_at) date'))
            ->groupBy(DB::raw('DATE(created_at)'),'delivery_man_id')
            ->get();
        //dd($histories);
        //dd($histories);
        $total = DB::table('delivery_man_requests')
            ->where('delivery_man_id', $deliveryManId)
            ->where('status', 'complete')->sum('delivery_man_cost');
        //dd($total);
        if ($histories){
            $arr = new DeliveryManEarningHistoryCollections($histories);
            $doctorsData['total'] = $total;
            $doctorsData['balance'] = DeliveryMan::find($deliveryManId)->user->balance;
            $doctorsData['main_data'] = $arr;
            return response()->json(['success'=>true,'response' => $doctorsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
    public function deliveryManRequestCancelByUser($dm_req_id)
    {
        $dmRequest = DeliveryManRequest::find($dm_req_id);
        //dd($hsRequest);
        if ($dmRequest->status == 'pending') {
            $dmRequest->status = 'cancel';
            $dmRequest->save();
            $values = $this->database->getReference('deliveryManRequest')->getValue();
            $fbKey =  $this->searchForDmReqId($dmRequest->id , $values);
            $updateData = [
                'status' =>'cancel',
                'delivery_man_status' => 'cancel',
            ];
            $dataGet = $this->database->getReference('deliveryManRequest/'.$fbKey)->update($updateData);
            if (!$dataGet){
                return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
            }
            return response()->json(['success' => true, 'response' => 'Delivery request successfully canceled by user.'], 200);
        }else{
            return response()->json(['success' => false, 'response' => "You can't cancel right now."], 401);
        }
    }
    public function dmRequestConversationDoneByUser($dm_req_id)
    {
        $dmRequest = DeliveryManRequest::find($dm_req_id);
        //dd($hsRequest);
        if ($dmRequest->status == 'processing') {
            $dmRequest->status = 'conversationDone';
            $dmRequest->save();
            $values = $this->database->getReference('deliveryManRequest')->getValue();
            $fbKey =  $this->searchForDmReqId($dmRequest->id , $values);
            $updateData = [
                'status' =>'conversationDone',
                'delivery_man_status' => 'conversationDone',
            ];
            $dataGet = $this->database->getReference('deliveryManRequest/'.$fbKey)->update($updateData);
            if (!$dataGet){
                return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
            }
            return response()->json(['success' => true, 'response' => 'Delivery request successfully changed by user.'], 200);
        }else{
            return response()->json(['success' => false, 'response' => "You can't update status right now."], 401);
        }
    }

    public function dmRequestDmStatusChange(Request $request)
    {
        $dmService = DeliveryManRequest::find($request->dm_req_id);
        $dmUserData = DeliveryMan::find($dmService->delivery_man_id)->user;
        $user = User::find($dmService->user_id);
        $delivery_man_status = '';
        $status = '';
        if ($dmService->status == 'pending' && $request->delivery_man_status == 'processing'){
            $dmService->delivery_man_status = 'processing';
            $dmService->status = 'processing';
            $delivery_man_status =  'processing';
            $status =  'processing';
            $dmRequestData = [
                'user_name' => $user->name,
                'user_phone' => $user->phone,
                'user_photo' => '/uploads/profile/'.$user->avatar_original,
                'grand_total' => $dmService->grand_total,
                'visit' =>  $dmService->amount,
                'discount' => $dmService->discount,
                'total_vat' => $dmService->total_vat,
                'note' => $dmService->note,
                'is_prescription_photo' => '/uploads/prescription_photo/'.$dmService->is_prescription_photo,
                'user_address' => GetAddress($user->longitude,$user->latitude),
                'dm_address' => GetAddress($dmUserData->longitude,$dmUserData->latitude),
                'distance' => GetDistance('https://barikoi.xyz/v1/api/distance/MjMzNTpTWlBLSkRHUTRZ/'.$dmUserData->longitude .','.$dmUserData->latitude.'/'.$user->longitude.','.$user->latitude),
            ];
            $dmService->user_address = $dmRequestData['user_address'];
            $dmService->dm_address = $dmRequestData['dm_address'];
            $dmService->distance = $dmRequestData['distance'];

        }elseif ($request->delivery_man_status == 'cancel'){
            $dmService->delivery_man_status = 'cancel';
            $dmService->status = 'cancel';
            $delivery_man_status =  'cancel';
            $status =  'cancel';
        }else{
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }

        if ($dmService->save()){
            $values = $this->database->getReference('deliveryManRequest')->getValue();
            $fbKey =  $this->searchForDmReqId($dmService->id , $values);
            $updateData = [
                'delivery_man_status' => $delivery_man_status,
                'status' => $status,
            ];
            $dataGet = $this->database->getReference('deliveryManRequest/'.$fbKey)->update($updateData);
            if (!$dataGet){
                return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
            }
            if ($request->delivery_man_status == 'processing') {
                return response()->json(['success' => true, 'response' => $dmRequestData ], 200);
            }else{
                return response()->json(['success' => true, 'response' => 'successfully status change'], 200);
            }
        }else{
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }
    }

    public function dmReviewPost(Request $request)
    {
        //dd('sssss');
        $review = new DmServiceReview();
        $dmService = DeliveryManRequest::find($request->dm_service_request_id);
        $review->dm_service_request_id = $request->dm_service_request_id;
        $review->delivery_man_id = $dmService->delivery_man_id;
        $review->user_id = $dmService->user_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->status = 1;
        $review->viewed = 0;
        $review->save();
        if (!empty($review)) {
            return response()->json(['success' => true, 'response' => 'successfully Data Saved'], 200);
        }else {
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }
    }

    public function deliveryList(Request $request)
    {
        $dmService = DeliveryManRequest::where('delivery_man_id',$request->delivery_man_id)->where('status',$request->status)->latest()->get();
        if ($dmService){
           $dmList = New DeliveryManDeliveredHistoryCollections($dmService);
            return response()->json(['success'=>true,'response' => $dmList], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }


}
