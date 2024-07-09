<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class ProfileController extends Controller
{
    //

 public function profile()
 {
    $AdminId = Auth::guard('admin')->id();
    $Admin = Admin::where('id', $AdminId)->get();
     return view('back.profile.index', compact('Admin'));
 }
 public function edit_info()
    {
        $Admin = Auth::guard('admin')->user();

        return view('back.profile.edit',compact('Admin'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function update_info(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',


        ]);
         /** @var \App\Models\Admin $Admin_info */
         $Admin_info =Auth::guard('admin')->user();
          $Admin_info->update([
           'name'=>$request->name,
          'email'=>$request->email,
          ]);
          $Admin_info->save();
         return redirect()->route('back.admin.profile')->with('message', 'informaion updated successfully.');


    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {


        return view('back.profile.reset-password');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\Admin $Admin */

        $Admin = Auth::guard('admin')->user();

        if (!Hash::check($request->old_password, $Admin->password)) {
            // Old password does not match
            return back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }
    if($request->new_password === $request->confirm_password){
        $Admin->password = Hash::make($request->new_password);
        $Admin->save();
        return redirect()->route('back.admin.profile')->with('message', 'Password updated successfully.');
    }
    else{
        return back()->withErrors(['confirm_password' => 'Confirm password is incorrect']);
    }

   }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
         /** @var \App\Models\Admin $Admin */
        $Admin = Auth::guard('admin')->user();
        $Admin->delete();
        return redirect()->route('back.index');
    }

}
