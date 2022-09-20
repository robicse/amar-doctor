<?php
/**
 * Created by PhpStorm.
 * User: Ashiqur Rahman
 * Date: 11/11/2021
 * Time: 3:08 PM
 */

use App\Model\Offer;





    function sliders(){
        $sliders = \App\Model\Slider::latest()->get();
        return $sliders;
    }


//price related function start from here......................................


//price related function End here..............................................

//Ratting dynamic...............
if(! function_exists('renderStarRating')){
    function renderStarRating($rating,$maxRating=5) {
        $fullStar = "<i class = 'fa fa-star active'></i>";
        $halfStar = "<i class = 'fa fa-star half'></i>";
        $emptyStar = "<i class = 'fa fa-star'></i>";
        $rating = $rating <= $maxRating?$rating:$maxRating;

        $fullStarCount = (int)$rating;
        $halfStarCount = ceil($rating)-$fullStarCount;
        $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

        $html = str_repeat($fullStar,$fullStarCount);
        $html .= str_repeat($halfStar,$halfStarCount);
        $html .= str_repeat($emptyStar,$emptyStarCount);
        echo $html;
    }

    //filter products published
    if (! function_exists('filter_products')) {
        function filter_products($products) {
                return $products->where('published', '1');
        }
    }
}



