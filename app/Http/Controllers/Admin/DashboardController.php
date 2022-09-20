<?php

namespace App\Http\Controllers\Admin;

use App\Model\Attribute;
use App\Model\Blog;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Coupon;
use App\Model\DeliveryMan;
use App\Model\Lab;
use App\Model\LabSampleCollector;
use App\Model\Offer;
use App\Model\Product;
use App\Model\SecmoDr;
use App\Model\SpecialistDr;
use App\Model\Speciality;
use App\Model\Subcategory;
use App\Model\SubSubcategory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('user_type','patient')->count();
        $speciality = Speciality::all()->count();
        $special_dr = User::where('user_type','specialist_dr')->count();
        $secmo_dr = User::where('user_type','secmo_dr')->count();
        $lab = Lab::all()->count();
        $sampleCollector = LabSampleCollector::all()->count();
        $deliveryMan = DeliveryMan::all()->count();
        $online_deliveryMan = DeliveryMan::where('is_online',1)->count();
        $offer = Offer::where('is_publish',1)->count();
        $coupon = Coupon::all()->count();
        $blog = Blog::all()->count();
        $total_online_drs = SpecialistDr::where('is_online',1)->count();
        $total_online_secmo_drs = SecmoDr::where('is_online',1)->count();

        //dd($totalUsers);
        return view('backend.admin.dashboard',
            compact('special_dr','totalUsers','speciality','secmo_dr','lab','sampleCollector','deliveryMan','online_deliveryMan','offer','coupon','blog','total_online_drs','total_online_secmo_drs'));
    }
}
