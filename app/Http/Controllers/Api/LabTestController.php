<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\LabTestListDataCollections;
use App\Model\LabTestRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LabTestController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function postLabTestReport(Request $request)
    {
        $labTestData = new LabTestRequest();
        $labTestData->user_id =  $request->user_id;
        $labTestData->lab_id = $request->lab_id;
        $labTestData->lab_sample_collectors_id =$request->lab_sample_collectors_id;
        $labTestData->name =$request->full_name;
        $labTestData->phone =$request->phone;
        $labTestData->address =$request->address;
        $labTestData->investigation_chart =$request->investigation_chart;
        $labTestData->test_amount =$request->test_amount;
        $labTestData->status ='pending';
        $attachments = array();
        $images = $request->file('test_photo');
        if (isset($images)){
            foreach ($images as $image){
                if (isset($image)) {
                    $imagename = imageUpload($image, 'uploads/test_photo/',0);
                }else {
                    $imagename = "default.png";
                }
                array_push($attachments, $imagename);
            }
            $labTestData->test_photo = json_encode($attachments);
        }

        $affectedRow = $labTestData->save();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => $labTestData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }
    public function getLabTestReport($userId)
    {
        $labTestData =  LabTestRequest::where('user_id', $userId)->latest()->get();
        if($labTestData){
            $labTestDataArr = new LabTestListDataCollections($labTestData);
            return response()->json(['success'=>true,'response' => $labTestDataArr], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something Went Wrong!'], $this->failStatus);
        }
    }


}
