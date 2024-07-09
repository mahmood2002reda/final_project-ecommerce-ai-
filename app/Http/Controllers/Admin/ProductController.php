<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductOption;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Laravel\Prompts\Prompt;
use App\Models\Option;


use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{
    //

    public function index(){

        $products= Product::all();
       // $options = Option::with('attribute')->get();
        return view('back.products.index',compact('products'));


    }

    public function create()  {

        $categories=Category::whereNull('parent_id')->where('active','1')->get();
        $brands=Brand::where('active','1')->get();
        $colors=Color::where('active','1')->get();
        $sizes=Size::where('active','1')->get();
        $subcategories=Category::whereNotNull('parent_id')->where('active','1')->get();

        return view('back.products.create',compact('categories','brands','subcategories','colors','sizes'));

  }

  public function store(ProductFormRequest $request){

       $validatedData=$request->validated();
        $category=Category::findOrfail($validatedData['category_id']);
        $brand=Brand::findOrfail($validatedData['brand_id']);
        $subcategory = Category::findOrFail($validatedData['subcategory_id']);
        $product=Product::create([
            'name'=>$validatedData['name'],
            'brand_id'=>$validatedData['brand_id'],
            'slug'=> Str::slug( $validatedData['slug']),
            'sku'=>$validatedData['sku'],
            'small_description'=>$validatedData['small_description'],
            'description'=>$validatedData['description'],
            'original_price'=>$validatedData['original_price'],
           // 'selling_price'=>$validatedData['selling_price'],
            //'quantity'=>$validatedData['quantity'],
            'trending'=>$request->trending== true ? '1':'0',
            'meta_title'=>$validatedData['meta_title'],
            'meta_keyword'=>$validatedData['meta_keyword'],
           'meta_description'=>$validatedData['meta_description'],
            'active'=>$request->active== true ? '1':'0',


        ]);
        $product->categories()->attach([$category->id, $subcategory->id]);

        if ($request->hasFile('image')) {
            $uploadPath='uploads/products/';
              $i=1;
            foreach ($request->file('image') as $imageFile) {
                # code...
              $ext=$imageFile->getClientOriginalExtension();
                  $filename = time() .$i++ .'.' . $ext;
                  $imageFile->move( $uploadPath, $filename);
                  $finalImagePathName=$uploadPath.$filename;
                  $product->productImages()->create([

                        'product_id'=>$product->id,
                           'image'=>$finalImagePathName,

                 ] );




            }


        }
        if ($request->hasFile('model_image')) {
            $file=$request->file('model_image');
            $ext=$file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $product->model_image=$filename;
        }
        $totalQuantaty=0;
        if ($request->colors && $request->sizes) {
            $colors = $request->colors;
            $sizes = $request->sizes;
            $quantities = $request->quantities;
           // $extraprices=$request->extraprices;

            foreach ($colors as $colorId => $color) {

                foreach ($sizes[$colorId] as $selectedSizeId) {

                    $product->productOptions()->create([
                        'product_id' => $product->id,
                        'color_id' => $colorId,
                        'size_id' => $selectedSizeId,
                        'quantity' => $quantities[$colorId][$selectedSizeId] ?? 0,
                        'selling_price'=>$product->original_price,
                       // 'extra_price' => $extraprices[$colorId][$selectedSizeId] ?? 0,
                    ]);
                    $totalQuantaty+=$quantities[$colorId][$selectedSizeId];
                }
            }

            //$product->updateOrcreate(['quantity'=>$totalQuantaties]);
        }

        // if ($request->colors && $request->sizes) {
        //     $colors = $request->colors;
        //     $sizes = $request->sizes;
        //     $colorQuantities = $request->colorquantity;
        //     $sizeQuantities = $request->sizequantity;

        //     foreach ($colors as $colorId => $color) {
        //         $selectedSizeId = $sizes[$colorId]; // Get the selected size for the current color
        //         $product->productOptions()->create([
        //             'product_id' => $product->id,
        //             'color_id' => $colorId,
        //             'size_id' => $selectedSizeId,
        //             'quantity' => $colorQuantities[$colorId] ?? 0,
        //             'size_quantity' => $sizeQuantities[$selectedSizeId] ?? 0,
        //         ]);
        //     }
        // }

        // if ($request->colors && $request->sizes) {
        //     $colors = $request->colors;
        //     $sizes = $request->sizes;
        //     $colorQuantities = $request->colorquantity;
        //     $sizeQuantities = $request->sizequantity;

        //     foreach ($colors as $colorId => $color) {
        //         foreach ($sizes as $sizeId => $size) {
        //             $product->productOptions()->create([
        //                 'product_id' => $product->id,
        //                 'color_id' => $colorId,
        //                 'size_id' => $sizeId,
        //                 'quantity' => $colorQuantities[$colorId] ?? 0,
        //                 'size_quantity' => $sizeQuantities[$sizeId] ?? 0,
        //             ]);
        //         }
        //     }
        // }
            // Retrieve the selected color and size options
    // $selectedColor = $request->input('color');
    // $selectedSize = $request->input('size');

    // // Create a new product instance
    // $product = new Product();
    // $product->name = $request->input('name');
    // $product->price = $request->input('price');
    // // Set other attributes of the product

    // // Save the product to the database
    // $product->save();

    // // Attach the selected color and size options to the product
    // $product->options()->attach([$selectedColor, $selectedSize]);

    // Redirect or return a response
    $product->quantity =  $totalQuantaty;
    $product->save();

        return redirect('/back/product')->with('message','product added successfully');





  }

   public function edit(int $product_id){
       $product= Product::findOrfail($product_id);
       $categories=Category::whereNull('parent_id')->where('active','1')->get();
       $subcategories=Category::whereNotNull('parent_id')->where('active','1')->get();
       $brands=Brand::all();
       $product_color=$product->productOptions->pluck('color_id')->toArray();
       $colors=Color::whereNotIn('id',$product_color)->where('active','1')->get();
       $product_size=$product->productOptions->pluck('size_id')->toArray();
       $sizes=Size::all();
       return view('back.products.edit',compact('categories','brands','product','subcategories','colors','sizes'));

   }


   public function update(ProductFormRequest $request,int $product_id){

    $validatedData=$request->validated();
    $category=Category::findOrfail($validatedData['category_id']);
    $subcategory = Category::findOrFail($validatedData['subcategory_id']);
     $product = Product::findOrFail($product_id);
       if ($product) {

           $product->update([
            'name'=>$validatedData['name'],
            'brand_id'=>$validatedData['brand_id'],
            'slug'=> Str::slug( $validatedData['slug']),
            'sku'=>$validatedData['sku'],
            'small_description'=>$validatedData['small_description'],
            'description'=>$validatedData['description'],
            'original_price'=>$validatedData['original_price'],
            //'selling_price'=>$validatedData['selling_price'],
            //'quantity'=>$validatedData['quantity'],
            'trending'=>$request->trending== true ? '1':'0',
            'meta_title'=>$validatedData['meta_title'],
            'meta_keyword'=>$validatedData['meta_keyword'],
           'meta_description'=>$validatedData['meta_description'],
            'active'=>$request->active== true ? '1':'0',


        ]);

        $product->categories()->sync([$category->id, $subcategory->id]);

        if ($request->hasFile('image')) {
            $uploadPath='uploads/products/';
              $i=1;
            foreach ($request->file('image') as $imageFile) {
                # code...
              $ext=$imageFile->getClientOriginalExtension();
                  $filename = time() .$i++ .'.' . $ext;
                  $imageFile->move( $uploadPath, $filename);
                  $finalImagePathName=$uploadPath.$filename;
                  $product->productImages()->create([

                        'product_id'=>$product->id,
                           'image'=>$finalImagePathName,

                 ] );




            }


        }
        if ($request->hasFile('model_image')) {

            $path='uploads/category/'.$category->image;
            if (File::exists($path)) {

              File::delete($path);

            }

            $file=$request->file('model_image');
            $ext=$file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products', $filename);
            $product->model_image=$filename;
        }

        $totalQuantity=0;
        if ($request->colors && $request->sizes) {
            $colors = $request->colors;
            $sizes = $request->sizes;
            $quantities = $request->quantities;
           // $extraprices=$request->extraprices;
            foreach ($colors as $colorId => $color) {
                foreach ($sizes[$colorId] as $selectedSizeId) {
                    $product->productOptions()->updateOrCreate([
                        'product_id' => $product->id,
                        'color_id' => $colorId,
                        'size_id' => $selectedSizeId,
                        'quantity' => $quantities[$colorId][$selectedSizeId] ?? 0,
                       // 'extra_price' => $extraprices[$colorId][$selectedSizeId] ?? 0,
                    ]);
                    $totalQuantity+=$quantities[$colorId][$selectedSizeId];
                }
            }
            // $product->updateOrcreate(['quantity'=>$totalQuantaties]);
        }
            // Update colors and quantities
            // if ($request->colors) {
            //     foreach ($request->colors as $key => $color) {
            //         $product->productColors()->updateOrCreate(
            //             ['product_id' => $product->id, 'color_id' => $color],
            //             ['quantity' => $request->colorquantity[$key] ?? 0]
            //         );
            //     }
            // }

            // // Update sizes and quantities
            // if ($request->sizes) {
            //     foreach ($request->sizes as $key => $size) {
            //         $product->productSizes()->updateOrCreate(
            //             ['product_id' => $product->id, 'size_id' => $size],
            //             ['quantity' => $request->sizequantity[$key] ?? 0]
            //         );
            //     }
            // }

        // if ($request->colors) {
        //     foreach ($request->colors as $key=>$color) {
        //        $product->productColors()->create([
        //                'product_id'=>$product->id,
        //                'color_id'=>$color,
        //                'quantity'=>$request->colorquantity[$key] ?? 0,
        //        ]);
        //     }
        // }

        $product->update(['quantity' => $product->quantity + $totalQuantity]);
        return redirect('/back/product')->with('message','product updated successfully');

       }

       else{


        return redirect('/back/product')->with('message','No such product found');


       }




   }

   public function destroyImage(int $product_image_id){

                $productImage=ProductImage::findOrfail($product_image_id);
                if (File::exists( $productImage->image)) {
                    File::delete( $productImage->image);
                  }
                $productImage->delete();
                return redirect()->back()->with('message','product Image deleted');
   }

   public function destroy(int $product_id){


         $product=Product::findOrfail($product_id);
         if (!$product->productImages->isEmpty()){
               foreach($product->productImages as $image){
                if (File::exists( $image->image)) {
                    File::delete( $image->image);
                }

               }

         }

         $product->delete();
         return redirect()->back()->with('message','product deleted with all its image ');




   }




   function search(Request $req)
   {
    // $products= Product:: where('name', 'like', '%'.$req->input('query').'%')->orWhere('selling_price', 'like', '%'.$req->input('query').'%')->get();
    // return view('back.products.search',compact('products'));

        $query=$req->input('query');
    if (!$query) {
        return redirect()->back()->with('message', 'Please enter a name or price')->with('message_type', 'error');;
    }
     else{
       $products = Product::where('name', 'like', '%' . $query . '%')
          ->orWhere('original_price', 'like', '%' . $query . '%')
           ->get();

          return view('back.products.search', compact('products'));
     }
   }

//    public function updateProdColorQty(Request $request,$prod_color_id)  {
//           $productColorData=Product::findOrFail($request->product_id)
//                                ->productOptions()->where('id',$prod_color_id)->first();
//            $productColorData->update([
//                    'quantity'=>$request->qty,

//             ]);
//         $product=Product::findOrFail($request->product_id);
//           $productOptions = $product->productOptions;
//          $totalQuantity = 0;

//      // Loop through each product option and sum up the quantities
//       foreach ($productOptions as $productOption) {
//            $totalQuantity += $productOption->quantity;
//          }

//     // Update the total quantity of the product
//        $product->update(['quantity' => $totalQuantity]);


//         return response()->json(['message'=>'product Color Qty updated']);

//    }

//    public function deleteProdColor($prod_color_id){

//          $prodColor=ProductOption::findOrFail($prod_color_id);
//          $prodColor->delete();
//          return response()->json(['message'=>'product Color deleted']);


//    }


   public function updateProdSizeQty(Request $request,$prod_size_id)  {
    $productSizeData=Product::findOrFail($request->product_id)
                         ->productOptions()->where('id',$prod_size_id)->first();
  $productSizeData->update([
           'quantity'=>$request->qty,

  ]);
  $product=Product::findOrFail($request->product_id);
  $productOptions = $product->productOptions;
  $totalQuantity = 0;

// Loop through each product option and sum up the quantities
foreach ($productOptions as $productOption) {
    $totalQuantity += $productOption->quantity;
}

// Update the total quantity of the product
$product->update(['quantity' => $totalQuantity]);


  return response()->json(['message'=>'product Color Qty updated']);

}

public function updateProdExtraPrice(Request $request,$prod_size_id)  {
    $productSizeData=Product::findOrFail($request->product_id)
                         ->productOptions()->where('id',$prod_size_id)->first();
  $product=Product::findOrFail($request->product_id);
  $productOriginalPrice=$product->original_price;
  $extraPrice = $request->extra_price;
  $sellingPrice = $productOriginalPrice + $extraPrice;
  $productSizeData->update([
           'extra_price'=>$request->extra_price,
                 'selling_price'=>$sellingPrice
  ]);
//   $product=Product::findOrFail($request->product_id);
//   $productOptions = $product->productOptions;
//   $totalQuantity = 0;

// Loop through each product option and sum up the quantities
// foreach ($productOptions as $productOption) {
//     $totalQuantity += $productOption->quantity;
// }

// Update the total quantity of the product
// $product->update(['quantity' => $totalQuantity]);


  return response()->json(['message'=>'product extra price updated']);

}

public function deleteProdSize($prod_size_id){

    $prodSize = ProductOption::findOrFail($prod_size_id);
    $quantityDeleted = $prodSize->quantity;
    $prodSize->delete(); // Detach the related size foreign key
    // Recalculate total quantity
    $product = $prodSize->product; // Assuming 'product' is the relationship between ProductOption and Product
    $previousTotalQuantity = $product->quantity;
    $newTotalQuantity = $previousTotalQuantity - $quantityDeleted;

    // Update total quantity of the product
    $product->update(['quantity' => $newTotalQuantity]);

    return response()->json(['message' => 'Product size deleted']);


}






}
