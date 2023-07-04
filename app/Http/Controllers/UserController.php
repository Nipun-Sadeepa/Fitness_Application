<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\ContactForms;
use App\Models\Feedback;
use App\Models\GymClass;
use App\Models\Issues;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $allClassDetails = User::select("gym_classes.*", "fName")->join("gym_classes", "gym_classes.usersId", "users.id")->get();
        if (isset($allClassDetails[0])) {
            return view("user.userMainView")->with("allClassDetails", $allClassDetails);
        } else {
            return view("user.userMainView")->with("error", "error");
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

    public function showClass($classId)
    {
        $role= Auth::user()->role;
        $classDetails = User::select("gym_classes.*", "fName")->join("gym_classes", "gym_classes.usersId", "users.id")->where('gym_classes.id', $classId)->first();
        return view("class.viewClass")->with("classDetails", $classDetails)->with('role', $role);
    }

    public function bookClass($classId)
    {
        $bookings = Booking::create([
            'gymClassesId' => $classId,
            'usersId' => Auth::id(),
        ]);
        if (isset($bookings)) {
            return redirect("/user");
        }
    }

    public function createFeedback($classId)
    {
        return view("user.addFeedback")->with('classId', $classId);
    }

    public function storeFeedback(Request $request)
    {
        $userId = Auth::id();
        $feedback = Feedback::create([
            'gymClassesId' => $request->classId,
            'usersId' => $userId,
            'feedback' => $request->feedback,
        ]);
        if (isset($feedback)) {
            return response(["msg" => "success"], 200);
        } else {
            return response(["msg" => "fail"], 400);
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


    public function checkBookedClass()
    {
        $userId = Auth::id();
        $bookingDetails = GymClass::join("bookings", "gym_classes.id", "bookings.gymClassesId")->select("gym_classes.*", "gymClassesId")->where('bookings.usersId', $userId)->get();
        if (isset($bookingDetails[0])) {
            return view("user.booking")->with("bookingDetails", $bookingDetails);
        } else {
            return view("user.booking")->with("error", "error");
        }
    }

    public function storeIssue(Request $request)
    {
        $userId = Auth::id();
        $issue = Issues::create([
            'usersId' => $userId,
            'issue' => $request->issue,
        ]);

        if (isset($issue)) {
            return response(["msg" => "success"], 200);
        } else {
            return response(["msg" => "fail"], 400);
        }
    }
}
