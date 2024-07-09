<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    //
    public function index()
    {
        $Admins = Admin::paginate(10);


        return view('back.Admins.index', compact('Admins'));
    }
    public function create()
    {

        $roles=Role::all();
        $admins = Admin::all();
        return view('back.Admins.create',compact('roles','admins'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:admins'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required', 'integer'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Admin::create($validatedData);

        return redirect('/back/Admins')->with('message', 'Admin added successfully');
    }



public function edit($id)
{
    $admin = Admin::findOrFail($id);
    $roles = Role::all();

    return view('back.Admins.edit', compact('admin', 'roles'));
}

public function update(Request $request, $id)
{
    $admin = Admin::findOrFail($id);

    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
        'password' => ['nullable', 'string', 'min:8'],
        'role_id' => ['required', 'integer'],
    ]);

    if ($request->has('password')) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }

    $admin->update($validatedData);

    return redirect('/back/Admins')->with('message', 'Admin updated successfully');
}


public function destroy($id)
{
    $admin = Admin::findOrFail($id);
    $admin->delete();
    return redirect('/back/Admins')->with('message', 'Admin deleted successfully.');
}


















}
