@extends('back.master')
@section('title','back home page')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y  " class="card sticky-top">
           <div class="row">
                       <div class="col-md-12">
                         @if (session('message'))
                         <h5 class="alert alert-success mb-2">{{session('message')}}</h5>
                         @endif
                 <div class="card">
                              <div class="card-header">
                                  <h4>Edit Product
                                   <a href="{{url('back/product')}}" class="btn btn-danger text-white float-end">Back</a>
                                 </h4>
                               </div>
                       <div class="card-body">
                            @if ($errors->any())
                             <div class="alert alert-warning">
                                        @foreach ($errors->all() as $error )
                                            <div>{{$error}}</div>
                                        @endforeach
                             </div>
                            @endif
                             <form action="{{url('back/product/'.$product->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                 @method('PUT')
                                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                     <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">SEO Tags</button>
                                    </li>
                                     <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Details</button>
                                     </li>
                                     <li class="nav-item" role="presentation">
                                     <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false" image>product image</button>
                                     </li>
                                     <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="model-image-tab" data-bs-toggle="tab" data-bs-target="#model-image-tab-pane" type="button" role="tab" aria-controls="model-image-tab-pane" aria-selected="false" image>product model image</button>
                                        </li>
                                     <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="size-tab" data-bs-toggle="tab" data-bs-target="#size-tab-pane" type="button" role="tab" aria-controls="size-tab-pane" aria-selected="false" image>product size</button>
                                     </li>

                                   </ul>
                             <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                   <div class="mb3">

                                    <br>
                                      <label for="">Category</label>
                                         <select name="category_id" id="" class="form-control">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id==$product->categories->first()->id? 'selected':''}}>

                                                {{$category->name}}
                                            </option>
                                            @endforeach
                                         </select>
                                        </div>
                                        <br>
                                        <!-- Subcategories -->
                                        <div class="mb3">
                                         <label for="">Subcategory</label>
                                         <select name="subcategory_id" id="subcategory" class="form-control" >
                                             {{-- <option value="">Select Subcategory</option> --}}
                                             @foreach ($subcategories as $subcategory)
                                                 <option value="{{$subcategory->id}}" {{$subcategory->id==$product->categories->last()->id? 'selected':''}}>{{$subcategory->name}}</option>
                                             @endforeach
                                         </select>
                                       </div>
                                        <br>
                                            <div class="mb3">
                                                <label for="">product name</label>
                                                <input type="text" name="name" id="" value="{{$product->name}}" class="form-control">
                                            </div>
                                            <div class="mb3">
                                                <label for="">product slug</label>
                                                <input type="text" name="slug" id="" value="{{$product->slug}}" class="form-control">
                                            </div>

                                            <br>
                                    <div class="mb3">
                                      <label for="">Select Brand</label>
                                      <select name="brand_id" id="" class="form-control">
                                         @foreach ($brands as $brand)
                                         <option value="{{$brand->id}}" {{$brand->id==$product->brand->id ? 'selected':''}}> {{$brand->name}} </option>
                                         @endforeach
                                      </select>
                                     </div>
                                     <br>
                                     <div class="col-md-12 mb-3">
                                        <label for="">small description</label>
                                       <textarea name="small_description" id=""  rows="3" class="form-control">{{$product->small_description}}</textarea>
                                       @error('small_description') <small class="text-danger">{{$message}}</small>  @enderror
                                   </div>
                                   <div class="col-md-12 mb-3">
                                    <label for="">Description</label>
                                   <textarea name="description" id=""  rows="3" class="form-control">{{$product->description}}</textarea>
                                   @error('description') <small class="text-danger">{{$message}}</small>  @enderror
                               </div>
                                ...</div>
                                <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                                    <div class="mb3">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" name="meta_title" id="meta_title" value="{{$product->meta_title}}" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="meta_keyword">Meta Keyword</label>
                                        <textarea name="meta_keyword" id="meta_keyword" rows="3" class="form-control">{{$product->meta_keyword}}</textarea>
                                        @error('meta_keyword') <small class="text-danger">{{$message}}</small>  @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" rows="3" class="form-control">{{$product->meta_description}}</textarea>
                                        @error('meta_description') <small class="text-danger">{{$message}}</small>  @enderror
                                    </div>
                                </div>


                                <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">..
                                                       <div class="row">
                                                          <div class="col-md-3">
                                                              <div class="mb3">
                                                                 <label for="">Original Price</label>
                                                                <input type="text" name="original_price" id="" value="{{$product->original_price}}" class="form-control">
                                                             </div>
                                                          </div>
                                                         <div class="col-md-3">
                                                            <div class="mb3">
                                                                <label for="">product sku</label>
                                                                <input type="text" name="sku" id="" value="{{$product->sku}}" class="form-control">
                                                            </div>
                                                        </div>

                                                          {{-- <div class="col-md-4">
                                                             <div class="mb3">
                                                            <label for="">Quantity</label>
                                                               <input type="number" name="quantity" id="" value="{{$product->quantity}}" class="form-control">
                                                             </div>
                                                         </div> --}}
                                                     <div class="col-md-3">
                                                        <div class="mb3">
                                                         <label for="">Trending</label>
                                                         <br>
                                                        <input type="checkbox" name="trending" {{$product->trending=='1' ? 'checked':''}}  style="width: 20px; height:20px;"/>
                                                    </div>
                                                    </div>
                                                  <div class="col-md-3">
                                                 <div class="mb3">
                                                      <label for="">active</label>
                                                      <br>
                                                    <input type="checkbox" name="active"  {{$product->active=='1' ? 'checked':''}}  style="width: 20px; height:20px;" />
                                                   </div>
                                                </div>

                                                {{-- <input type="checkbox" name="active"/> --}}

                                      </div>
                                .</div>
                                <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">.
                                         <div class="mb3" >
                                              <label for="">Upload Product Images</label>
                                                <input type="file" multiple name="image[]" id="" class="form-control"/>
                                         </div>
                                              <br>

                                         <div>

                                            <div>
                                                @if (!$product->productImages->isEmpty())
                                                <div class="row">
                                                    @foreach ($product->productImages as $image)
                                                     <div class="col-md-2">
                                                        <img src="{{ asset($image->image) }}" alt="img" style="width: 80px; height:80px; margin-left:20px;" class="border  border-2" />
                                                        <a href="{{url('back/product-image/'.$image->id.'/delete')}}" class="d-block" style="margin-left:25px">Remove</a>
                                                     </div>
                                                     @endforeach
                                                </div>

                                                @else
                                                <h5>No image added</h5>
                                                @endif
                                            </div>

                                         </div>


                                </div>
                                <div class="tab-pane fade border p-3" id="model-image-tab-pane" role="tabpanel" aria-labelledby="model-image-tab" tabindex="0">
                                    <div class="mb3">
                                        <label for="model_image">Upload model product image</label>
                                        <input type="file" multiple name="model_image" id="model_image" class="form-control"/>
                                    </div>
                                    <br>
                                    <div>
                                        @if ($product->model_image)
                                            <div class="row">
                                                <img src="{{asset('/uploads/products/'.$product->model_image)}}" style="width: 90px; height:90px; margin-left:20px;" class="border  border-2"  alt="">
                                                {{-- <a href="{{url('back/product-image/'.$image->id.'/delete')}}" class="d-block" style="margin-left:25px">Remove</a> --}}
                                            </div>
                                        @else
                                            <img src="{{ asset('uploads/slider/image-not-found.png') }}" style="width: 70px; height: 70px;" alt="Image Not Found">
                                            {{-- <h5>No image added</h5> --}}
                                        @endif
                                    </div>
                                </div>



                               <div class="tab-pane fade border p-3" id="size-tab-pane" role="tabpanel" aria-labelledby="size-tab" tabindex="0">.

                                  <div class="mb3">
                                   <h4>Add product size&color</h4>
                                    <label for="">Select size&color</label><br> <hr>
                                    <div class="row ">
                                  @forelse ($colors as $color )
                                    {{-- <div class="col-md-3">
                                     <div class="p-2 border mb-3">
                                    Size: <input type="checkbox"  name="sizes[{{$size->id}}]" id="" value="{{$size->id}}"/>  {{$size->name}} <br><br>
                                       Quantity: <input type="number"  name="sizequantity[{{$size->id}}]" style="width:40px; height:20px; border:1px solid" />

                                      </div>

                                    </div> --}}
                                  <div class="col-md-3">
                                    <div class=" p-2 border mb-3 ">
                                      Color:    <input type="checkbox" name="colors[{{$color->id}}]" id="" value="{{$color->id}}"/>  {{$color->color}} <br><br>

                                      Sizes:
                                      @foreach ($sizes as $size)
                                           <div>
                                            <input type="checkbox" name="sizes[{{$color->id}}][]" id="" value="{{$size->id}}" />
                                              {{$size->size}}
                                              - Quantity: <input type="number" name="quantities[{{$color->id}}][{{$size->id}}]" style="width:40px; height:20px; border: 1px solid #ccc; padding: 5px;" />
                                            </div>
                                          @endforeach
                                       </div>
                                     </div>
                                   @empty
                                  <div class="col-md-12">
                                    <h1>No sizes found</h1>

                                    </div>

                                   @endforelse
                                   <hr>

                                </div>



                                 </div>
                                 <div class="table-responsive">

                                   <table class="table  table-sm table-bordered">
                                  <thead>
                                     <tr>
                                     <th>size Name</th>
                                     <th>Quantity</th>
                                     <th>extra-prices</th>
                                     <th>selling price</th>
                                     <th>delete</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                   @foreach ($product->productOptions as $prodOption)
                                     <tr class="prod-size-tr">

                                          <td>
                                           @if (($prodOption->size&&$prodOption->color))
                                            {{$prodOption->size->size}}-{{$prodOption->color->color}}
                                           @else
                                            <h3>No size found</h3>
                                           @endif

                                         </td>
                                           <td>
                                              <div class="input-group mb-3" style="width:150px">
                                                <input type="text" value="{{$prodOption->quantity}}" class=" productSizeQuantity form-control form-control-sm"/>
                                                 <button class=" updateProductSizeBtn btn btn-primary btn-sm  " type="button" value="{{$prodOption->id}}">update</button>
                                               </div>
                                           </td>
                                            <td>
                                              <div class="input-group mb-3" style="width:150px">
                                                <input type="text" value="{{$prodOption->extra_price}}" class=" productExtraPrice form-control form-control-sm"/>
                                                 <button class=" updateProductExtraBtn btn btn-primary btn-sm  " type="button" value="{{$prodOption->id}}">update</button>
                                               </div>
                                            </td>
                                            <td>{{$prodOption->selling_price}}</td>

                                            <td><button class=" deleteProductSizeBtn btn btn-danger btn-sm " type="button" value="{{$prodOption->id}}">delete</button></td>

                                         </tr>

                                       @endforeach




                                        </tbody>





                                   </table>





                               </div>






                     </div>

                         <br> <div><button type="submit" class="btn btn-primary">update</button></div>

                    </form>



               </div>
             </div>
           </div>
         </div>

