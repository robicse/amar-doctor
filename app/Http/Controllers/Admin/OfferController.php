<?php

namespace App\Http\Controllers\Admin;

use App\Model\DoctorOffer;
use App\Http\Controllers\Controller;
use App\Model\Offer;
use App\Model\OfferRequest;
use App\Model\SpecialistDr;
use App\Model\Speciality;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::latest()->get();
        return view('backend.admin.offers.index', compact('offers'));

    }

    public function create()
    {
        $speciality = Speciality::all();
        return view('backend.admin.offers.create', compact('speciality'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'offer_title' => 'required',
            'short_description' => 'required',
            'offer_cost' => 'required',
        ]);
        $offer = new Offer();
        $offer->specialty_id = $request->specialty_id;
        $offer->offer_title = $request->offer_title;
        $offer->short_description = $request->short_description;
        $offer->offer_cost = $request->offer_cost;
        $offer->is_publish = 0;
        $offer->save();
        Toastr::success('Offer Created Successfully');
        return redirect()->route('admin.offers.index');
    }

    public function edit($id)
    {
        $speciality = Speciality::all();
        $offer = Offer::find($id);
        return view('backend.admin.offers.edit', compact('offer', 'speciality'));

    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'offer_title' => 'required',
            'short_description' => 'required',
            'offer_cost' => 'required',
        ]);
        $offer = Offer::find($id);
        $offer->specialty_id = $request->specialty_id;
        $offer->offer_title = $request->offer_title;
        $offer->short_description = $request->short_description;
        $offer->offer_cost = $request->offer_cost;
        $offer->save();
        Toastr::success('Offer Updated Successfully');
        return redirect()->route('admin.offers.index');
    }

    public function destroy($id)
    {
        $offer = Offer::find($id);

        $offer->delete();
        Toastr::success('Offer Deleted Successfully');
        return back();
    }

    public function is_publish(Request $request)
    {
        $offer = Offer::find($request->id);
        $offer->is_publish = $request->status;
        if ($offer->save()) {
            return 1;
        }
        return 0;
    }


    public function show(Request $request, $id)
    {

        $speciality = Speciality::all();

        $specialist_drs = DB::table("offers")
                         ->where("offers.id", $id)
                        ->join('dr_specialities', "offers.specialty_id", "dr_specialities.specialities_id")
                        ->join('specialist_drs', "dr_specialities.specialist_dr_id", "specialist_drs.id")
                        ->join('users', "specialist_drs.user_id", '=',"users.id")
                        ->select('users.name','users.phone','specialist_drs.bmdc','specialist_drs.title','specialist_drs.id')
                        ->get();

        $drOffers = DB::table("dr_offers")
            ->where("dr_offers.offer_id", $id)
            ->pluck('dr_offers.specialist_dr_id', 'dr_offers.specialist_dr_id')
            ->all();

        $drOffers_id = DoctorOffer::where('offer_id', $id)->first();

        $offer = Offer::find($id);

        return view('backend.admin.offers.show', compact('drOffers', 'specialist_drs', 'offer', 'speciality', 'drOffers_id'));
    }

    public function searchDoctors(Request $request)
    {
        //dd($request->all());
        $speciality = Speciality::all();

        $specialist_drs = DB::table("offers")
            ->where("offers.id", $request->offerId)
            ->join('dr_specialities', "offers.specialty_id", "dr_specialities.specialities_id")
            ->join('specialist_drs', "dr_specialities.specialist_dr_id", "specialist_drs.id")
            ->join('users', "specialist_drs.user_id", '=',"users.id")
            ->where('users.name', 'LIKE', '%'. $request->q. '%')
            ->orWhere('users.phone', 'LIKE', '%'. $request->q. '%')
            ->orWhere('specialist_drs.bmdc', 'LIKE', '%'. $request->q. '%')
            ->select('users.name','users.phone','specialist_drs.bmdc','specialist_drs.title','specialist_drs.id')
            ->get();

        $drOffers = DB::table("dr_offers")
            ->where("dr_offers.offer_id", $request->offerId)
            ->pluck('dr_offers.specialist_dr_id', 'dr_offers.specialist_dr_id')
            ->all();

        $drOffers_id = DoctorOffer::where('offer_id', $request->offerId)->first();

        $offer = Offer::find($request->offerId);

        return view('backend.admin.offers.offer_show partial', compact('drOffers', 'specialist_drs', 'offer', 'speciality', 'drOffers_id'));
    }

    public function singleDrInset(Request $request)
    {
        $drOffers = new DoctorOffer();
        $drOffers->offer_id = $request->offerId;
        $drOffers->specialist_dr_id = $request->drId;
        $drOffers->save();
        return 1;
    }
    public function singleDrDelete(Request $request)
    {
        $drOffers =  DoctorOffer::where('offer_id',$request->offerId)->where('specialist_dr_id',$request->drId)->first();
        if (!empty($drOffers)){
            $drOffers->delete();
            return 1;
        }else{
            return 0;
        }
    }
    public function drOfferStore(Request $request)
    {
        $dr_offers_id = $request->dr_offers_id;
        if (!empty($request->specialist_dr_id)) {
            DoctorOffer::where('offer_id',$dr_offers_id)->delete();
            foreach ($request->specialist_dr_id as $offerDr) {
                $drOffers = new DoctorOffer();
                $drOffers->offer_id = $dr_offers_id;
                $drOffers->specialist_dr_id = $offerDr;
                $drOffers->save();
            }
        } else {
            Toastr::warning('Please select at least one doctor!');
            return back();
        }
        Toastr::success('Doctor Selected Successfully');
        return redirect()->back();
    }

    public function pending()

    {
        $offers_pending_request = OfferRequest::where('status','pending')->latest()->get();

        return view('backend.admin.offers.pending',compact('offers_pending_request'));
    }
    public function processing()
    {
        $offers_processing_request = OfferRequest::where('status','processing')->latest()->get();
        return view('backend.admin.offers.processing',compact('offers_processing_request'));
    }
    public function complete()
    {
        $offers_complete_request = OfferRequest::where('status','complete')->latest()->get();
        return view('backend.admin.offers.complete',compact('offers_complete_request'));
    }
    public function cancle()
    {
        $offers_cancel_request = OfferRequest::where('status','cancel')->latest()->get();
        //dd($telemedicine_complete_request);
        return view('backend.admin.offers.cancle',compact('offers_cancel_request'));
    }
    public function requestShow($id)
    {
        $offers_show_request = OfferRequest::where('id',$id)->first();
        return view('backend.admin.offers.request_details',compact('offers_show_request'));


    }

}
