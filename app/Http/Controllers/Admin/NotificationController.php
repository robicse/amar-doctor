<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Notification;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class NotificationController extends Controller
{

    public function index()
    {
        $notifications = Notification::latest()->get();
        return view('backend.admin.notification.index',compact('notifications'));
    }


    public function create()
    {
        return view('backend.admin.notification.create');
    }


    public function store(Request $request)
    {
        $notifications = new Notification();
        $notifications->type = $request->type;
        $notifications->text = $request->text;
        $notifications->save();
        Toastr::success('Notification Created Successfully', 'Success');
        return redirect()->route('admin.notification.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $notifications = Notification::find($id);
        return view('backend.admin.notification.edit',compact('notifications'));
    }


    public function update(Request $request, $id)
    {
        $notifications =  Notification::find($id);
        $notifications->type = $request->type;
        $notifications->text = $request->text;
        $notifications->save();
        Toastr::success('Notification Updated Successfully', 'Success');
        return redirect()->route('admin.notification.index');
    }


    public function destroy($id)
    {
        $notifications =  Notification::find($id);
        $notifications->destroy();
        Toastr::success('Notification Deleted Successfully', 'Success');
        return redirect()->route('admin.notification.index');
    }
}
