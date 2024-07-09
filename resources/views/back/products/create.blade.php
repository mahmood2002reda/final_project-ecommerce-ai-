

@extends('back.master')

@section('title','back home page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y  " class="card sticky-top">

           <div class="row">
                 <div class="col-md-12">

                   <div class="card">

                       <div class="card-header">

                              <h4>Add Product

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
                        <form action="{{url('back/product')}}" method="post" enctype="multipart/form-data">
                         @csrf
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
                                <button class="nav-link" id="model-image-tab" data-bs-toggle="tab" data-bs-target="#model-image-tab-pane" type="button" role="tab" aria-controls="model-image-tab-pane" aria-selected="false" image>model-image</button>
                              </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false" image>product color</button>
                              </li>
                              {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="size-tab" data-bs-toggle="tab" data-bs-target="#size-tab-pane" type="button" role="tab" aria-controls="size-tab-pane" aria-selected="false" image>product size</button>
                              </li> --}}
                          </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                   <div class="mb3">

                                    <br>
                                      <label for="">Category</label>
                                         <select name="category_id" id="category" class="form-control">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}"> {{$category->name}} </option>
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
                                                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                          <br>
                                            <div class="mb3">
                                                <label for="">product name</label>
                                                <input type="text" name="name" id="" class="form-control">
                                            </div>
                                            <div class="mb3">
                                                <label for="">product slug</label>
                                                <input type="text" name="slug" id="" class="form-control">
                                            </div>


                                            <br>
                                            <div class="mb3">
                                                <label for="">Select Brand</label>
                                                <select name="brand_id" id="" class="form-control">
                                                    @if($brands->isNotEmpty()) {{-- Check if $brands is not empty --}}
                                                        @foreach ($brands as $brand)
                                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="" disabled>No brands available</option>
                                                    @endif
                                                </select>
                                            </div>
                                     <br>
                                     <div class="col-md-12 mb-3">
                                        <label for="">small description</label>
                                       <textarea name="small_description" id=""  rows="3" class="form-control"></textarea>
                                       @error('small_description') <small class="text-danger">{{$message}}</small>  @enderror
                                   </div>
                                   <div class="col-md-12 mb-3">
                                    <label for="">Description</label>
                                   <textarea name="description" id=""  rows="3" class="form-control"></textarea>
                                   @error('description') <small class="text-danger">{{$message}}</small>  @enderror
                               </div>




                                ...</div>
                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">.

                                <div class="mb3">
                                    <label for="">Meta titile</label>
                                    <input type="text" name="meta_title" id="" class="form-control">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="">Meta keyword</label>
                                   <textarea name="meta_keyword" id=""  rows="3" class="form-control"></textarea>
                                   @error('meta_keyword') <small class="text-danger">{{$message}}</small>  @enderror
                               </div>


                                <div class="col-md-12 mb-3">
                                    <label for="">Meta description</label>
                                   <textarea name="meta_description" id=""  rows="3" class="form-control"></textarea>
                                   @error('meta_description') <small class="text-danger">{{$message}}</small>  @enderror
                               </div>






                                ..</div>
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">..

                                <div class="row">
                                        <div class="col-md-5">
                                            <div class="mb3">
                                                <label for="original_price">Original Price</label>
                                                <input type="text" name="original_price" id="original_price" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb3">
                                                <label for="">product sku</label>
                                                <input type="text" name="sku" id="" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-5">
                                            <div class="mb3">
                                                <label for="trending">Trending</label><br>
                                                <input type="checkbox" name="trending" id="trending" style="width: 20px; height:20px;">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb3">
                                                <label for="active">Active</label><br>
                                                <input type="checkbox" name="active" id="active" style="width: 20px; height:20px;">
                                            </div>
                                        </div>










                                </div>







                                .</div>
                            <div class="tab-pane fade border p-3" id="model-image-tab-pane" role="tabpanel" aria-labelledby="model-image-tab" tabindex="0">.

                                         <div class="mb3">

                                              <label for="">Upload model Image</label>
                                                <input type="file" multiple name="model_image" id="" class="form-control"/>


                                         </div>


                           ..</div>
                           <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">.

                            <div class="mb3">

                                 <label for="">Upload Product Images</label>
                                   <input type="file" multiple name="image[]" id="" class="form-control"/>


                            </div>


                          ..</div>

                             <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">.

                                    <div class="mb3">

                                         <label for="">Select Color</label><br> <hr>
                                         <div class="row ">
                                            @forelse ($colors as $color )
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">
                                                    Color: <input type="checkbox" name="colors[{{$color->id}}]" id="" value="{{$color->id}}"/>  {{$color->color}} <br><br>
                                                    Sizes:
                                                    @foreach ($sizes as $size)
                                                    <div>
                                                        <input type="checkbox" name="sizes[{{$color->id}}][]" id="" value="{{$size->id}}" />
                                                        {{$size->size}}
                                                        Quantity: <input type="number" name="quantities[{{$color->id}}][{{$size->id}}]" style="  width:40px; height:20px; border: 1px solid #ccc; padding: 5px;" />

                                                    </div>
                                                    @endforeach

                                                </div>

                                            </div>
                                            {{-- <div class="col-md-3">
                                                <div class="p-2 border mb-3">
                                                    <label for="color">Color:</label><br>
                                                    <input type="checkbox" name="colors[{{$color->id}}]" id="color_{{$color->id}}" value="{{$color->id}}"/> {{$color->name}} <br><br>
                                                    <fieldset>
                                                        <legend>Sizes:</legend>
                                                        @foreach ($sizes as $size)
                                                        <div>
                                                            <input type="checkbox" name="sizes[{{$color->id}}][]" id="size_{{$size->id}}" value="{{$size->id}}" />
                                                            <label for="size_{{$size->id}}">{{$size->name}}</label>
                                                            Quantity: <input type="number" name="quantities[{{$color->id}}][{{$size->id}}]" style="width:40px; height:15px; border:1px solid" />
                                                            extraprice: <input type="number" name="extraprices[{{$color->id}}][{{$size->id}}]" style="margin-right:70px; width:40px; height:15px; border:1px solid" />
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-5">
                                                <div class="p-2 border mb-3">
                                                    <label for="color">Color:</label>
                                                    <input type="checkbox" name="colors[{{$color->id}}]" id="color_{{$color->id}}" value="{{$color->id}}"/> {{$color->name}} <br><br>
                                                    <fieldset>
                                                        <legend>Sizes:</legend>
                                                        @foreach ($sizes as $size)
                                                        <div class="size-input">
                                                            <label for="size_{{$size->id}}">{{$size->name}}</label>
                                                            <input type="checkbox" name="sizes[{{$color->id}}][]" id="size_{{$size->id}}" value="{{$size->id}}" />
                                                            Quantity: <input type="number" name="quantities[{{$color->id}}][{{$size->id}}]" style="width:40px; height:20px; border:1px solid" />
                                                            Extra Price: <input type="number" name="extraprices[{{$color->id}}][{{$size->id}}]" style="width:40px; height:20px; border:1px solid" /><br><br>
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                </div>
                                            </div> --}}


                                            {{-- <div class="col-md-3">
                                                <div class="p-2 border rounded mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="colors[{{$color->id}}]" id="" value="{{$color->id}}">
                                                        <label class="form-check-label">{{$color->name}}</label>
                                                    </div>
                                                    <hr>
                                                    <div class="mb-2">
                                                        <strong>Sizes:</strong>
                                                    </div>
                                                    @foreach ($sizes as $size)
                                                        <div class="form-row align-items-center mb-2">
                                                            <div class="col-auto">
                                                                <input class="form-check-input" type="checkbox" name="sizes[{{$color->id}}][]" id="" value="{{$size->id}}">
                                                                <label class="form-check-label">{{$size->name}}</label>
                                                            </div>
                                                            <div class="col-auto">
                                                                <label for="quantities[{{$color->id}}][{{$size->id}}]">Quantity:</label>
                                                                <input type="number" name="quantities[{{$color->id}}][{{$size->id}}]" class="form-control">
                                                            </div>
                                                            <div class="col-auto">
                                                                <label for="extraprices[{{$color->id}}][{{$size->id}}]">Extra Price:</label>
                                                                <input type="number" name="extraprices[{{$color->id}}][{{$size->id}}]" class="form-control" >
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-6 col-lg-4">
                                                <div class="p-2 border rounded mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="colors[{{$color->id}}]" id="" value="{{$color->id}}">
                                                        <label class="form-check-label">{{$color->name}}</label>
                                                    </div>
                                                    <hr>
                                                    <div class="mb-2">
                                                        <strong>Sizes:</strong>
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($sizes as $size)
                                                            <div class="col-6 col-sm-4 col-lg-6">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox" name="sizes[{{$color->id}}][]" id="" value="{{$size->id}}">
                                                                    <label class="form-check-label">{{$size->name}}</label>
                                                                </div>
                                                                <div class="form-row align-items-center">
                                                                    <div class="col-auto">
                                                                        <label for="quantities[{{$color->id}}][{{$size->id}}]">Quantity:</label>
                                                                        <input type="number" name="quantities[{{$color->id}}][{{$size->id}}]" style="height:30px; width:70px;" class="form-control">
                                                                    </div>
                                                                    <div class="col-auto mb-2">
                                                                        <label for="extraprices[{{$color->id}}][{{$size->id}}]">Extra Price:</label>
                                                                        <input type="number" name="extraprices[{{$color->id}}][{{$size->id}}]" style="height:30px; width:70px;" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-6 col-lg-4">
                                                <div class="p-2 border rounded mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="colors[{{$color->id}}]" id="" value="{{$color->id}}">
                                                        <label class="form-check-label">{{$color->name}}</label>
                                                    </div>
                                                    <hr>
                                                    <div class="mb-2">
                                                        <strong>Sizes:</strong>
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($sizes as $size)
                                                            <div class="col-6 col-sm-4 col-lg-6">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox" name="sizes[{{$color->id}}][]" id="" value="{{$size->id}}">
                                                                    <label class="form-check-label">{{$size->name}}</label>
                                                                </div>
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <label for="quantities[{{$color->id}}][{{$size->id}}]">Quantity:</label>
                                                                        <input type="number" name="quantities[{{$color->id}}][{{$size->id}}]" style="height: 30px; width: 70px;" class="form-control">
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <label for="extraprices[{{$color->id}}][{{$size->id}}]">Extra Price:</label>
                                                                        <input type="number" name="extraprices[{{$color->id}}][{{$size->id}}]" style="height: 30px; width: 70px;" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div> --}}
                                              {{-- <div class="col-md-6 col-lg-4"> -
                                                <div class="p-2 border rounded mb-3">
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="colors[{{$color->id}}]" id="" value="{{$color->id}}">
                                                    <label class="form-check-label">{{$color->name}}</label>
                                                  </div>
                                                  <hr>
                                                  <div class="mb-2">
                                                    <strong>Sizes:</strong>
                                                  </div>
                                                  <div style="overflow-x: auto;">
                                                    <table class="table table-borderless table-responsive">
                                                      <thead>
                                                        <tr>
                                                          <th>Size</th>
                                                          <th>Quantity</th>
                                                          <th>Extra Price</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        @foreach ($sizes as $size)
                                                        <tr>
                                                          <td>
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="checkbox" name="sizes[{{$color->id}}][]" id="" value="{{$size->id}}">
                                                              <label class="form-check-label">{{$size->name}}</label>
                                                            </div>
                                                          </td>
                                                          <td>
                                                            <input type="number" name="quantities[{{$color->id}}][{{$size->id}}]" style="height: 30px; width: 70px;" class="form-control">
                                                          </td>
                                                          <td>
                                                            <input type="number" name="extraprices[{{$color->id}}][{{$size->id}}]" style="height: 30px; width: 70px;" class="form-control">
                                                          </td>
                                                        </tr>
                                                        @endforeach
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                </div>
                                              </div> --}}
                                              {{-- <div class="col-md-6 col-lg-4">
                                                <div class="p-2 border rounded mb-3">
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="colors[{{$color->id}}]" id="" value="{{$color->id}}">
                                                    <label class="form-check-label">{{$color->name}}</label>
                                                  </div>
                                                  <hr>
                                                  <div class="mb-2">
                                                    <strong>Sizes:</strong>
                                                  </div>
                                                  <div style="overflow-x: auto;">
                                                    <table class="table table-borderless table-responsive">
                                                      <thead>
                                                        <tr>
                                                          <th>Size</th>
                                                          <th>Quantity</th>
                                                          <th>Extra Price</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        @foreach ($sizes as $size)
                                                        <tr>
                                                          <td>
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="checkbox" name="sizes[{{$color->id}}][]" id="" value="{{$size->id}}">
                                                              <label class="form-check-label">{{$size->name}}</label>
                                                            </div>
                                                          </td>
                                                          <td class="col-md-2">
                                                            <input type="number" name="quantities[{{$color->id}}][{{$size->id}}]" style="" class="form-control">
                                                          </td>
                                                          <td class="col-md-2">
                                                            <input type="number" name="extraprices[{{$color->id}}][{{$size->id}}]" style="" class="form-control">
                                                          </td>
                                                        </tr>
                                                        @endforeach
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                </div>
                                              </div> --}}

                                            @empty
                                            <div class="col-md-12">
                                             <h1>No colors found</h1>

                                            </div>

                                            @endforelse
                                             <hr>

                                         </div>



                                    </div>


                           ..</div>
                           {{-- <div class="tab-pane fade border p-3" id="size-tab-pane" role="tabpanel" aria-labelledby="size-tab" tabindex="0">.

                            <div class="mb3">

                                 <label for="">Select size</label><br> <hr>
                                 <div class="row ">
                                    @forelse ($sizes as $size )
                                    <div class="col-md-3">
                                        <div class="p-2 border mb-3">
                                            size: <input type="checkbox"  name="sizes[{{$size->id}}]" id="" value="{{$size->id}}"/>  {{$size->name}} <br><br>
                                            Quantity: <input type="number"  name="sizequantity[{{$color->id}}]" style="width:40px; height:20px; border:1px solid" />

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


                   ..</div> --}}



                       </div>





                          <div><button type="submit" class="btn btn-primary">Submit</button></div>

                        </form>



                </div>






             </div>


         </div>



           </div>




                <!-- Order Statistics -->


                <!--/ Order Statistics -->

                <!-- Expense Overview -->

                <!--/ Expense Overview -->

                <!-- Transactions -->

                <!--/ Transactions -->
              </div>

@endsection

{{--
@php
use App\Models\Category;
$subcategoryMap = [];

// Fetch the category and subcategory mappings from the database
$categories = Category::all();

foreach ($categories as $category) {
    $subcategoryMap[$category->id] = $category->subcategories->pluck('id')->toArray();
}
@endphp

<script>
    // Get the category and subcategory select elements
    var categorySelect = document.getElementById('category');
    var subcategorySelect = document.getElementById('subcategory');

    // Create an object to map category IDs to their corresponding subcategories
    var subcategoryMap = @json($subcategoryMap);

    // Update the subcategory options when the category selection changes
    categorySelect.addEventListener('change', function() {
        var categoryId = this.value;

        // Clear the subcategory select options
        subcategorySelect.innerHTML = '';

        // Get the subcategories for the selected category
        var subcategories = subcategoryMap[category_id] || [];

        // Create new option elements and append them to the subcategory select
        subcategories.forEach(function(subcategory_id) {
            var option = document.createElement('option');
            option.value = subcategoryId;
            option.textContent = 'Subcategory ' + subcategory_id; // Replace with your actual subcategory name
            subcategorySelect.appendChild(option);
        });
    });
</script> --}}
