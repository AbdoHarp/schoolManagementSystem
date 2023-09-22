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
        User::findOrFail($user_id)->update([
            'name' => $request->name,
            'password' => Hash::make($request['password'])
        ]);
        return redirect('/admin/admin/list')->with('message', 'User updated Successfully');
    }
}
