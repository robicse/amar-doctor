<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {

        $postData = [
            'dr_id' => 12,
            'status' =>0,
        ];

// Create a key for a new post
        $newPostKey = $this->database->getReference('spdrstatus')->push($postData);
        if ($newPostKey){
            return 'ok';
        }else{
            return 'not ok';
        }
    }
    public function showAll()
    {
        $value = $this->database->getReference('spdrstatus')->getValue();
//        $snapshot = $reference->getSnapshot();
//
//        $value = $snapshot->getValue();
        //dd($value['-MjOWixh0ysMzb-wdHG_']['status']);
        return view('backend.admin.firebase.index', compact('value'));
// or
       // $value = $reference->getValue();
    }
}
