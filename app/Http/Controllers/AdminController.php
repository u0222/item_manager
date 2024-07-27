<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();

        return view("admin.admins", ['admins' => $admins]);
    }

    public function showAdd()
    {        
        return view("admin.add");
    }

    public function add(Request $request)
    {
        $admin = new Admin;

        if($admin->fill($request->all())->save()){
            Log::info('管理者の登録が正常に行われました',['admin_id' => $admin->id]);
            return redirect("/admins");
        }
        Log::error('管理者の登録ができませんでした',['data' => $request->all()]);
        return redirect("/admins");
    }

    public function showEdit($id)
    {
        $admin = Admin::find($id);
        return view("admin.edit", ["admin" => $admin ]);
    }

    public function edit($id, Request $request)
    {
        $admin = Admin::find($id);

        $admin->fill($request->all())->save();

        return redirect("/admins");
    }

    public function delete($id)
    {
        $admin = Admin::find($id);

        $admin->delete();

        return redirect("/admins");
    }
}
