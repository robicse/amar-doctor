<?php
/**
 * Created by PhpStorm.
 * User: ashiq
 * Date: 11/11/2019
 * Time: 3:08 PM
 */

namespace App\Helpers;

use App\Model\FlashDeal;
use App\Model\FlashDealProduct;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Session;
use Carbon\Carbon;
// use App\Helpers\UserInfo;
use Intervention\Image\ImageManagerStatic as Image;

class UserInfo
{
    public function __construct()
    {

    }


    public static function smsAPI($receiver_number, $sms_text)
    {

        //$api ="http://isms.zaman-it.com/smsapi?api_key=C20000365d831ca2c90451.06457950&type=text&contacts=".$receiver_number."&senderid=8809612451614&msg=".urlencode($sms_text);
        //$api ="http://portal.metrotel.com.bd/smsapi?api_key=C200118261c42a834b2553.72079342&type=text&contacts=".$receiver_number."&senderid=8809612441392&msg=".urlencode($sms_text);
        $api ="http://portal.metrotel.com.bd/smsapi?api_key=C2001118615978b3b5b880.40771009&type=text&contacts=".$receiver_number."&senderid=8809612441392&msg=".urlencode($sms_text);
     //dd($api);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=="
            ),
        ));
        //dd($curl);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }


}
