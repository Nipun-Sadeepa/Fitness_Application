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

    public function showClass($classId)
    {
        $classDetails = User::select("gym_classes.*", "fName")->join("gym_classes", "gym_classes.usersId", "users.id")->where('gym_classes.id', $classId)->first();
        return view("class.viewClass")->with("classDetails", $classDetails);
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
        return view("addFeedback")->with('classId', $classId);
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
