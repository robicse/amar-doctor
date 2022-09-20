<?php

namespace App\Http\Controllers\Api;




use App\Model\DeliveryMan;
use App\Model\DeliveryManRequest;
use App\Model\HomeServiceRequest;
use App\Model\SecmoDr;
use App\Model\SSLCommerzModel;
use App\Model\TelemedicineRequest;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Redirect;

//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Session;
use Lang;
//use Illuminate\Routing\UrlGenerator;
use App\Http\Controllers\Controller;
use Kreait\Firebase\Database;
session_start();

class PublicSslCommerzPaymentController extends Controller
{
    public $Model = '';
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['hs_req_id'] == $id) {
                return $key;
            }
        }
        return null;
    }
    function searchForDmId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['dm_req_id'] == $id) {
                return $key;
            }
        }
        return null;
    }
    public function index(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'order_id' => 'required',
        ]);
       // Session::forget('model');
        if ($request->type == 'telemedicine') {
            $this->Model = 'App\Model\TelemedicineRequest';
        }elseif($request->type == 'homeService'){
            $this->Model = 'App\Model\HomeServiceRequest';
        }elseif($request->type == 'DeliveryManRequest') {
            $this->Model = 'App\Model\DeliveryManRequest';
        }

        $order =  $this->Model::where('id',$request->order_id)->firstOrFail();
        $modeSave = new SSLCommerzModel();
        $modeSave->code = $order->code;
        $modeSave->model_name = $this->Model;
        $modeSave->save();
        $grand_total = $order->grand_total;
        $total = $grand_total;
        # Here you have to receive all the order data to initate  payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "order_id","ssl_status" field contain status of the transaction, "grand_total" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $order->code; // tran_id must be unique

        $this->Model::where('id',$request->order_id)->update(
            array(
                'code' => $post_data['tran_id'],
                'payment_type' => 'sslcommerz',
                'ssl_status' => 'Pending',
            )
        );

        #Start to save these value  in session to pick in success page.
        $_SESSION['payment_values']['tran_id']=$post_data['tran_id'];
        #End to save these value  in session to pick in success page.
        $server_name= url('/');
        $post_data['success_url'] = $server_name . "/api/success";
        $post_data['fail_url'] = $server_name . "/api/fail";
        $post_data['cancel_url'] = $server_name . "/api/cancel";

        #Before  going to initiate the payment order status need to update as Pending.
        $sslc = new SSLCommerz();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->initiate($post_data, true);
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        $Model = SSLCommerzModel::where('code',$request->tran_id)->firstOrFail()->model_name;
        //dd($Model);
        $sslc = new SSLCommerz();
        #Start to received these value from session. which was saved in index function.
        $tran_id = $request->tran_id;
        #End to received these value from session. which was saved in index function.
        #Check order status in order tabel against the transaction id or order id.


        $order_detials = $Model::where('code', $request->tran_id)->first();
            //->select('code', 'ssl_status','grand_total');
        $chekTotal= $order_detials->grand_total;

        if($order_detials->ssl_status=='Pending')
        {
            $validation = $sslc->orderValidate($tran_id, $chekTotal,'BDT', $request->all());
            if($validation == TRUE)
            {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */

                $update = $Model::where('code',$tran_id)->latest()->first();
                $update->ssl_status = 'Completed';
                if ($Model == 'App\Model\HomeServiceRequest') {
                    $update->status = 'complete';
                    $update->secmo_dr_status = 'complete';
                    $secmo = SecmoDr::find($update->secmo_dr_id);
                    $secmoUser = User::find($secmo->user_id);
                    $secmoUser->balance += $update->secmo_dr_amount;
                    $secmoUser->save();
                    $values = $this->database->getReference('homeServiceRequest')->getValue();
                    $fbKey =  $this->searchForId($update->id , $values);
                    $updateData = [
                        'status' =>'completed',
                        'secmo_dr_status' => 'completed',
                    ];
                    $dataGet = $this->database->getReference('homeServiceRequest/'.$fbKey)->update($updateData);
                    if (!$dataGet){
                        return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
                    }
                }elseif ($Model == 'App\Model\DeliveryManRequest') {
                    $update->status = 'complete';
                    $update->delivery_man_status = 'complete';
                    $deliveryManObj = DeliveryMan::find($update->delivery_man_id);
                    $dmUser = User::find($deliveryManObj->user_id);
                    $dmUser->balance += $update->delivery_man_cost;
                    $dmUser->save();
                    $values = $this->database->getReference('deliveryManRequest')->getValue();
                    $fbKey =  $this->searchForDmId($update->id , $values);
                    $updateData = [
                        'status' =>'completed',
                        'delivery_man_status' => 'completed',
                    ];
                    $dataGet = $this->database->getReference('deliveryManRequest/'.$fbKey)->update($updateData);
                    if (!$dataGet){
                        return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
                    }
                }
                    else {
                    $update->status = 'pending';
                }

                $update->payment_details = json_encode($_POST);
                $update->save();
                if (!empty($update)) {
                    return response()->json(['success' => true, 'response' => 'SSL Payment Success'], 200);
                } else {
                    return response()->json(['success' => false, 'response' => 'Something Went Wrong!'], 401);
                }
            }
            else
            {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */

                //return redirect('api/ssl/redirect/fail');
                return response()->json(['success' => false, 'response' => 'SSL Payment Failed!'], 401);
            }
        }
        else if($order_detials->ssl_status=='Processing' || $order_detials->ssl_status=='Complete')
        {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */

            //return redirect('api/ssl/redirect/fail');
            return response()->json(['success' => false, 'response' => 'SSL Payment Failed!'], 401);
        }
        else{
            //return redirect('api/ssl/redirect/fail');
            return response()->json(['success' => false, 'response' => 'SSL Payment Failed!'], 401);
        }
    }

    public function fail(Request $request)
    {
        //dd($request->all());
        $Model = SSLCommerzModel::where('code',$request->tran_id)->firstOrFail()->model_name;
        //dd($Model);
        $tran_id = $request->tran_id;
        $order_detials = $Model::where('code', $tran_id)->first();
           // ->select('id', 'ssl_status','grand_total')->first();

        if($order_detials->ssl_status=='Pending'){
            $Model::where('code', $tran_id)->update(['ssl_status' => 'Failed']);
            //return redirect('api/ssl/redirect/fail');
            return response()->json(['success' => false, 'response' => 'SSL Payment Failed!'], 401);
        }else if($order_detials->ssl_status=='Processing' || $order_detials->ssl_status=='Complete'){
            //return redirect('api/ssl/redirect/success');
            return response()->json(['success' => false, 'response' => 'SSL Payment Failed!'], 401);
        }else{
            $Model::where('code', $tran_id)
                ->update(['ssl_status' => 'Failed']);
            //return redirect('api/ssl/redirect/fail');
            return response()->json(['success' => false, 'response' => 'SSL Payment Failed!'], 401);
        }
    }

    public function cancel(Request $request)
    {
        $Model = SSLCommerzModel::where('code',$request->tran_id)->firstOrFail()->model_name;
         $tran_id = $request->tran_id;
        $order_detials = $Model::where('code', $tran_id)
            ->select('id', 'ssl_status','grand_total')->first();

        if($order_detials->ssl_status=='Pending')
        {
            $Model::where('code', $tran_id)
                ->update(['ssl_status' => 'Canceled']);
            //echo "Transaction is Cancel";
            return response()->json(['success' => false, 'response' => 'SSL Payment Canceled!'], 401);
        }
        else if($order_detials->ssl_status=='Processing' || $order_detials->ssl_status=='Complete')
        {
//            echo "Transaction is already Successful";
            //return redirect('api/ssl/redirect/success');
            return response()->json(['success' => true, 'response' => 'SSL Payment already completed!'], 200);
        }
        else
        {
            //return redirect('api/ssl/redirect/cancel');
            return response()->json(['success' => false, 'response' => 'SSL Payment Canceled!'], 401);
        }


    }
    public function ipn(Request $request)
    {
        $Model = SSLCommerzModel::where('code',$request->tran_id)->firstOrFail()->model_name;
        #Received all the payement information from the gateway
        if($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = $Model::where('code', $tran_id)
                ->select('id', 'ssl_status','grand_total')->first();

            if($order_details->ssl_status =='Pending')
            {
                $sslc = new SSLCommerz();
                $validation = $sslc->orderValidate($tran_id, $order_details->grand_total, $request->all());
                if($validation == TRUE)
                {
                    /*
                     *
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successfull transaction to customer
                    */
                    $update_product = $Model::where('code', $tran_id)
                        ->update(['ssl_status' => 'Complete']);
                    return response()->json(['success' => true, 'response' => 'SSL Payment completed!'], 200);
                    //echo "Transaction is successfully Complete";
                }
                else
                {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $Model::where('id', $tran_id)
                        ->update(['ssl_status' => 'Failed','coupon_discount' => $_SESSION['olddiscount'],
                            'grand_total' => $_SESSION['oldtotal']]);
                    return response()->json(['success' => false, 'response' => 'SSL Payment Validation Failed!'], 401);
                    //echo "validation Fail";
                }

            }
            else if($order_details->ssl_status == 'Processing' || $order_details->ssl_status =='Complete')
            {
                #That means Order status already updated. No need to udate database.
                //echo "Transaction is already successfully Complete";
                return response()->json(['success' => true, 'response' => 'SSL Payment  Completed'], 200);
            }
            else
            {
                //echo "Invalid Transaction";
                return response()->json(['success' => false, 'response' => 'SSL Payment Invalid!'], 401);
            }
        }
        else
        {
            //echo "Inavalid Data";
            return response()->json(['success' => false, 'response' => 'SSL Payment Invalid!'], 401);
        }
    }
    public function status($status)
    {
        dd('status');
        return view("status",compact('status'));
    }
    public function statusWeb($status)
    {
        return view("status",compact('status'));
    }
}


