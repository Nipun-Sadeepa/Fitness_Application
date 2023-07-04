<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GymClass;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    public function index(){
        $allClassDetails = User::select("gym_classes.*", "fName")->join("gym_classes", "gym_classes.usersId", "users.id")->get();
        if (isset($allClassDetails[0])) {
            return view("trainer.trainerMainView")->with("allClassDetails", $allClassDetails);
        } else {
            return view("trainer.trainerMainView")->with("error", "error");
        }
    }
    
    public function show()
    {
        $userId = Auth::id();
        $myDetails = User::where("id", $userId)->first();
        $myClassDetails = GymClass::where("usersId", $userId)->get();
        if (isset($myDetails) && isset($myClassDetails)) {
            return view("trainer.trainerProfileView")->with("myDetails", $myDetails)->with("myClassDetails", $myClassDetails);
        }elseif(isset($myDetails) && empty($myClassDetails)) {
            return view("trainer.trainerProfileView")->with("myDetails", $myDetails);
        }else{
            return view("trainer.trainerProfileView")->with("error", "error");
        }  
    }

    public function viewFeedback($classId)
    {
        $feedback = Feedback::join("users", "users.id", "feedback.usersId")->select("feedback.*", "fName")->where('gymClassesId', $classId)->get();
        if (isset($feedback[0])) {
            return view("classFeedback")->with("feedback", $feedback);
        } else {
            return view("classFeedback")->with("error", "error");
        }
    }

}
