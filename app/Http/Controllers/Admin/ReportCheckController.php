<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ReportCheck;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;


class ReportCheckController extends Controller
{
    public function index()
    {
        $report_checks = ReportCheck::latest()->get();
        // dd($reasons);
        return view('backend.admin.report_check.index',compact('report_checks'));
    }
    public function show($id)
    {
        $report_checks = ReportCheck::find($id);
        $report_images = json_decode($report_checks->attachment,true);
       //dd($report_images);
        return view('backend.admin.report_check.show',compact('report_checks','report_images'));
    }
    public function reportStatus(Request $request,$id)
    {
       //dd($request->all());
        $report_checks = ReportCheck::find($id);

        $report_checks->status = $request->status;
        $report_checks->save();
        if ($request->status == 'complete') {
            $report_checks->save();
        }
        elseif ($request->status == 'processing'){
            $report_checks->save();
            }

        Toastr::success('Report Checking Status successfully changed');
        return redirect()->back();

    }

}
