<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Classes\AgoraDynamicKey\RtcTokenBuilder;
//use App\Events\MakeAgoraCall;

class AgoraVideoController  extends Controller
{
    /*public function index(Request $request)
    {
        // fetch all users apart from the authenticated user
        $users = User::where('id', '<>', Auth::id())->get();
        return view('agora-chat', ['users' => $users]);
    }*/
    //public function token(Request $request)
    static function token($userId)
    {
        //$userId = $request->user_id;
        $token= [];
        //$appID = env('AGORA_APP_ID');
        $appID = '6f70635cf1374f3bb6e72398e194a9fa';
        //$appCertificate = env('AGORA_APP_CERTIFICATE');
        $appCertificate = "41a3c5bf4f5547a4b6126505aab2c266";
        $channelName = getTrx();
        $user = $userId;
        $RoleAttendee = RtcTokenBuilder::RoleAttendee;
        $RolePublisher = RtcTokenBuilder::RolePublisher;
        $expireTimeInSeconds = 86400;
        $currentTimestamp = now()->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token['token'] = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $user, $RoleAttendee, $privilegeExpiredTs);
        $token['channelName'] = $channelName;
        $token['user_id'] = $user;
        //$token['RoleAttendee'] = $RoleAttendee;
        $token['Role'] = $RolePublisher;
        //$token['privilegeExpiredTs'] = $privilegeExpiredTs;
        //$token['currentTimestamp'] = $currentTimestamp;
        $token['expireTimeInSeconds'] = $expireTimeInSeconds;
        return $token;
    }

    /*public function callUser(Request $request)
    {

        $data['userToCall'] = $request->user_to_call;
        $data['channelName'] = $request->channel_name;
        $data['from'] = Auth::id();

        broadcast(new MakeAgoraCall($data))->toOthers();
    }*/
}
