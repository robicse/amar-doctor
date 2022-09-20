<?php
namespace App\Http;
/*use App\Currency;
use App\BusinessSetting;*/
use App\Model\Product;
use App\Model\SubSubCategory;
/*use App\FlashDealProduct;
use App\FlashDeal;
use App\OtpConfiguration;
use Twilio\Rest\Client;*/

class Helpers {

    //returns combinations of customer choice options array

   static function combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }

}


function translate($key){
    $key = ucfirst(str_replace('_', ' ', remove_invalid_charcaters($key)));
    $jsonString = file_get_contents(base_path('resources/lang/en.json'));
    $jsonString = json_decode($jsonString, true);
    if(!isset($jsonString[$key])){
        $jsonString[$key] = $key;
        saveJSONFile('en', $jsonString);
    }
    return __($key);
}




?>
