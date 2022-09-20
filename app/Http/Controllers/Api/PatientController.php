<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorListDataCollections;
use App\Http\Resources\FavoriteSpDrsDataCollections;
use App\Http\Resources\PatientDataCollections;
use App\Http\Resources\SpecialityWiseDrsDataCollections;
use App\Http\Resources\TelemedicinePaymentHistoryDataListCollections;
use App\Http\Resources\UserProfileCollections;
use App\Model\FavoriteSpecialistDr;
use App\Model\Patients;
use App\Model\RecentView;
use App\Model\Review;
use App\Model\TelemedicineRequest;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PatientController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function patientCreate(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'relationship' => 'required',
            'age_year' => 'required',
            'weight' => 'required',
            'age_month' => 'required',
            'marital_status' => 'required',

        ]);

        $patients = new Patients();
        $patients->user_id = $request->user_id;
        $patients->name = $request->name;
        $patients->gender = $request->gender;
        $patients->relationship = $request->relationship;
        $patients->age_year = $request->age_year;
        $patients->weight = $request->weight;
        $patients->age_month = $request->age_month;
        $patients->marital_status = $request->marital_status;

        $image = $request->file('photo');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/patient/photo/', 0);
        } else {
            $imagename = "default.png";
        }
        $patients->photo = $imagename;

        if ($patients->save()) {
            $newData = new PatientDataCollections(Patients::where('id', $patients->id)->get());
            return response()->json(['success' => true, 'response' => $newData], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'No Successfully Updated!'], $this->failStatus);
        }
    }

    public function patientUpdate(Request $request, $id)
    {

        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'relationship' => 'required',
            'age_year' => 'required',
            'weight' => 'required',
            'age_month' => 'required',
            'marital_status' => 'required',
        ]);
        $patients = Patients::find($id);
        //dd($patients);
        $patients->name = $request->name;
        $patients->user_id = $request->user_id;
        $patients->gender = $request->gender;
        $patients->relationship = $request->relationship;
        $patients->age_year = $request->age_year;
        $patients->weight = $request->weight;
        $patients->age_month = $request->age_month;
        $patients->marital_status = $request->marital_status;

        $image = $request->file('photo');
        if (isset($image)) {
            $imagename = imageUploadAndUpdate($image, 'uploads/patient/photo/', 0, $patients->photo);
        } else {
            $imagename = $patients->photo;
        }
        $patients->photo = $imagename;

        if ($patients->save()) {
            $newData = new PatientDataCollections(Patients::where('id', $patients->id)->get());
            return response()->json(['success' => true, 'response' => $newData], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'No Successfully Updated!'], $this->failStatus);
        }
    }

    public function getMyAllPatient($myId)
    {
        if (isset($myId)) {
            $newData = new PatientDataCollections(Patients::where('user_id', $myId)->get());
            return response()->json(['success' => true, 'response' => $newData], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'No Successfully Updated!'], $this->failStatus);
        }
    }

    //==================== profile image upload =============================//
    public function userImageUpload(Request $request)
    {
        $patients = User::find($request->user_id);
        $image = $request->file('avatar_original');
        if (isset($image)) {
            $imagename = imageUploadAndUpdate($image, 'uploads/profile/', 0, $patients->avatar_original);
        } else {
            $imagename = $patients->avatar_original;
        }
        $patients->avatar_original = $imagename;
        if ($patients->save()) {
           // $userData = new  UserProfileCollections(User::where('id', $patients->id)->get());
            return response()->json(['success' => true, 'response' => $patients], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'No Successfully Updated!'], $this->failStatus);
        }

    }

    //wishlist create
    public function WishlistCreateToSpDr(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'specialist_dr_id' => 'required',
        ]);
        $check = FavoriteSpecialistDr::where('user_id', $request->user_id)->where('specialist_dr_id', $request->specialist_dr_id)->first();
        if (empty($check)) {
            $favorite = new FavoriteSpecialistDr();
            $favorite->user_id = $request->user_id;
            $favorite->specialist_dr_id = $request->specialist_dr_id;
            if ($favorite->save()) {
                return response()->json(['success' => true, 'response' => 'Successfully added'], $this->successStatus);
            } else {
                return response()->json(['success' => false, 'response' => 'Something went wrong!'], $this->failStatus);
            }
        } else {
            return response()->json(['success' => false, 'response' => 'Already added in list!'], $this->failStatus);
        }

    }

    public function userWiseFavorite($userId)
    {

        $doctors = FavoriteSpecialistDr::join('specialist_drs', 'specialist_drs.id', '=', 'favorites_specialist_drs.specialist_dr_id')
            ->where('favorites_specialist_drs.user_id', $userId)
            ->get(['favorites_specialist_drs.*', 'specialist_drs.*']);
        //return $doctors;
        $doctors = FavoriteSpecialistDr::where('user_id', $userId)->get();
        if (!empty($doctors)) {
            $doctorsData = new FavoriteSpDrsDataCollections($doctors);
            return response()->json(['success' => true, 'response' => $doctorsData], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], $this->failStatus);
        }
    }

    public function userWiseFavoriteDelete($listId)
    {
        $fav = FavoriteSpecialistDr::find($listId);
        if (!empty($fav)) {
            $fav->delete();
            return response()->json(['success' => true, 'response' => "Successfully Deleted!"], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'Does not match list id here!'], $this->failStatus);
        }
    }

    public function recentDrsViews($userId)
    {
        //dd($userId);
        $doctors = RecentView::where('user_id', $userId)->get();
        if (!empty($doctors)) {
            $doctorsData = new SpecialityWiseDrsDataCollections($doctors);
            return response()->json(['success' => true, 'response' => $doctorsData], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], $this->failStatus);
        }
    }

    public function postRecentDrs(Request $request)
    {

        $doctors = RecentView::where('user_id', $request->user_id)->get();
        if (count($doctors) < 10) {
            $check = RecentView::where('specialist_dr_id', $request->specialist_dr_id)->where('user_id', $request->user_id)->first();
            //dd($check);
            if (empty($check)) {
                $recent = new RecentView();
                $recent->user_id = $request->user_id;
                $recent->specialist_dr_id = $request->specialist_dr_id;
                $recent->save();
                if (!empty($recent)) {
                    return response()->json(['success' => true, 'response' => "Successfully Saved!"], $this->successStatus);
                } else {
                    return response()->json(['success' => false, 'response' => 'Does not match list id here!'], $this->failStatus);
                }
            } else {
                return response()->json(['success' => true, 'response' => "already Viewed this doctor."], $this->successStatus);
            }

        } else {
            $check = RecentView::where('specialist_dr_id', $request->specialist_dr_id)->where('user_id', $request->user_id)->first();
            //dd($check);
            if (empty($check)) {
                $check = RecentView::where('user_id', $request->user_id)->orderBy('id', 'ASC')->first();
                $check->delete();
                $recent = new RecentView();
                $recent->user_id = $request->user_id;
                $recent->specialist_dr_id = $request->specialist_dr_id;
                $recent->save();
                if (!empty($recent)) {
                    return response()->json(['success' => true, 'response' => "Successfully Saved!"], $this->successStatus);
                } else {
                    return response()->json(['success' => false, 'response' => 'Does not match list id here!'], $this->failStatus);
                }

            }else{
                return response()->json(['success' => true, 'response' => "already Viewed this doctor."], $this->successStatus);
            }
        }

    }
    public function recentVisitedDoctor($userId)
    {
        $doctors = TelemedicineRequest::select('specialist_dr_id')->where('user_id',$userId)->where('status','complete')->where('ssl_status','Completed')->groupBy('specialist_dr_id')->orderBy('id','desc')->get();
        //dd($doctors);
        if (!empty($doctors)) {
            $doctorsData = new SpecialityWiseDrsDataCollections($doctors);
            return response()->json(['success' => true, 'response' => $doctorsData], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], $this->failStatus);
        }
    }

    public function getMyConsultationHistoryByDrId($DrId)
    {
        $user = User::find(Auth::id());
        $telemedicineRequestHis = TelemedicineRequest::where('user_id', $user->id)
            ->where('specialist_dr_id', $DrId)->latest()->get();
        //dd($telemedicineRequestHis);
        if (!empty($telemedicineRequestHis)) {
            $doctorsData = new TelemedicinePaymentHistoryDataListCollections($telemedicineRequestHis);
            return response()->json(['success' => true, 'response' => $doctorsData], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], $this->failStatus);
        }
    }

}
