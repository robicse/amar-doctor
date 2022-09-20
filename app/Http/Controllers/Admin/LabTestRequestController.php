<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Lab;
use App\Model\LabSampleCollector;
use App\Model\LabTestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use function GuzzleHttp\Promise\all;

class LabTestRequestController extends Controller
{
    public function index(){

        $last_test_request = LabTestRequest::latest()->get();
        return view('backend.admin.lab_test_request.index',compact('last_test_request'));
    }

    public function show(Request $request, $id){

        $last_test_request = LabTestRequest::find($id);
        $labs = Lab::latest()->get();
        $lab_sample_collector = LabSampleCollector::latest()->get();
        return view('backend.admin.lab_test_request.show',compact('last_test_request','labs','lab_sample_collector'));
    }
    public function update(Request $request, $id){

      //  dd($request->all());
        $last_test_request = LabTestRequest::find($id);
        $last_test_request->lab_id = $request->lab_id;
        $last_test_request->lab_sample_collectors_id =$request->lab_sample_collectors_id;
        $last_test_request->phone =$request->phone;
        $last_test_request->address =$request->address;
        $last_test_request->investigation_chart =$request->investigation_chart;
        $last_test_request->test_amount =$request->test_amount;
        $last_test_request->status =$request->status;
        $image = $request->file('test_photo');

        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if (Storage::disk('public')->exists('uploads/test_photo/'. $last_test_request->test_photo)) {
                Storage::disk('public')->delete('uploads/test_photo/'. $last_test_request->test_photo);
            }
            $proImage = Image::make($image)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/test_photo/' . $image_name, $proImage);
        }
        else {
            $image_name =$last_test_request->test_photo;
        }
        $last_test_request->test_photo = $image_name;


        $last_test_request->save();
        return redirect()->route('admin.lab_test_request');
    }
}
