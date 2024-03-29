<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GymClassController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'ManagerRole'])->group(function () {
    Route::get('/manager', [ManagerController::class, 'show']);
    Route::view('/search', 'manager.searchUser');
    Route::get('/search/{email}', [ManagerController::class, 'searchUSer']);
    Route::get('/promote/{role}/{id}', [ManagerController::class, 'promoteUsers']);
    Route::get('/issue/view', [ManagerController::class, 'viewIssues']);
    Route::get('/class/create', [GymClassController::class, 'create']);
    Route::post('/class', [GymClassController::class, 'store']);
    Route::get('/classMng/{classId}', [ManagerController::class, 'showClass']);
    Route::Post('/class/update', [GymClassController::class, 'update']);
    Route::get('/class/delete/{classId}', [GymClassController::class, 'delete']);
});

Route::middleware(['auth', 'TrainerRole'])->group(function () {
    Route::get('/trainer', [TrainerController::class, 'show']);
    Route::get('/class/feedback/{classId}', [TrainerController::class, 'viewFeedback']);
    Route::view('/issue/create', 'issue');
    Route::post('/issue', [UserController::class, 'storeIssue']);
});

Route::middleware(['auth', 'MemberRole'])->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/class/bookings', [UserController::class, 'checkBookedClass']);
    Route::get('/class/{id}', [UserController::class, 'showClass']);
    Route::get('/class/book/{id}', [UserController::class, 'bookClass']);
    Route::get('/feedback/create/{classId}', [UserController::class, 'createFeedback']);
    Route::post('/feedback', [UserController::class, 'storeFeedback']);
    Route::view('/issue/create', 'issue');
    Route::post('/issue', [UserController::class, 'storeIssue']);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logout', [ProfileController::class, 'logout']);
});

Route::view("/contactForm/create", "contactForm");
Route::post('/contactForm', [UserController::class, 'storeContactForm']);

require __DIR__ . '/auth.php';
