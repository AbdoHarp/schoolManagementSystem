<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->user_utype == 1) {
            return view("admin/dashboard");
        } elseif (Auth::user()->user_utype == 2) {
            return view("teacher/dashboard");
        } elseif (Auth::user()->user_utype == 3) {
            return view("student/dashboard");
        } elseif (Auth::user()->user_utype == 4) {
            return view("parent/dashboard");
        } else {
            return redirect("/")->with("message", "What is your utype?");
        }
    }
}
