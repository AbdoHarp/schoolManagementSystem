<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Psy\CodeCleaner\ReturnTypePass;

class AdminController extends Controller
{
    public function list()
    {
        $users = User::all();
        return view("Admin.adminList.list", compact("users"));
    }

    public function create()
    {
        return view("Admin.create");
    }

    public function store(Request $request)
    {

        $request->validate([
            "email" => "required|email|unique:users"
        ]);
        // dd($request->all());
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->user_utype = 1;
        $users->password  = Hash::make($request->password);
        $users->save();
        return redirect("admin/admin/list")->with("message", "User Added successfully");
    }
    public function edit($user_id)
    {
        $users = User::find($user_id);
        if ($users) {
            return view("Admin.edit", compact("users"));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            "email" => "required|email|unique:users"
        ]);
        User::findOrFail($user_id)->update([
            'name' => $request->name,
            "email" => $request->email,
            'password' => Hash::make($request['password'])
        ]);
        return redirect('/admin/admin/list')->with('message', 'User updated Successfully');
    }

    public function delete(Request $request, $user_id)
    {
        $users = User::findOrFail($user_id);
        $users->delete();
        return redirect("/admin/admin/list")->with('message', 'User deleted Successfully');
    }
}
