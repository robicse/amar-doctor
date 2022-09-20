<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TestChart;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TestChartController extends Controller
{

    public function index()
    {
        $test_charts = TestChart::latest()->get();
        return view('backend.admin.test-chart.index',compact('test_charts'));
    }


    public function create()
    {
        return view('backend.admin.test-chart.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',

        ]);
        $test_charts = new TestChart();
        $test_charts->name = $request->name;
        $test_charts->save();
        Toastr::success('Test chart Created Successfully', 'Success');
        return redirect()->route('admin.test_chart.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $test_charts = TestChart::find($id);
        return view('backend.admin.test-chart.edit',compact('test_charts'));
    }

    public function update(Request $request, $id)
    {
        $test_charts = TestChart::find($id);
        $test_charts->name = $request->name;
        $test_charts->save();
        Toastr::success('Test chart Edited Successfully', 'Success');
        return redirect()->route('admin.test_chart.index');
    }


    public function destroy($id)
    {
        //
    }
}
