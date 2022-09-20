<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Speciality;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SpecialityController extends Controller
{

    public function index()
    {
        $speciality = Speciality::latest()->get();
        return view('backend.admin.speciality.index',compact('speciality'));
    }


    public function create()
    {
        return view('backend.admin.speciality.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',

        ]);
        $speciality = new Speciality();
        $speciality->name = $request->name;
        $speciality->slug = Str::slug($request->name);


        $speciality->status = 1;
        $image = $request->file('icon');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(370, 250)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/special/' . $imagename, $proImage);
        }else {
            $imagename = "default.png";
        }

        $speciality->icon = $imagename;
        $speciality->description = $request->description;
        $speciality->save();
        Toastr::success('Speciality Created Successfully', 'Success');
        return redirect()->route('admin.speciality.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $speciality = Speciality::find($id);
        return view('backend.admin.speciality.edit',compact('speciality'));
    }


    public function update(Request $request, $id)
    {
        $speciality = Speciality::find($id);
        $speciality->name = $request->name;
        $speciality->slug = Str::slug($request->name);
        $speciality->status = 1;


        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if (Storage::disk('public')->exists('uploads/special/'. $speciality->image)) {
                Storage::disk('public')->delete('uploads/special/'. $speciality->image);
            }
            $proImage = Image::make($image)->resize(370, 250)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/special/' . $image_name, $proImage);
        }
        else {
            $image_name =$speciality->icon;
        }
        $speciality->icon = $image_name;
        $speciality->description = $request->description;

        $speciality->save();
        Toastr::success('Speciality Edited Successfully', 'Success');
        return redirect()->route('admin.speciality.index');
    }

    public function destroy($id)
    {
        $speciality = Speciality::find($id);
        Storage::disk('public')->delete('uploads/special/' . $speciality->icon);
        $speciality->delete();
        Toastr::success('Speciality Deleted Successfully!');
        return redirect()->route('admin.speciality.index');
    }
}
