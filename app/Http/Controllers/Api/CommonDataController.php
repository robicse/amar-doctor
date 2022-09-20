<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferListDataCollections;
use App\Http\Resources\SpecialityDataCollections;
use App\Http\Resources\SpecialityWiseDrsDataCollections;
use App\Model\Complain;
use App\Model\Degree;
use App\Model\District;
use App\Model\Lab;
use App\Model\Offer;
use App\Model\Page;
use App\Model\Reason;
use App\Model\Speciality;
use App\Model\TestChart;
use App\User;
use Illuminate\Http\Request;

class CommonDataController extends Controller
{
    public $successStatus = 201;
    public $failStatus = 401;
    public function GetDistricts()
    {
        $districts = District::all();
        if (!empty($districts)){
            return response()->json(['success'=>true,'response' =>$districts], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }
    public function GetSpecialities()
    {
        $specialities = Speciality::all();
        if (!empty($specialities)){
            $specialitiesData = new SpecialityDataCollections($specialities);
            return response()->json(['success'=>true,'response' =>$specialitiesData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }

    // content pages
    public function contentPages()
    {
        $pages = Page::all();
        if (!empty($pages)){
            return response()->json(['success'=>true,'response' =>$pages], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }
    public function getOffers()
    {
        $offers = Offer::where('is_publish', 1)->latest()->get();
        if (!empty($offers)){
            $offerData = new OfferListDataCollections($offers);
            return response()->json(['success'=>true,'response' =>$offerData], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }
    public  function reason()
    {
        $reasons= Reason::all();
        if (!empty($reasons))
        {
            return response()->json(['success'=>true,'response'=> $reasons], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }

    public function getLabs()
    {
        $labs =  Lab::all();
        if (!empty($labs))
        {
            return response()->json(['success'=>true,'response'=> $labs], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }
    public function getAllTests()
    {
        $labsTests =  TestChart::all();
        if (!empty($labsTests))
        {
            return response()->json(['success'=>true,'response'=> $labsTests], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }

    public function TestsStore(Request $request)
    {
        $test = TestChart::where('name', $request->name)->first();
        if ($test) {
            return response()->json(['success'=>false,'response'=>'Already exist this name!'], $this->failStatus);
        }else{
            $testObj = new TestChart();
            $testObj->name = $request->name;
            $testObj->save();
            return response()->json(['success'=>true,'response'=>'Successfully added!'], 200);
        }
    }

    public function getComplain()
    {
        $complains =  Complain::all();
        if (!empty($complains))
        {
            return response()->json(['success'=>true,'response'=> $complains], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }

    public function getDegrees()
    {
        $getDegrees=  Degree::all();
        if (!empty($getDegrees))
        {
            return response()->json(['success'=>true,'response'=> $getDegrees], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }

    public function createComplain(Request $request)
    {
        $checkComplain = Complain::where('name', $request->name)->first();
        if (empty($checkComplain)) {
            $complains =  new Complain();
            $complains->name =  $request->name;
            $complains->save();
            if (!empty($complains))
            {
                return response()->json(['success'=>true,'response'=> $complains], 200);
            }
            else{
                return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
            }
        }else {
            return response()->json(['success'=>false,'response'=> "Same Complain Already Exist!"], 404);
        }
    }




    //balance check for all...
    public function balanceCheck(Request $request)
    {
       $user = User::find($request->user_id);
       if ($user->balance >=  $request->amount) {
           return response()->json(['success'=>true,'response'=> 'Checked Successfully! Current Balance is '.$user->balance], 200);
       }else{
           return response()->json(['success'=>false,'response'=> 'Current Balance smaller than your withdraw amount ! Current Balance is '.$user->balance], 401);
       }
    }


}


