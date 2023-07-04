<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GymClass;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class GymClassController extends Controller
{

    public function create()
    {
        $trainer = User::where("role", "trainer")->get();
        if (isset($trainer[0])) {
            return view("class.classCreate")->with("trainer", $trainer);
        } else {
            return view("class.classCreate")->with("trainerError", "Haven't Trainers");
        }
    }

    public function store(Request $request)
    {
        $rules = [
            "description" => "required|string|max:255",
            "aim" => "required|string|max:255",
            "expectedExertion" => "required|string|max:255",
            "fitnessLevel" => "required|string|max:255",
            "trainerId" => "required|string",
            "date" => "required|string",
            "startingTime" => "required|date_format:H:i",
            "endingTime" => "required|date_format:H:i",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["msg" => "ValidationFailed", "errors" => $validator->errors()], 422);
        } else {
            $validated = $validator->validated();

            $startingTime = Carbon::createFromFormat('H:i', $request->startingTime);
            $startingTimeWithSec = $startingTime->format('H:i:s');
            $endingTime = Carbon::createFromFormat('H:i', $request->endingTime);
            $endingTimeWithSec = $endingTime->format('H:i:s');

            $result = GymClass::create([
                "description" => $validated["description"],
                "aim" => $validated["aim"],
                "expectedExertion" => $validated["expectedExertion"],
                "fitnessLevel" => $validated["fitnessLevel"],
                "usersId" => $validated["trainerId"],
                "date" => $validated["date"],
                "startingTime" => $startingTimeWithSec,
                "endingTime" => $endingTimeWithSec,
            ]);

            if (isset($result)) {
                return response(["msg" => "success"], 200);
            } else {
                return response(["msg" => "failed"], 400);
            }
        }
    }

    public function showClass($classId)
    {
        $classMngDetails = User::select("gym_classes.*", "fName")->join("gym_classes", "gym_classes.usersId", "users.id")->where('gym_classes.id', $classId)->first();
        $trainers = User::select("id", "fName")->where("role", "trainer")->get();
        return view("manager.viewClass")->with("classMngDetails", $classMngDetails)->with("trainers", $trainers);
    }

    public function update(Request $request)
    {
        $updatingData = $request->except(['_token']);
        $classUpdate = GymClass::where("id", $updatingData['id'])->update($updatingData);
        if (isset($classUpdate)) {
            return response(["msg" => "success"], 200);
        } else {
            return response(["msg" => "failed"], 400);
        }
    }

    public function delete($classId)
    {
        $delete = GymClass::where('id', $classId)->delete();
        if (isset($delete)) {
            return redirect("/manager");
        }
    }
}
