<?php

namespace App\Http\Controllers\usersSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\Caster\RdKafkaCaster;

class AuthController extends Controller
{
    //

    public function Login()
    {
        if (!empty(Auth::check())) {
            if (Auth::user()->user_utype == 1) {
                return redirect("admin/dashboard");
            } elseif (Auth::user()->user_utype == 2) {
                return redirect("teacher/dashboard");
            } elseif (Auth::user()->user_utype == 3) {
                return redirect("student/dashboard");
            } elseif (Auth::user()->user_utype == 4) {
                return redirect("parent/dashboard");
            } else {
                return redirect("/")->with("message", "What is your utype?");
            }
        }
        return view("auth.login");
    }

    public function Authlogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(["email" => $request->email, "password" => $request->password], $remember)) {
            if (Auth::user()->user_utype == 1) {
                return redirect("admin/dashboard");
            } elseif (Auth::user()->user_utype == 2) {
                return redirect("teacher/dashboard");
            } elseif (Auth::user()->user_utype == 3) {
                return redirect("student/dashboard");
            } elseif (Auth::user()->user_utype == 4) {
                return redirect("parent/dashboard");
            } else {
                return redirect("/")->with("message", "What is your utype?");
            }
        } else {
            return redirect()->back()->with("message", "please enter your email address and password correctly");
        };
    }
    public function Authlogout()
    {
        Auth::logout();
        return redirect("/");
    }
}
