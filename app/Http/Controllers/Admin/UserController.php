<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index() {

        $users=User::paginate(10);
       return view('back.users.index',compact('users'));




    }

    public function create()
    {
        return view('back.users.create');
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required',
        // ]);

        // // Hash the password
        // $hashedPassword = bcrypt($validatedData['password']);

        // // Update the validatedData array with the hashed password
        // $validatedData['password'] = $hashedPassword;
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);


        return redirect('/back/users')->with('message','users added successfully');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('back.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'required',
    ]);

    $user = User::findOrFail($id);
    $user->update($validatedData);

    return redirect('/back/users')->with('message', 'user updated successfully.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect('/back/users')->with('message', 'user deleted successfully.');
}
function search(Request $req)
{
    $query=$req->input('query');
    if (!$query) {
        return redirect()->back()->with('message', 'Please enter a name or price')->with('message_type', 'error');;
    }
     else{
       $users = User::where('name', 'like', '%' . $query . '%')
          ->orWhere('email', 'like', '%' . $query . '%')
           ->paginate(10);

          return view('back.users.search', compact('users'));
     }
}




}
