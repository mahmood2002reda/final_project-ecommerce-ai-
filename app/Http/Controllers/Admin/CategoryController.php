<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    //


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






}
