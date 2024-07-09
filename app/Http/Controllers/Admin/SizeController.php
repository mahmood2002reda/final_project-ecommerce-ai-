<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Http\Requests\SizeFormRequest;

class SizeController extends Controller
{
    //
    public function index()  {


        $sizes=Size::all();
        return view('back.sizes.index',compact('sizes'));

  }

  public function create()  {

    return view('back.sizes.create');

  }

  public function store( SizeFormRequest $req)  {
    $validatedData=$req->validated();
    $size=new Size;
    $size->size=$validatedData['size'];
    // $size->code=$validatedData['code'];
    $size->active=$req->active==true ? '1':'0';
    $size->save();

    return redirect('back/sizes')->with('message','size Added successfully');
  }

  public function edit(Size $size){


    return view('back.sizes.edit',compact('size'));




}

public function update(SizeFormRequest $request,$size_id){

$validatedData=$request->validated();
$size=Size::findOrfail($size_id);
$size->size=$validatedData['size'];
// $size->code=$validatedData['code'];
$size->active=$request->active== true ? '1':'0';
$size->update();
return redirect('back/sizes')->with('message','size updated Successfully ');

}

function destroy($size_id)
{
    $size=Size::find($size_id);
    if (!$size) {
      session()->flash('message', 'size not found.');
      return;}
      $size->delete();
      return redirect('back/sizes')->with('message', 'size deleted Successfully');
}

function search(Request $req)
{
    $query=$req->input('query');
    if (!$query) {
        return redirect()->back()->with('message', 'Please enter a name or price')->with('message_type', 'error');;
    }
     else{
       $sizes = Size::where('size', 'like', '%' . $query . '%')
          ->orWhere('active', 'like', '%' . $query . '%')
           ->get();

          return view('back.sizes.search', compact('sizes'));
     }
}
}
