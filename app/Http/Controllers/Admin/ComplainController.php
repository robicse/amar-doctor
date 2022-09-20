<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Complain;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ComplainController extends Controller
{

    public function index()
    {
        $complains = Complain::latest()->get();
        return view('backend.admin.complain.index',compact('complains'));
    }


    public function create()
    {
        return view('backend.admin.complain.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',

        ]);
        $complains = new Complain();
        $complains->name = $request->name;
        $complains->save();
        Toastr::success('Complain Created Successfully', 'Success');
        return redirect()->route('admin.complain.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $complains = Complain::find($id);
        return view('backend.admin.complain.edit',compact('complains'));
    }

    public function update(Request $request, $id)
    {
        $complains = Complain::find($id);
        $complains->name = $request->name;
        $complains->save();
        Toastr::success('Complain Edited Successfully', 'Success');
        return redirect()->route('admin.complain.index');
    }

    public function destroy($id)
    {
        //
    }
}
