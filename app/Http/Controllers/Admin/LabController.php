<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Lab;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class LabController extends Controller
{

    public function index()
    {
        $labs = Lab::latest()->get();
        return view('backend.admin.labs.index',compact('labs'));
    }


    public function create()
    {
        return view('backend.admin.labs.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',

        ]);
        $labs = new Lab();
        $labs->name = $request->name;
        $labs->slug = Str::slug($request->name);
        $labs->email = $request->email;
        $labs->address = $request->address;
        $labs->phone = $request->phone;

        $image = $request->file('logo');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(370, 250)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/lab/'. $imagename, $proImage);
        }else {
            $imagename = "default.png";
        }

        $labs->logo = $imagename;
        $labs->save();
        Toastr::success('Lab Created Successfully', 'Success');
        return redirect()->route('admin.lab.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $lab = Lab::find($id);
        return view('backend.admin.labs.edit',compact('lab'));
    }


    public function update(Request $request, $id)
    {
        $lab = Lab::find($id);
        $lab->name = $request->name;
        $lab->slug = Str::slug($request->name);
        $lab->email = $request->email;
        $lab->address = $request->address;
        $lab->phone = $request->phone;

        $image = $request->file('logo');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if (Storage::disk('public')->exists('uploads/lab/'. $lab->logo)) {
                Storage::disk('public')->delete('uploads/lab/'. $lab->logo);
            }
            $proImage = Image::make($image)->resize(370, 250)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/lab/' . $image_name, $proImage);
        }
        else {
            $image_name =$lab->logo;
        }
        $lab->logo = $image_name;

        $lab->save();
        Toastr::success('Lab Edited Successfully', 'Success');
        return redirect()->route('admin.lab.index');
    }


    public function destroy($id)
    {
        //
    }
}
