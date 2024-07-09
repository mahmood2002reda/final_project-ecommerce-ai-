<?php namespace App\Livewire\Admin\Brands;

use Livewire\Livewire;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\Component;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $brand_id;
     public $name;
     public $slug;
     public $active;
     public $vendor_id;
     //public $category_id;
     public $vendors;



     public function rules(){

            return[

                'name' => 'required|string',
                'slug' => 'required|string',
                'active' => 'nullable',
                'vendor_id'=>'required|integer',
               // 'category_id'=>'required|integer',
            ];
     }

    // Example usage in a Livewire component
    public function mount()
    {
        $this->getVendors();
    }


    public function resetFields()
    {
        $this->reset(['name', 'slug', 'active', 'vendor_id']);
    }
    public function getVendors()
    {
        $this->vendors = Vendor::all();
    }

     public function storeBrand(){

         Brand::create([

               'name' => $this->name,
               'slug' => Str::slug($this->slug),
               'active'=> $this->active==true ? '1':'0',
               'vendor_id' => $this->vendor_id,
               //'category_id' => $this->category_id,
         ]);


            session()->flash('message','Brand Added Successfully');
               return;
         }

         public function validateAndStoreBrand(){
            $validatedData = $this->validate();

               // Call the storeBrand() method if the validation passes
                      $this->storeBrand();
                      $this->dispatch('closeModal');

           }

           public function deleteBrand($brand_id){

            $this->brand_id=$brand_id;

       }

       public function destroyBrand(){

         $brand=Brand::find($this->brand_id);
         if (!$brand) {
           session()->flash('message', 'Brand not found.');
           return;}
           $brand->delete();
           session()->flash('message','brand deleted successfuly');
       }



       public function render()
       {

        //$categories=Category::where('active','1')->get();
        //$brands = Brand::with('vendor')->orderBy('id', 'ASC')->paginate(10);
        $brands=Brand::orderBy('id','ASC')->Paginate(10);
        return view('livewire.admin.brands.index',compact('brands'))
        ->extends('back.master')
        ->section('content');

       }
}
