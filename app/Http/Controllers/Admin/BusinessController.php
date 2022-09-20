<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(){
        $h_service_day_cost = BusinessSetting::where('type','h_service_day_cost')->first();
        $h_service_night_cost = BusinessSetting::where('type','h_service_night_cost')->first();
        $vat = BusinessSetting::where('type','vat')->first();
        $special_dr_percentage = BusinessSetting::where('type','special_dr_percentage')->first();
        $sp_dr_home_service_percentage = BusinessSetting::where('type','sp_dr_home_service_percentage')->first();
        $secmo_dr_percentage = BusinessSetting::where('type','secmo_dr_percentage')->first();
        $delivery_man_cost = BusinessSetting::where('type','delivery_man_cost')->first();
        $offer_start_time = BusinessSetting::where('type','offer_start_time')->first();
        $offer_end_time = BusinessSetting::where('type','offer_end_time')->first();
        $offer_status = BusinessSetting::where('type','offer_status')->first();
        $h_service_status= BusinessSetting::where('type','h_service_status')->first();
        $h_service_start_time= BusinessSetting::where('type','h_service_start_time')->first();
        $h_service_end_time= BusinessSetting::where('type','h_service_end_time')->first();
       // dd($offer_end_time);
        return view('backend.admin.business.index',compact('h_service_day_cost','h_service_night_cost','vat',
            'special_dr_percentage','secmo_dr_percentage','delivery_man_cost','offer_start_time',
            'offer_end_time','offer_status','sp_dr_home_service_percentage','h_service_status','h_service_start_time',
            'h_service_end_time'
        ));
    }
    public function h_service_day_cost_Update(Request $request){
        //dd($request->all());
        $sellerCommission = BusinessSetting::find($request->id);
        $sellerCommission->value = $request->value;
        $sellerCommission->save();
    }
    public function h_service_night_cost_Update(Request $request){
        $refferalValue = BusinessSetting::find($request->id);
        $refferalValue->value = $request->value;
        $refferalValue->save();
    }
    public function vatUpdate(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }
    public function special_dr_percentage_Update(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }
    public function special_dr_home_service_percentage(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }
    public function secmo_dr_percentage_Update(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }
    public function delivery_man_cost_Update(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }
    public function offer_end_time(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }
    public function offer_status(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }
    public function offer_start_time(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }

    public function h_service_start_time(Request $request){
    $firstOrderValue = BusinessSetting::find($request->id);
    $firstOrderValue->value = $request->value;
    $firstOrderValue->save();
    }
    public function h_service_end_time(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }

    public function h_service_status(Request $request){
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
    }
}
