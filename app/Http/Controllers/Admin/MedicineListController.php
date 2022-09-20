<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\MedicineList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MedicineListController extends Controller
{

    public function index()
    {
        $medicineLists = MedicineList::latest()->get();
        return view('backend.admin.medicine_list.index',compact('medicineLists'));
    }

    public function create()
    {
        return view('backend.admin.medicine_list.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',

        ]);
        $medicineLists = new MedicineList();
        $medicineLists->name = $request->name;
        $medicineLists->save();
        Toastr::success('Medicine Created Successfully', 'Success');
        return redirect()->route('admin.medicine_list.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $medicineLists = MedicineList::find($id);
        return view('backend.admin.medicine_list.edit',compact('medicineLists'));
    }

    public function update(Request $request, $id)
    {
        $medicineLists = MedicineList::find($id);
        $medicineLists->name = $request->name;
        $medicineLists->save();
        Toastr::success('Medicine Edited Successfully', 'Success');
        return redirect()->route('admin.medicine_list.index');
    }


    public function destroy($id)
    {
        //
    }
}
