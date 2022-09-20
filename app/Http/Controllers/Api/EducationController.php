<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EducationalQualificationDataCollections;
use App\Model\EducationalQualification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function index()
    {
        $educations = EducationalQualification::latest()->get();
        if($educations)
        {
            $success['educational_qualifications'] =  $educations;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Clinic Doctor List Found!'], $this->failStatus);
        }
    }


    public function create(Request $request)
    {
        // dd($request->all());
        $educations = new EducationalQualification();
        $educations->degree_id =  $request->degree_id;
        $educations->specialist_dr_id =  $request->specialist_dr_id;
        $educations->institute_name =  $request->institute_name;
        $educations->country_name =  $request->country_name;
        $educations->passing_year =  $request->passing_year;
        $educations->duration =  $request->duration;
        $affectedRow = $educations->save();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => $educations], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }


    public function update(Request $request)
    {
        $educations = EducationalQualification::find($request->edu_quli_tbl_id);
        $educations->degree_id =  $request->degree_id;
        $educations->specialist_dr_id =  $request->specialist_dr_id;
        $educations->institute_name =  $request->institute_name;
        $educations->country_name =  $request->country_name;
        $educations->passing_year =  $request->passing_year;
        $educations->duration =  $request->duration;
        $affectedRow = $educations->save();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => $educations], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }

    public function getDataByDocId($docId)
    {
        $educations = EducationalQualification::where('specialist_dr_id', $docId)->get();
        if(!empty($educations)){
            $educationsData = new EducationalQualificationDataCollections($educations);
            return response()->json(['success'=>true,'response' => $educationsData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }

    public function destroy($id)
    {
        //
    }
}
