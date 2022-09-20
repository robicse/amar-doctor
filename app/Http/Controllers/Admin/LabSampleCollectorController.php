<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Lab;
use App\Model\LabSampleCollector;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class LabSampleCollectorController extends Controller
{

    public function index()
    {
        $sample_collectors = LabSampleCollector::latest()->get();
        return view('backend.admin.sample_collector.index',compact('sample_collectors'));
    }


    public function create()
    {
        $labs = Lab::all();
        return view('backend.admin.sample_collector.create',compact('labs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',

        ]);
        $sample_collectors = new LabSampleCollector();
        $sample_collectors->name = $request->name;
        $sample_collectors->lab_id = $request->lab_id;
        $sample_collectors->email = $request->email;
        $sample_collectors->address = $request->address;
        $sample_collectors->phone = $request->phone;


        $sample_collectors->save();
        Toastr::success('Lab Sample Collector Created Successfully', 'Success');
        return redirect()->route('admin.lab_sample_collector.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $labs = Lab::all();
        $sample_collectors = LabSampleCollector::find($id);
        return view('backend.admin.sample_collector.edit',compact('labs','sample_collectors'));
    }


    public function update(Request $request, $id)
    {
        $sample_collectors = LabSampleCollector::find($id);
        $sample_collectors->name = $request->name;
        $sample_collectors->lab_id = $request->lab_id;
        $sample_collectors->email = $request->email;
        $sample_collectors->address = $request->address;
        $sample_collectors->phone = $request->phone;


        $sample_collectors->save();
        Toastr::success('Lab Sample Collector Edited Successfully', 'Success');
        return redirect()->route('admin.lab_sample_collector.index');
    }


    public function destroy($id)
    {
        //
    }
}
