<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ExperiencesDataCollections;
use App\Model\Experience;
use App\Http\Controllers\Controller;
use App\Model\SpecialistDr;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function index()

    {
        $experiences = Experience::latest()->get();
        if($experiences)
        {
            $success['experiences'] =  $experiences;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Clinic Doctor List Found!'], $this->failStatus);
        }
    }

    public function create(Request $request)
    {
       //dd($request->all());
        $experiences = new Experience();
        $experiences->specialist_dr_id =  $request->specialist_dr_id;
        $experiences->department =  $request->department;
        $experiences->institute_name =  $request->institute_name;
        $experiences->designation =  $request->designation;
        $experiences->employment_period_from =  $request->employment_period_from;
        $experiences->employment_period_to =  $request->employment_period_to;
        $experiences->period =  $request->period;

        if( $experiences->save()){
            return response()->json(['success'=>true,'response' => $experiences], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }


    public function update(Request $request)
    {
        $experiences = Experience::find($request->exprince_tbl_id);
        $experiences->specialist_dr_id =  $request->specialist_dr_id;
        $experiences->institute_name =  $request->institute_name;
        $experiences->department =  $request->department;
        $experiences->designation =  $request->designation;
        $experiences->employment_period_from =  $request->employment_period_from;
        $experiences->employment_period_to =  $request->employment_period_to;
        $experiences->period =  $request->period;
        $affectedRow = $experiences->save();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => $experiences], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }

    public function getDataByDocId($docId)
    {
        $experiences = Experience::where('specialist_dr_id', $docId)->get();
        if(!empty($experiences)){
            $experiencesData = new ExperiencesDataCollections($experiences);
            return response()->json(['success'=>true,'response' => $experiencesData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }

    public function destroy($id)
    {

    }

    public function updateAbout(Request $request)
    {
        $about = SpecialistDr::find($request->specialist_dr_id);
        $about->about = $request->about;
        $about->save();
        if(!empty($about)){
            return response()->json(['success'=>true,'response' => 'Data successfully updated.'], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }
}
