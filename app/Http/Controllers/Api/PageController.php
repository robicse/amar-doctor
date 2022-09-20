<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public $successStatus = 201;
    public $failStatus = 401;

    public function getTermsAndCondition()
    {

        $termsAndConditions = Page::where('type','terms_and_condition')->latest()->get();
        if (!empty($termsAndConditions)){
            return response()->json(['success'=>true,'response' =>$termsAndConditions], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response' =>'Something went wrong!'], $this->failStatus);
        }
    }
}
