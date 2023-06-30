<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GymClass;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    public function show()
    {
        $userId = Auth::id();
        $userName = Auth::user()->fName;
        $myClassDetails = GymClass::where("usersId", $userId)->get();
        if (isset($myClassDetails[0])) {
            return view("trainer.trainerMainView")->with("myClassDetails", $myClassDetails)->with("userName", $userName);
        } else {
            return view("trainer.trainerMainView")->with("error", "error");
        }
    }

    public function viewFeedback($classId)
    {
        $feedback = Feedback::join("users", "users.id", "feedback.usersId")->select("feedback.*", "fName")->where('gymClassesId', $classId)->get();
        if (isset($feedback[0])) {
            return view("trainer.classFeedback")->with("feedback", $feedback);
        } else {
            return view("trainer.classFeedback")->with("error", "error");
        }
    }
}
