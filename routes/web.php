<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\usersSystem\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthController::class, "login"]);
Route::post('login', [AuthController::class, "Authlogin"]);
Route::get('logout', [AuthController::class, "Authlogout"]);
Route::get('forgot-password', [AuthController::class, "forgotPassword"]);
Route::post('forgot-password', [AuthController::class, "postForgotPassword"]);
Route::get('reset/{token}', [AuthController::class, "reset"]);
Route::post('reset/{token}', [AuthController::class, "postReset"]);


// Route::get('/admin/dashboard', function () {
//     return view('Admin/dashboard');
// });



Route::middleware(['auth'])->group(function () {

    Route::middleware(['Admin'])->group(function () {
        Route::get("/admin/dashboard", [DashboardController::class, "dashboard"]);
        Route::get("/admin/admin/list", [AdminController::class, "list"]);
        Route::get("/admin/admin/add", [AdminController::class, "create"]);
        Route::post("/admin/admin/add", [AdminController::class, "store"]);
        Route::get("/admin/admin/{user_id}/edit", [AdminController::class, "edit"]);
        Route::put("/admin/admin/{user_id}", [AdminController::class, "update"]);
        Route::get("/admin/admin/{user_id}/delete", [AdminController::class, "delete"]);
    });
    Route::middleware(['teacher'])->group(function () {
        Route::get("/teacher/dashboard", [DashboardController::class, "dashboard"]);
    });
    Route::middleware(['student'])->group(function () {
        Route::get("/student/dashboard", [DashboardController::class, "dashboard"]);
    });
    Route::middleware(['parent'])->group(function () {
        Route::get("/parent/dashboard", [DashboardController::class, "dashboard"]);
    });
});
