<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use PDF;
use App\Model\Prescriptions;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function index(){
        $prescriptions = Prescriptions::all();
        // dd($prescription);
        return view('backend.admin.prescription.index',compact('prescriptions'));

    }
    public function show($id){
        $prescription = Prescriptions::find($id);
        return view('backend.admin.prescription.show',compact('prescription'));

    }
    public function prescriptionDownload($id) {
        $prescription = Prescriptions::find($id);
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/'),
            'defaultPaperSize'=> "a4"
        ])->loadView('backend.admin.prescription.show', compact('prescription'));
//dd($pdf);
        return $pdf->download('prescription.pdf');
    }
}
