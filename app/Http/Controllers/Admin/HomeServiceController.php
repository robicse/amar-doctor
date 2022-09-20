<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\HomeServiceRequest;
use Illuminate\Http\Request;

class HomeServiceController extends Controller
{
    public function pending()
    {
         $home_service_pending_request = HomeServiceRequest::where('status','pending')->latest()->get();
         return view('backend.admin.home_service_request.pending',compact('home_service_pending_request'));
    }
    public function processing()
    {
        $home_service_processing_request = HomeServiceRequest::where('status','processing')->latest()->get();
        return view('backend.admin.home_service_request.processing',compact('home_service_processing_request'));
    }
    public function complete()
    {
        $home_service_complete_request = HomeServiceRequest::where('status','complete')->latest()->get();
        return view('backend.admin.home_service_request.complete',compact('home_service_complete_request'));
    }
    public function cancle()
    {
        $home_service_cancel_request = HomeServiceRequest::where('status','cancle')->latest()->get();
        return view('backend.admin.home_service_request.cancle',compact('home_service_cancel_request'));
    }
    public function requestShow($id)
    {
        $home_service_complete_request = HomeServiceRequest::where('id',$id)->first();
        return view('backend.admin.home_service_request.show',compact('home_service_complete_request'));


   }

}
