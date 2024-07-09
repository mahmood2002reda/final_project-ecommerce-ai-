<?php

namespace App\Livewire\Admin\Category;

use Livewire\Livewire;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $category_id;

    public function deleteCategory($category_id){

         $this->category_id=$category_id;

    }

    public function destroyCategory(){

      $category=Category::find($this->category_id);
      if (!$category) {
        session()->flash('message', 'Category not found.');
        return;
    }
      $path='uploads/category/'.$category->image;
      if (File::exists($path)) {

            File::delete($path);


      }

      $category->delete();
      session()->flash('message','Category deleted successfuly');

    //   Livewire::dispatch('close-modal');

   }

    public function render()
    {

        $categories=Category::orderBy('id','ASC')->Paginate(10);
        return view('livewire.admin.category.index',compact('categories'));
    }
}
