<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QueueCollections;
use App\Model\CallQueue;
use App\Model\TelemedicineRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Kreait\Firebase\Database;

class CallQueueController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function storeCallQueue(Request $request )
    {
        $callQueue = new CallQueue();
        $callQueue->user_id = $request->user_id;
        $callQueue->specialist_dr_id = $request->specialist_dr_id;
        $callQueue->request_id = $request->request_id;
        $callQueue->request_type = $request->request_type;
        $callQueue->channel_name = $request->channel_name;
        $callQueue->token = $request->token;
        $callQueue->status = 'pending';
        $callQueue->patient_status = 'pending';
        $callQueue->save();
        if (!empty($callQueue)){
            $postData = [
                'queue_tbl_id' => $callQueue->id,
                'user_id' => $request->user_id,
                'specialist_dr_id' => $request->specialist_dr_id,
                'request_id' => $request->request_id,
                'request_type' => $request->request_type,
                'channel_name' => $request->channel_name,
                'token' => $request->token,
                'status' => $callQueue->status,
                'patient_status' => $callQueue->patient_status,
                'prescription' => 'pending',
                'prescription_url' => '',
                'call_by_doc_to_user' => 0
            ];
            $dataPostFirebase = $this->database->getReference('callQueue')->push($postData);
            if (!$dataPostFirebase){
                return response()->json(['success'=>false,'response' =>'Something went wrong in firebase!'], $this->failStatus);
            }

            return response()->json(['success' => true, 'response' => $callQueue->id], 200);
        }else{
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], 401);
        }
    }
    public function getCallQueue($drId)
    {
        $callQueue =  CallQueue::where('specialist_dr_id',$drId)
            ->where(function ($query)  {
                $query->where('status', 'pending')
                    ->orWhere('status', 'received');
            })
           ->get();

        if (isset($callQueue)){
            $queueCollections = new QueueCollections($callQueue);
            return response()->json(['success'=>true,'response' => $queueCollections], 200);
        }else{
            return response()->json(['success' => false, 'response' => 'No Doctor in queue'], 401);
        }
    }

    public function getCompltedCallQueue($drId)
    {
        $callQueue =  CallQueue::where('specialist_dr_id',$drId)
            ->where('status', 'completed')
            ->get();

        if (isset($callQueue)){
            $queueCollections = new QueueCollections($callQueue);
            return response()->json(['success'=>true,'response' => $queueCollections], 200);
        }else{
            return response()->json(['success' => false, 'response' => 'No Doctor in queue'], 401);
        }
    }

    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['queue_tbl_id'] == $id) {
                return $key;
            }
        }
        return null;
    }

    public function callByDocToUser($queueTblId)
    {
        $queue = CallQueue::find($queueTblId);
        $queue->status = 'received';
        $values = $this->database->getReference('callQueue')->getValue();
        $fbKey =  $this->searchForId($queueTblId , $values);

        $dataGet2 = $this->database->getReference('callQueue/'.$fbKey)->getValue();
        //dd($dataGet['call_by_doc_to_user']);
        $updateData = [
            "patient_status" => 'pending',
            "status" => 'received',
            "call_by_doc_to_user" => $dataGet2['call_by_doc_to_user'] + 1,
        ];
        $dataGet = $this->database->getReference('callQueue/'.$fbKey)->update($updateData);
        if (!$dataGet){
            return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
        }

        if ($queue->save()) {
            if ($queue->request_type == 'telemedicine') {
                $requestData = TelemedicineRequest::where('id', $queue->request_id )
                    ->where(function ($query)  {
                        $query->where('status', 'pending')
                            ->orWhere('status', 'processing');
                    })
                    ->first();
                $requestData->status = 'processing';
                $requestData->save();
            }
            return response()->json(['success' => true, 'response' => 'Calling to patient....'], 200);
        }else{
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], 401);
        }

    }

    public function patientNotAnserPost($queueTblId)
    {
        $queue = CallQueue::find($queueTblId);
        $queue->patient_status = 'notAnswer';

        $values = $this->database->getReference('callQueue')->getValue();
        $fbKey =  $this->searchForId($queueTblId , $values);
        //dd($fbKey);
        $updateData = [
            "patient_status" => 'notAnswer',
        ];
        $dataGet = $this->database->getReference('callQueue/'.$fbKey)->update($updateData);
        if (!$dataGet){
            return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
        }

        if ($queue->save()) {
            return response()->json(['success' => true, 'response' => 'Calling to patient....'], 200);
        }else{
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], 401);
        }

    }

    public function patientCallAnserPost($queueTblId)
    {
        //dd($queueTblId);
        $queue = CallQueue::find($queueTblId);
        $queue->patient_status = 'received';
        $values = $this->database->getReference('callQueue')->getValue();
        $fbKey =  $this->searchForId($queueTblId , $values);
        //dd($fbKey);
        $updateData = [
            "patient_status" => 'received'
        ];
        $dataGet = $this->database->getReference('callQueue/'.$fbKey)->update($updateData);
        if (!$dataGet){
            return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
        }

        if ($queue->save()) {
            return response()->json(['success' => true, 'response' => 'Calling to patient....'], 200);
        }else{
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], 401);
        }
    }

    public function callEndByDoctor($queueTblId)
    {
        //dd($queueTblId);
        $queue = CallQueue::find($queueTblId);
        $queue->patient_status = 'completed';
        $queue->status = 'completed';
        $values = $this->database->getReference('callQueue')->getValue();
        $fbKey =  $this->searchForId($queueTblId , $values);
        //dd($fbKey);
        $updateData = [
            "patient_status" => 'completed',
            "status" => 'completed',
        ];
        $dataGet = $this->database->getReference('callQueue/'.$fbKey)->update($updateData);
        if (!$dataGet){
            return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
        }

        if ($queue->save()) {
            return response()->json(['success' => true, 'response' => 'Calling to patient....'], 200);
        }else{
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], 401);
        }
    }
    public function fullReqCancelByDoctor($queueTblId)
    {
        //dd($queueTblId);
        $queue = CallQueue::find($queueTblId);
        $queue->status = 'completed';
        $values = $this->database->getReference('callQueue')->getValue();
        $fbKey =  $this->searchForId($queueTblId , $values);
        $updateData = [
            "patient_status" => 'notAnswer',
            "status" => 'cancel',
        ];
        $dataGet = $this->database->getReference('callQueue/'.$fbKey)->update($updateData);
        if (!$dataGet){
            return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
        }
        if ($queue->save()) {
            if ($queue->request_type == 'telemedicine') {
                $requestData = TelemedicineRequest::where('id', $queue->request_id )
                    ->where(function ($query)  {
                        $query->where('status', 'pending')
                            ->orWhere('status', 'processing');
                    })
                    ->first();
                $requestData->status = 'cancel';
                $requestData->save();
            }
            return response()->json(['success' => true, 'response' => 'Calling to patient....'], 200);
        }else{
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], 401);
        }
    }




}
