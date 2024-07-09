<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    //
    public function index(){
        $sliders=Slider::all();
         return view('back.sliders.index',compact('sliders'));
    }
    public function create(){
        return view('back.sliders.create');
    }
    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/slider', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }

        $validatedData['active'] = $request->active == true ? '1' : '0';

        $createData = [
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'active' => $validatedData['active'],
        ];

        if (isset($validatedData['image'])) {
            $createData['image'] = $validatedData['image'];
        }

        Slider::create($createData);

        return redirect('back/sliders')->with('message', 'Slider added successfully');
    }
    public function edit(Slider $slider){
        return view('back.sliders.edit',compact('slider'));
    }
    public function update(Slider $slider, SliderFormRequest $request)
{
    $validatedData = $request->validated();

    if ($request->hasFile('image')) {
        $path = 'uploads/slider/' . $slider->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move('uploads/slider', $filename);
        $validatedData['image'] = "uploads/slider/$filename";
    }

    $validatedData['active'] = $request->active == true ? '1' : '0';

    $updateData = [
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'active' => $validatedData['active'],
    ];

    if (isset($validatedData['image'])) {
        $updateData['image'] = $validatedData['image'];
    }

    Slider::where('id', $slider->id)->update($updateData);

    return redirect('back/sliders')->with('message', 'Slider updated successfully');
}
public function destroy($slider){
    $slider=Slider::find($slider);
    if (!$slider) {
      session()->flash('message', 'slider not found.');
      return;
  }
  if ($slider->count() > 0) {
    # code...
    $path=$slider->image;
    if (File::exists($path)) {
          File::delete($path);
    }

    $slider->delete();
    return redirect('back/sliders')->with('message', 'slider deleted Successfully');

  }

    return redirect('back/sliders')->with('message', 'something want wrong');

  //   Livewire::dispatch('close-modal');

 }
    // public function update(Slider $slider,SliderFormRequest $request){
    //     $validatedData=$request->validated();

    //     if ($request->hasFile('image')) {
    //         $path='uploads/slider/'.$slider->image;
    //         if (File::exists($path)) {
    //           File::delete($path);
    //         }
    //         $file=$request->file('image');
    //         $ext=$file->getClientOriginalExtension();
    //         $filename = time() . '.' . $ext;
    //         $file->move('uploads/slider', $filename);
    //         $validatedData['image']="uploads/slider/$filename";
    //     }
    //     $validatedData['active']=$request->active== true ? '1':'0';
    //  Slider::where('id',$slider->id)->update(['title'=>$validatedData['title'],'description'=>$validatedData['description'],'image'=>$validatedData['image'],'active'=>$validatedData['active'],]);
    //  return redirect('back/sliders')->with('message','slider updated Successfully ');
    // }

}
