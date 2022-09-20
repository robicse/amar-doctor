<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('id','desc')->get();
        return view('backend.admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('backend.admin.coupons.create');
    }

    public function store(Request $request)
    {
        if(count(Coupon::where('code', $request->code)->get()) > 0){
            Toastr::error('Coupon already exist for this coupon code');
            return back();
        }
            $coupon = new Coupon();
            $coupon->code = $request->code;
            $coupon->discount = $request->discount;
//            $coupon->discount_type = $request->discount_type;
            $coupon->start_date = ($request->start_date);
            $coupon->end_date = $request->end_date;
            $coupon->end_date = $request->end_date;
            $coupon->details = $request->details;
            if ($coupon->save()) {
                Toastr::success('Coupon has been saved successfully');
                return redirect()->route('admin.coupon.index');
            }
            else{
                Toastr::error('Something went wrong');
                return back();
            }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
//        $coupon->discount_type = $request->discount_type;
        $coupon->start_date = ($request->start_date);
        $coupon->end_date = $request->end_date;
        $coupon->details = $request->details;
        if ($coupon->save()) {
            Toastr::success('Coupon has been saved successfully');
            return redirect()->route('admin.coupon.index');
        }
        else{
            Toastr::error('Something went wrong');
            return back();
        }

    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        if(Coupon::destroy($id)){
            Toastr::success('Coupon has been deleted successfully');
            return redirect()->route('admin.coupon.index');
        }

        Toastr::error('Something went wrong');
        return back();
    }
    public function get_coupon_form(Request $request)
    {
        if($request->coupon_type == "product_base") {
            return view('backend.partials.product_base_coupon');
        }
        elseif($request->coupon_type == "cart_base"){
            return view('backend.partials.cart_base_coupon');
        }
    }
    public function get_coupon_form_edit(Request $request)
    {
        if($request->coupon_type == "product_base") {
            $coupon = Coupon::findOrFail($request->id);
            return view('backend.partials.product_base_coupon_edit',compact('coupon'));
        }
        elseif($request->coupon_type == "cart_base"){
            $coupon = Coupon::findOrFail($request->id);
            return view('backend.partials.cart_base_coupon_edit',compact('coupon'));
        }
    }
}
