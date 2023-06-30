<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'aim', 'expectedExertion', 'fitnessLevel', 'usersId', 'date', 'startingTime', 'endingTime', 'feedback'];
}
