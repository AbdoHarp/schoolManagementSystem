<?php

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



// Route::get('/admin/dashboard', function () {
//     return view('Admin/dashboard');
// });

Route::get('/admin/adminList', function () {
    return view('Admin/adminList/list');
});


Route::middleware(['auth'])->group(function () {

    Route::middleware(['Admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('Admin/dashboard');
        });
    });
    Route::middleware(['teacher'])->group(function () {
        Route::get('/teacher/dashboard', function () {
            return view('Admin/dashboard');
        });
    });
    Route::middleware(['student'])->group(function () {
        Route::get('/student/dashboard', function () {
            return view('Admin/dashboard');
        });
    });
    Route::middleware(['parent'])->group(function () {
        Route::get('/parent/dashboard', function () {
            return view('Admin/dashboard');
        });
    });
});
