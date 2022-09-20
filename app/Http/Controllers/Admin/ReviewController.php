<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\DeliveryManRequest;
use App\Model\DmServiceReview;
use App\Model\HomeServiceReview;
use App\Model\Review;
use App\Model\TelemedicineReview;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    //// TelemedicineRequest Review
    public function index(){

        $value = null;
        $reviews = null;
        return view('backend.admin.review.index',compact('reviews','value'));
    }
    public function reviewDetails(Request $request){
       // dd( $request->rating);
        $value = $request->rating;
        $reviews = TelemedicineReview::where('rating',$value)->get();
        return view('backend.admin.review.index',compact('value','reviews'));
    }
    public function show($id){
        $review = TelemedicineReview::find($id);
        if($review->viewed == 0){
            $review->viewed = 1;
            $review->save();
        }
        return view('backend.admin.review.show',compact('review'));
    }
    public function reviewUpdate(Request $request, $id) {
        $review = TelemedicineReview::find($id);
        $review->comment = $request->comment;
        $review->save();
        Toastr::success('Review Updated Successfully');
        return redirect()->route('admin.reviews.index');
    }
    public function updateStatus(Request $request){
        $review = TelemedicineReview::findOrFail($request->id);
        $review->status = $request->status;
        if($review->save()){
            return 1;
        }
        return 0;
    }
//// Home Service Review

    public function homeServiceIndex(){

        $value = null;
        $reviews = null;
        return view('backend.admin.review.home_service_index',compact('reviews','value'));
    }
    public function homeServiceReviewDetails(Request $request){
        $value = $request->rating;
        $reviews = HomeServiceReview::where('rating',$value)->get();
        return view('backend.admin.review.home_service_index',compact('value','reviews'));
    }

    public function updateHomeServiceStatus(Request $request){
        $review = HomeServiceReview::findOrFail($request->id);
        $review->status = $request->status;
        if($review->save()){
            return 1;
        }
        return 0;
    }
    public function homeServiceShow($id){
        $review = HomeServiceReview::find($id);
        if($review->viewed == 0){
            $review->viewed = 1;
            $review->save();
        }
        return view('backend.admin.review.homeServiceShow',compact('review'));
    }

    public function homeServiceReviewUpdate(Request $request, $id) {
        $review = TelemedicineReview::find($id);
        $review->comment = $request->comment;
        $review->save();
        Toastr::success('Review Updated Successfully');
        return redirect()->route('admin.reviews.index');
    }


    //// Delivery Service Review

    public function deliveryServiceIndex(){

        $value = null;
        $reviews = null;
        return view('backend.admin.review.delivery_service_index',compact('reviews','value'));
    }
    public function deliveryServiceReviewDetails(Request $request){
        $value = $request->rating;
        $reviews = DmServiceReview::where('rating',$value)->get();
        return view('backend.admin.review.delivery_service_index',compact('value','reviews'));
    }

    public function updateDeliveryServiceStatus(Request $request){
        $review = DmServiceReview::findOrFail($request->id);
        $review->status = $request->status;
        if($review->save()){
            return 1;
        }
        return 0;
    }
    public function deliveryServiceShow($id){
        $review = DmServiceReview::find($id);
        if($review->viewed == 0){
            $review->viewed = 1;
            $review->save();
        }
        return view('backend.admin.review.deliveryServiceShow',compact('review'));
    }

    public function deliveryServiceReviewUpdate(Request $request, $id) {
        $review = DmServiceReview::find($id);
        $review->comment = $request->comment;
        $review->save();
        Toastr::success('Review Updated Successfully');
        return redirect()->route('admin.reviews.delivery_service_index');
    }
}
