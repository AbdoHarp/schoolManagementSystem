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
            return redirect("/")->with("error", "please login first");
        }
        return view("auth.login");
    }

    public function Authlogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(["email" => $request->email, "password" => $request->password], $remember)) {
            return redirect("admin/dashboard");
        } else {
            return redirect()->back()->with("error", "please enter your email address and password correctly");
        };
    }
    public function Authlogout()
    {
        Auth::logout();
        return redirect("/");
    }
}
