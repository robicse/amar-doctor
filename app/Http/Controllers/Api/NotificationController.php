<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public $successStatus = 201;
    public $failStatus = 401;
    public function notificationList($type)
    {
        $nofications = Notification::where('type', $type)->latest()->get();

        if (!empty($nofications)) {

            return response()->json(['success'=>true,'response' => $nofications], $this->successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'Something went wrong!'], $this->failStatus);
        }
    }
}