</div>
@endsection
@section('scripts')

{{-- <script>

$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).on('click', '.updateProductColorBtn', function () {
    var product_id = "{{$product->id}}";
    var prod_color_id = $(this).val();
    var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();

    if (qty <= 0) {
      alert('Quantity is required');
      return false;
    }

    var data = {
      'product_id': product_id,
      'qty': qty
    };

    $.ajax({
      type: "POST",
      url: "/back/product-color/" + prod_color_id,
      data: data,
      success: function (response) {
        alert(response.message);
      }
    });


  });

  $(document).on('click', '.deleteProductColorBtn', function () {
    var prod_color_id = $(this).val();
       var thisClick=$(this);


    $.ajax({
      type: "GET",
      url: "/back/product-color/"+prod_color_id+"/delete",

      success: function (response) {
        thisClick.closest('.prod-color-tr').remove();
        alert(response.message);
      }
    });
  });








});




</script> --}}


<script>

    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).on('click', '.updateProductSizeBtn', function () {
        var product_id = "{{$product->id}}";
        var prod_size_id = $(this).val();
        var qty = $(this).closest('.prod-size-tr').find('.productSizeQuantity').val();

        if (qty <= 0) {
          alert('Quantity is required');
          return false;
        }

        var data = {
          'product_id': product_id,
          'qty': qty
        };

        $.ajax({
          type: "POST",
          url: "/back/product-size/" + prod_size_id,
          data: data,
          success: function (response) {
            alert(response.message);
          }
        });


      });

      $(document).on('click', '.updateProductExtraBtn', function () {
        var product_id = "{{$product->id}}";
        var prod_size_id = $(this).val();
        var extra = $(this).closest('.prod-size-tr').find('.productExtraPrice').val();

        // if (qty <= 0) {
        //   alert('price is required');
        //   return false;
        // }

        var data = {
          'product_id': product_id,
          'extra_price': extra
        };

        $.ajax({
          type: "POST",
          url: "/back/product-extra/" + prod_size_id,
          data: data,
          success: function (response) {
            alert(response.message);
          }
        });


      });

      $(document).on('click', '.deleteProductSizeBtn', function () {
        var prod_size_id = $(this).val();
           var thisClick=$(this);
          // var product_id = "{{$product->id}}";

        $.ajax({
          type: "GET",
          url: "/back/product-size/"+prod_size_id+"/delete",

          success: function (response) {
            thisClick.closest('.prod-size-tr').remove();
            alert(response.message);
          }
        });
      });








    });




    </script>



@endsection
























