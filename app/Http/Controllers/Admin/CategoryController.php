<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

        public function index()  {
              return view('back.category.index');
        }
        public function create()  {
            return view('back.category.create');
      }

      public function store(CategoryFormRequest $request)  {
              $validatedData=$request->validated();
              $category=new Category;
              if ($request->hasFile('image')) {
                  $file=$request->file('image');
                  $ext=$file->getClientOriginalExtension();
                  $filename = time() . '.' . $ext;
                  $file->move('uploads/category', $filename);
                  $category->image=$filename;
              }
           $category->name=$validatedData['name'];
           $category->slug= Str::slug( $validatedData['slug']);
           $category->description=$validatedData['description'];
           $category->meta_title=$validatedData['meta_title'];
           $category->meta_keyword=$validatedData['meta_keyword'];
           $category->meta_description=$validatedData['meta_description'];
           $category->active=$request->active== true ? '1':'0';
           $category->save();
           return redirect('back/category')->with('message','Category Added Successfully ');
      }
      public function edit(Category $category){
              return view('back.category.edit',compact('category'));
      }

      public function update(CategoryFormRequest $request,$category){

        $validatedData=$request->validated();
        $category=Category::findOrfail($category);
        if ($request->hasFile('image')) {

            $path='uploads/category/'.$category->image;
            if (File::exists($path)) {

              File::delete($path);

            }

            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category', $filename);
            $category->image=$filename;
        }
     $category->name=$validatedData['name'];
     $category->slug= Str::slug( $validatedData['slug']);
     $category->description=$validatedData['description'];
     $category->meta_title=$validatedData['meta_title'];
     $category->meta_keyword=$validatedData['meta_keyword'];
     $category->meta_description=$validatedData['meta_description'];
     $category->active=$request->active== true ? '1':'0';
     $category->update();
     return redirect('back/category')->with('message','Category updated Successfully ');
}
// Add the "createSubcategory" method
public function createSubcategory(Category $category)
{
    return view('back.category.create-subcategory', compact('category'));
}

// Add the "storeSubcategory" method
public function storeSubcategory(CategoryFormRequest $request, Category $category)
{
    $validatedData = $request->validated();
    $subcategory = new Category;
    $subcategory=new Category;
    if ($request->hasFile('image')) {
        $file=$request->file('image');
        $ext=$file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move('uploads/category', $filename);
        $subcategory->image=$filename;
    }
    $subcategory->name = $validatedData['name'];
    $subcategory->slug = Str::slug($validatedData['slug']);
    $subcategory->description = $validatedData['description'];
    $subcategory->meta_title = $validatedData['meta_title'];
    $subcategory->meta_keyword = $validatedData['meta_keyword'];
    $subcategory->meta_description = $validatedData['meta_description'];
    $subcategory->active = $request->active == true ? '1' : '0';
    $subcategory->parent_id = $category->id;
    $subcategory->save();

    return redirect('back/category')->with('message', 'Subcategory Added Successfully');
}


public function Showsubcategory($category){
    // $subcategory=Category::all();
    $categories=Category::findOrfail($category)->subcategories()->where('parent_id',$category)->get();
    return view('back.category.show-subcategories', compact('categories'));
}

public function Deletesubcategory($category_id){
    $category=Category::findOrfail($category_id);
    if (!$category) {
        session()->flash('message', 'Category not found.');
        return;
    }
      $path='uploads/category/'.$category->image;
      if (File::exists($path)) {
            File::delete($path);
      }
      $category->delete();
    return redirect()->back()->with('message','sub category deleted with all its image ');
}
function search(Request $req)
{
    $query=$req->input('query');
    if (!$query) {
        return redirect()->back()->with('message', 'Please enter a name or price')->with('message_type', 'error');;
    }
     else{
       $categories = Category::where('name', 'like', '%' . $query . '%')
          ->orWhere('active', 'like', '%' . $query . '%')
           ->get();

          return view('back.category.search', compact('categories'));
     }
}

public function destroyCategory($category_id){
    $category=Category::find($category_id);
    if (!$category) {
      session()->flash('message', 'Category not found.');
      return;
  }
    $path='uploads/category/'.$category->image;
    if (File::exists($path)) {
          File::delete($path);
    }

    $category->delete();
    return redirect('back/category')->with('message', 'Category deleted Successfully');

  //   Livewire::dispatch('close-modal');

 }





}
