<?php

namespace App\Http\Controllers\Admin;

use App\Model\Degree;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DegreeController extends Controller
{

    public function index()
    {
        $degrees = \App\Model\Degree::latest()->get();
        return view('backend.admin.degree.index',compact('degrees'));
    }


    public function create()
    {
        return view('backend.admin.degree.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',

        ]);
        $degrees = new Degree();
        $degrees->name = $request->name;
        $degrees->save();
        Toastr::success('Degree Created Successfully', 'Success');
        return redirect()->route('admin.doctor_degree.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $degrees = Degree::find($id);
        return view('backend.admin.degree.edit',compact('degrees'));
    }

    public function update(Request $request, $id)
    {
        $degrees = Degree::find($id);
        $degrees->name = $request->name;
        $degrees->save();
        Toastr::success('Degree Edited Successfully', 'Success');
        return redirect()->route('admin.doctor_degree.index');
    }


    public function destroy($id)
    {
        //
    }
}
