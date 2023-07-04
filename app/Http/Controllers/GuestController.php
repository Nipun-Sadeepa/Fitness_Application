<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GymClass;
use App\Models\User;
use App\Models\ContactForms;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){
        $allClassDetails = User::select("gym_classes.*", "fName",)->join("gym_classes", "gym_classes.usersId", "users.id")->get();
        if (isset($allClassDetails[0])) {
            return view("guest.guestMainView")->with("allClassDetails", $allClassDetails);
        } else {
            return view("guest.guestMainView")->with("error", "error");
        }
    }

    public function showTrainer($id){
        $trainerDetails= User::where('id',$id)->first();
        $trainerClassDetails = GymClass::where('usersId',$id)->get();
        if (isset($trainerDetails) && isset($trainerClassDetails)) {
            return view("viewTrainer")->with("trainerDetails", $trainerDetails)->with("trainerClassDetails", $trainerClassDetails);
        } elseif(isset($trainerDetails) && empty($trainerClassDetails)) {
            return view("viewTrainer")->with("trainerDetails", $trainerDetails);
        }else{
            return view("viewTrainer")->with("error", "error");
        }
    }

    public function storeContactForm(Request $request)
    {
        $contactForm = ContactForms::create([
            'contactForm' => $request->contactForm,
        ]);

        if (isset($contactForm)) {
            return response(["msg" => "success"], 200);
        } else {
            return response(["msg" => "fail"], 400);
        }
    }
}
