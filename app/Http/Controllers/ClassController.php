<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function list()
    {
        // $classs = ClassModel::all();
        $classs = ClassModel::paginate(20);
        return view("Admin.class.list", compact("classs"));
    }
    public function create()
    {
        return view("Admin.class.create");
    }

    public function store(Request $request)
    {
        $save = new ClassModel();
        $save->name = $request->name;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();
        return redirect("admin/class/list")->with("message", "Successfully created");
    }
}
