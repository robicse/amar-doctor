<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Reason;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ReasonController extends Controller
{

    public function index()
    {
        $reasons = Reason::latest()->get();
       // dd($reasons);
        return view('backend.admin.reasons.index',compact('reasons'));
    }


    public function create()
    {
        return view('backend.admin.reasons.create');
    }


    public function store(Request $request)
    {
        $reasons = new Reason();
        $reasons->problem = $request->problem;
        $reasons->save();
        Toastr::success('Offer Created Successfully');
        return redirect()->route('admin.reasons.index');
    }

    public function edit($id)
    {
        $reasons = Reason::find($id);
        return view('backend.admin.reasons.edit', compact( 'reasons'));

    }

    public function update(Request $request, $id)
    {
        $reasons = Reason::find($id);
        $reasons->problem = $request->problem;
        $reasons->save();
        Toastr::success('Offer Updated Successfully');
        return redirect()->route('admin.reasons.index');
    }

    public function destroy($id)
    {
        $reasons = Reason::find($id);

        $reasons->delete();
        Toastr::success('Offer Deleted Successfully');
        return back();
    }

}
