@extends('back.master')
@section("content")

<div class="container-xxl flex-grow-1 container-p-y">
 <div class="row">
 <div class="col-md-12">
    @if ($errors->any())

    <div class="alert alert-warning">
                @foreach ($errors->all() as $error )
                    <div>{{$error}}</div>
                @endforeach
    </div>

   @endif
 <div class="card">
   <div class="card-header">
            <h4>Result for products</h4>
            <a href="{{url('back/product')}}" class="btn btn-danger text-white float-end">Back</a>
     </div>
            {{--
            @foreach($categories as $category)
            <div class="searched-item">
              <a href="detail/{{$category->id}}">
                <img src="{{asset('/uploads/category/'.$category->image)}}"  width="60px" height="60px"   alt="">
               <div class="">
                <h2>{{$category->name}}</h2>
                <h5>{{$category->description}}</h5>
               </div>
              </a>
            </div>
           @endforeach --}}
           <div class="card-body">
            <table  class="table table-bordered table-striped">
                <thead>


                     <tr>
                          <th>ID</th>
                          <th>product name</th>
                          <th>Category</th>
                          <th>subcategory</th>
                          <th>price</th>
                          <th>quantity</th>
                          <th>status</th>
                          <th>Action</th>
                     </tr>


                </thead>


                <tbody>

                      <?php $i=0;?>
                     @forelse ($products as $product )
                           <?php $i++;?>
                        <tr>

                          <td>{{$i}}</td>
                          <td>{{$product->name}}</td>
                          <td>
                              @if ($product->categories()->exists())
                                  {{ $product->categories->first()->name }}
                              @else
                                  No category
                              @endif
                          </td>
                          <td>
                              @if ($product->categories()->exists())
                                  {{ $product->categories->last()->name }}
                              @else
                                  No category
                              @endif
                          </td>


                              <td>{{$product->original_price}}</td>
                              <td>{{$product->quantity}}</td>
                              <td>{{$product->active == '1' ? 'visible':'hidden'}}</td>
                              <td>
                                    <a href="{{url('back/product/'.$product->id.'/edit')}}" class="btn btn-success btn-sm">Edit</a>
                                     <a href="{{url('back/product/'.$product->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete this data?')">Delete</a>

                                </td>


                        </tr>

                     @empty

                      <tr>
                        <td colspan="7">No Products Available</td>
                      </tr>

                     @endforelse












                </tbody>






              </table>

  </div>
</div>
</div>
</div>
</div>
@endsection



