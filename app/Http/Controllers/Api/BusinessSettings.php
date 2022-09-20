<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BusinessSettings extends Controller
{
    public $successStatus = 201;
    public $failStatus = 401;
    public function getAllSettings()
    {
        //return calculatedAmountWithVat(100);
        $settings = BusinessSetting::all();
        if (!empty($settings)){
            return response()->json(['success'=>true,'response' =>$settings], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }
    public function coupon(Request $request){

        $promoCode = Coupon::where('code',$request->promo_code)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->first();

        if (!empty($promoCode)){
            $amount['amount'] =(double) $promoCode->discount;
            return response()->json(['success'=>true,'response' =>$amount], $this->successStatus);
        }else{
            $amount['amount'] =(double) 0;
            return response()->json(['success'=>true,'response' =>$amount], $this->successStatus);
        }
    }
}
