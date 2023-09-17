<?php

namespace App\Http\Controllers\usersSystem;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\mail\ForgetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\VarDumper\Caster\RdKafkaCaster;
use Illuminate\Support\Str;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\DumpHandler;

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

    public function forgotPassword()
    {
        return view("auth.forget");
    }

    public function postForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgetPasswordMail($user));
            return redirect()->back()->with("message", "please check your email and rest passwords");
        } else {
            return redirect()->back()->with("message", "This is email address not found");
        }
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)) {
            $data["user"] = $user;
            return view("auth.reset", $data);
        } else {
            abort(404);
        }
    }

    public function postReset($token, Request $request)
    {
        if ($request->password == $request->cpassword) {
            $user = User::getTokenSingle($token);
            $user->password  = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect(url("/"))->with("message", "password reset successful");
        } else {
            return redirect()->back()->with("message", "Password and confrim password does not match");
        }
    }




    public function Authlogout()
    {
        Auth::logout();
        return redirect("/");
    }
}
