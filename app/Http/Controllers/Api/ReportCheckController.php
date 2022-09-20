<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportCheckListDataCollections;
use App\Model\ReportCheck;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportCheckController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;


    public function getHistory1($user_id)
    {
        $report_check = ReportCheck::where('user_id',$user_id)->latest()->get();
        //dd($report_check);
        if (!empty($report_check)){
            $report_data = new ReportCheckListDataCollections($report_check);
            return response()->json(['success'=>true,'response' =>$report_data], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }


    public function create(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required|min:11|numeric',

        ]);
        $report_checks = new ReportCheck();
        $report_checks->user_id =  $request->user_id;
        $report_checks->name =  $request->name;
        $report_checks->phone =  $request->phone;
        $report_checks->address =  $request->address;

        $attachments = array();
        $images = $request->attachment;
        //dd($images);
       // $imagename = imageUpload($images, 'uploads/reportcheck/',0);
       // $report_checks->attachment = $imagename;
        if (isset($images)){
            foreach ($images as $image){
                if (isset($image)) {
                    $imagename = imageUpload($image, 'uploads/reportcheck/',0);
                }else {
                    $imagename = "default.png";
                }
                array_push($attachments, $imagename);
            }
            $report_checks->attachment = json_encode($attachments);
        }

        //dd($report_checks);
        $affectedRow = $report_checks->save();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => 'Data saved Successfully '], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }

}
