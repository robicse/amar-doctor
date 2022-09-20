<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Page;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about(){
        return view('frontend.pages.about');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function termsAndCondition(){
        $termsAndConditions = Page::where('type','terms_and_condition')->latest()->first();
        return view('frontend.pages.terms_and_conditions',compact('termsAndConditions'));
    }

    public function privacy(){
        $privacy = Page::where('type','privacy_policy')->latest()->first();
        return view('frontend.pages.privacy',compact('privacy'));
    }
    public function faq()
    {
        return view('frontend.pages.faq');
    }
    public function paymentTerms(){
        $paymentTerms = Page::where('type','payments_term')->latest()->first();
        return view('frontend.pages.payment_terms',compact('paymentTerms'));
    }
}
