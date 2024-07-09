<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ColorFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()  {


        $colors=Color::all();
        return view('back.colors.index',compact('colors'));

  }

  public function create()  {

    return view('back.colors.create');

  }

  public function store( ColorFormRequest $req)  {
    $validatedData=$req->validated();
    $color=new Color;
    $color->color=$validatedData['color'];
    // $color->code=$validatedData['code'];
    $color->active=$req->active==true ? '1':'0';
    $color->save();

    return redirect('back/colors')->with('message','color Added successfully');
  }

  public function edit(Color $color){


    return view('back.colors.edit',compact('color'));




}

public function update(ColorFormRequest $request,$color_id){

$validatedData=$request->validated();
$color=Color::findOrfail($color_id);
$color->color=$validatedData['color'];
// $color->code=$validatedData['code'];
$color->active=$request->active== true ? '1':'0';
$color->update();
return redirect('back/colors')->with('message','Color updated Successfully ');

}

function destroy($color_id)
{
    $color=Color::find($color_id);
    if (!$color) {
      session()->flash('message', 'color not found.');
      return;}
      $color->delete();
      return redirect('back/colors')->with('message', 'Color deleted Successfully');
}

function search(Request $req)
{
    $query=$req->input('query');
    if (!$query) {
        return redirect()->back()->with('message', 'Please enter a name or price')->with('message_type', 'error');;
    }
     else{
       $colors = Color::where('color', 'like', '%' . $query . '%')
          ->orWhere('active', 'like', '%' . $query . '%')
           ->get();

          return view('back.colors.search', compact('colors'));
     }
}


}
