<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use PDF;
use App\Model\TelemedicineRequest;
use Illuminate\Http\Request;

class TelemedicineController extends Controller
{
    public function pending()
    {
        $telemedicine_pending_request = TelemedicineRequest::where('status','pending')->latest()->get();
        return view('backend.admin.telemedicine.pending',compact('telemedicine_pending_request'));
    }
    public function processing()
    {
        $telemedicine_processing_request = TelemedicineRequest::where('status','processing')->latest()->get();
        return view('backend.admin.telemedicine.processing',compact('telemedicine_processing_request'));
    }
    public function complete()
    {
        $telemedicine_complete_request = TelemedicineRequest::where('status','complete')->where('ssl_status','Completed')->latest()->get();
        return view('backend.admin.telemedicine.complete',compact('telemedicine_complete_request'));
    }
    public function cancle()
    {
        $telemedicine_complete_request = TelemedicineRequest::where('status','cancel')->latest()->get();
        //dd($telemedicine_complete_request);
        return view('backend.admin.telemedicine.cancle',compact('telemedicine_complete_request'));
    }
    public function requestShow($id)
    {
        $telemedicine_show_request = TelemedicineRequest::where('id',$id)->first();
        return view('backend.admin.telemedicine.show',compact('telemedicine_show_request'));

    }
    public function invoice($id)
    {

        $telemedicine_invoice= TelemedicineRequest::find($id);
        return view('backend.admin.service_invoice.index',compact('telemedicine_invoice'));

    }



    public function invoicePrint($id) {

        $telemedicine_invoice = TelemedicineRequest::find($id);
        //dd($telemedicine_invoice);
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/'),
            'defaultPaperSize'=> "a4"
        ])->loadView('backend.admin.service_invoice.show', compact('telemedicine_invoice'));
//dd($pdf);
        return $pdf->download('telemedicine_invoice_'.$telemedicine_invoice->code.'.pdf');

    }
}
