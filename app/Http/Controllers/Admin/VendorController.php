<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    //

    public function index()
    {
        $vendors = Vendor::paginate(10);
        return view('back.vendors.index', compact('vendors'));
    }
    public function create()
    {
        return view('back.vendors.create');
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:vendors',
        //     'password' => 'required',
        // ]);

        // // Hash the password
        // $hashedPassword = bcrypt($validatedData['password']);

        // // Update the validatedData array with the hashed password
        // $validatedData['password'] = $hashedPassword;
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:vendors',
            'password' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Vendor::create($validatedData);


        return redirect('/back/vendor')->with('message','vendor added successfully');
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendors.show', compact('vendor'));
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('back.vendors.edit', compact('vendor'));
    }

//     public function update(Request $request, $id)
// {
//     $validatedData = $request->validate([
//         'name' => 'required',
//         'email' => 'required|email|unique:vendors,email,'.$id,
//     ]);

//     $vendor = Vendor::findOrFail($id);
//     $vendor->name = $validatedData['name'];
//     $vendor->email = $validatedData['email'];
//     $vendor->save();

//     return redirect('/back/vendor')->with('message', 'Vendor updated successfully.');
// }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:vendors,email,'.$id,
            'password' => 'required',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->update($validatedData);

        return redirect('/back/vendor')->with('message', 'Vendor updated successfully.');
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect('/back/vendor')->with('message', 'Vendor deleted successfully.');
    }




    public function showBrands($id)
    {
        $vendor = Vendor::findOrFail($id);
        $brands = $vendor->Brands;

        return view('back.vendors.brands', compact('vendor', 'brands'));
    }

    public function deleteBrand($id)  {
        $brand = Brand::findOrFail($id);
        $brands = $brand->delete();
        return redirect()->back()->with('message',"brand deleted successfuly");

    }

    public function changePassword(Vendor $vendor)
{
    return view('back.vendors.change-password', compact('vendor'));
}

public function updatePassword(Request $request, Vendor $vendor)
{
    $request->validate([
        'password' => 'required|min:6',
    ]);

    $vendor->password = Hash::make($request->password);
    $vendor->save();

    return redirect('/back/vendor')->with('message','password changedd successfully');
}

function search(Request $req)
{
    $query=$req->input('query');
    if (!$query) {
        return redirect()->back()->with('message', 'Please enter a name or price')->with('message_type', 'error');;
    }
     else{
       $vendors = Vendor::where('name', 'like', '%' . $query . '%')
          ->orWhere('email', 'like', '%' . $query . '%')
           ->paginate(10);

          return view('back.vendors.search', compact('vendors'));
     }
}









}
