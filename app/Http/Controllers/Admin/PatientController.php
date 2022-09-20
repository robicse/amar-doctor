<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Patients;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(){
        $patients = Patients::latest()->get();
        return view('backend.admin.patient.index',compact('patients'));
    }

    public function show($id){
        //dd($id);
        $patients = Patients::find($id);
        return view('backend.admin.patient.show',compact('patients'));
    }
    public function update(Request $request, $id){

       // dd($request->all());
        $patients = Patients::find($id);
        $patients->name = $request->name;
        $patients->gender =$request->gender;
        $patients->gender =$request->gender;
        $patients->relationship =$request->relationship;
        $patients->age_year =$request->age_year;
        $patients->age_month =$request->age_month;
        $patients->weight =$request->weight;
        $patients->marital_status =$request->marital_status;

        $patients->save();
        $patientLists = Patients::where('id',$id)->get();
        return view('backend.admin.customer.patientList',compact('patientLists'));
       // return redirect()->route('admin.customers.paitent.show');
      //  return back();
    }


}
