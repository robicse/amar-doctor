<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TelemedicinePaymentHistoryDataListCollections;
use App\Model\TelemedicineRequest;
use App\Model\Transaction;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    public function getHistory($userId)
    {
        $transaction = Transaction::where('user_id', $userId)->latest()->get();
        if (!empty($transaction)) {
            return response()->json(['success' => true, 'response' => $transaction], 200);
        }else {
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }
    }
    public function telemedicinePaymentHistory($userId)
    {
        $paymentHistory = TelemedicineRequest::where('user_id',$userId)->where('status','complete')->where('ssl_status','Completed')->get();
        if (isset($paymentHistory)) {
            $paymentHistoryData = new TelemedicinePaymentHistoryDataListCollections($paymentHistory);
            return response()->json(['success' => true, 'response' => $paymentHistoryData], 200);
        }else {
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }
    }
}
