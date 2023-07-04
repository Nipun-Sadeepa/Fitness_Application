<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactForms;
use Illuminate\Http\Request;
use App\Models\Issues;
use App\Models\User;
use App\Models\GymClass;


class ManagerController extends Controller
{

    public function show()
    {
        $classes = GymClass::join("users", "users.id", "gym_classes.usersId")->select("gym_classes.*", "fName")->paginate(20);
        if (isset($classes[0])) {
            return view("manager.managerMainView")->with("classes", $classes);
        } else {
            return view("manager.managerMainView")->with("error", "Not Found");
        }
    }
    public function searchUSer($email)
    {
        $users = User::where("email", "Like", "%" . $email . "%")->get();
        if (isset($users[0])) {
            return view("manager.searchUser")->with("userResult", $users);
        } else {
            return view("manager.searchUser")->with("error", "Not Found");
        }
    }

    public function promoteUsers($role, $id)
    {
        $user = User::find($id);
        if (isset($user)) {
            $user->role = $role;
            $user->save();
            $userResult = array('0' => $user->toArray());
            $userResult = (object) $userResult;
            return view("manager.searchUser")->with("userResult", $userResult);
        }
    }

    public function viewIssues()
    {
        $issues = Issues::join("users", "users.id", "issues.usersId")->select("issues.*", "fName")->latest()->paginate(20);
        if (isset($issues)) {
            return view("manager.viewIssue")->with('issues', $issues);
        } else {
            return view("manager.viewIssue")->with("error", "Not Found");
        }
    }

    public function viewContactForms()
    {
        $contactForms = ContactForms::latest()->paginate(20);
        if (isset($contactForms[0])) {
            return view("manager.viewIssue")->with('contactForms', $contactForms);
        } else {
            return view("manager.viewIssue")->with("error", "Not Found");
        }
    }
    

    
}
