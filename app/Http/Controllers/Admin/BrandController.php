<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Http\Requests\BrandFormRequest;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //

    public function edit($brandId)
    {
        $brand = Brand::with('vendor')->findOrFail($brandId);
        $vendors = Vendor::all(); // Fetch all vendors
       // $categories=Category::all();
        return view('back.brand.edit', compact('brand', 'vendors'));
    }

public function update(BrandFormRequest $request,$brand){
    $validatedData=$request->validated();
    $brand=Brand::findOrfail($brand);
 $brand->name=$validatedData['name'];
 $brand->slug= Str::slug( $validatedData['slug']);
 $brand->active=$request->active== true ? '1':'0';
 $brand->vendor_id = $validatedData['vendor_id'];
//  $brand->category_id = $validatedData['category_id'];
 $brand->update();
 return redirect('back/brands')->with('message','Brand updated Successfully ');

}

public function search(Request $req)
    {
        $query=$req->input('query');
        if (!$query) {
            return redirect()->back()->with('message', 'Please enter a name or price')->with('message_type', 'error');;
        }
         else{
           $brands = Brand::where('name', 'like', '%' . $query . '%')
              ->orWhere('active', 'like', '%' . $query . '%')
               ->get();

              return view('back.brand.search', compact('brands'));
         }
     }

function destroy($brand_id)
{
    $brand=Brand::find($brand_id);
    if (!$brand) {
      session()->flash('message', 'Brand not found.');
      return;}
      $brand->delete();
      return redirect('back/brands')->with('message', 'Category deleted Successfully');
}



}
