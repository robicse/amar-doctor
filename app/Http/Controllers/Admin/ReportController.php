<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\DeliveryManRequest;
use App\Model\HomeServiceRequest;
use App\Model\OfferRequest;
use App\Model\TelemedicineRequest;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function telemedicineIndex(Request $request){
        $telemedicines = null;
        return view('backend.admin.reports.index',compact('telemedicines'));

    }

    public function telemedicineReport(Request $request){

//dd($request->all());
        $telemedicines = TelemedicineRequest::where('status','complete')->where('ssl_status','Completed');
        if ($request->dateFrom != null && $request->search == null){
            //dd($request->date);
            $telemedicines = $telemedicines->whereDate('created_at','>=', $request->dateFrom);
            $dateFrom = $request->dateFrom;
        }else{
            $dateFrom = $request->dateFrom;
        }
        if ($request->dateTo != null && $request->search == null){
            //dd($request->date);
            $telemedicines = $telemedicines->whereDate('created_at','<=', $request->dateTo);
            $dateTo = $request->dateTo;
        }else{
            $dateTo = $request->dateTo;
        }
        $telemedicines = $telemedicines->latest()->get();
//dd($telemedicines);

        return view('backend.admin.reports.index',compact('telemedicines','dateFrom','dateTo'));
    }


    public function homeServiceIndex(Request $request){

        $homeServices = null;
        return view('backend.admin.reports.home_service_index',compact('homeServices'));
    }
    public function homeServiceReport(Request $request){

        //dd($request->all());
        $homeServices = HomeServiceRequest::where('status','complete');
        if ($request->dateFrom != null && $request->search == null){
            //dd($request->date);
            $homeServices = $homeServices->whereDate('created_at','>=', $request->dateFrom);
            $dateFrom = $request->dateFrom;
        }else{
            $dateFrom = $request->dateFrom;
        }
        if ($request->dateTo != null && $request->search == null){
            //dd($request->date);
            $homeServices = $homeServices->whereDate('created_at','<=', $request->dateTo);
            $dateTo = $request->dateTo;
        }else{
            $dateTo = $request->dateTo;
        }
        $homeServices = $homeServices->latest()->get();


        return view('backend.admin.reports.home_service_index',compact('homeServices','dateFrom','dateTo'));
    }



    public function deliveryMAnIndex(Request $request){

        $deliveryMans = null;
        return view('backend.admin.reports.deliveryMan_index',compact('deliveryMans'));
    }
    public function deliveryMAnReport(Request $request){

        //dd($request->all());
        $deliveryMans = DeliveryManRequest::where('status','complete');
        if ($request->dateFrom != null && $request->search == null){
            //dd($request->date);
            $deliveryMans = $deliveryMans->whereDate('created_at','>=', $request->dateFrom);
            $dateFrom = $request->dateFrom;
        }else{
            $dateFrom = $request->dateFrom;
        }
        if ($request->dateTo != null && $request->search == null){
            //dd($request->date);
            $deliveryMans = $deliveryMans->whereDate('created_at','<=', $request->dateTo);
            $dateTo = $request->dateTo;
        }else{
            $dateTo = $request->dateTo;
        }
        $deliveryMans = $deliveryMans->latest()->get();


        return view('backend.admin.reports.deliveryMan_index',compact('deliveryMans','dateFrom','dateTo'));
    }

    public function offerIndex(Request $request){

        $offers = null;
        return view('backend.admin.reports.offer_index',compact('offers'));
    }
    public function offerReport(Request $request){

        //dd($request->all());
        $offers = OfferRequest::where('status','complete');
        if ($request->dateFrom != null && $request->search == null){
            //dd($request->date);
            $offers = $offers->whereDate('created_at','>=', $request->dateFrom);
            $dateFrom = $request->dateFrom;
        }else{
            $dateFrom = $request->dateFrom;
        }
        if ($request->dateTo != null && $request->search == null){
            //dd($request->date);
            $offers = $offers->whereDate('created_at','<=', $request->dateTo);
            $dateTo = $request->dateTo;
        }else{
            $dateTo = $request->dateTo;
        }
        $offers = $offers->latest()->get();


        return view('backend.admin.reports.offer_index',compact('offers','dateFrom','dateTo'));
    }


}
