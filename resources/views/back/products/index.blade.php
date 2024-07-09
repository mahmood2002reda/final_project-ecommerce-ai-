@extends('back.master')

@section('title','back home page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12" wire:poll.10s>
            @if(session('message'))
               <div class="alert @if(session('message_type') === 'error') alert-warning @else alert-success @endif">
                  {{ session('message') }}
               </div>
           @endif
            {{-- @if(session('message'))
            <div class="alert alert-success">



                {{session('message')}}




            </div>

          @endif --}}

          <div class="card">

              <div class="card-header">

                     <h4>products

                       <a href="{{url('back/product/create')}}" class="btn btn-primary btn-sm text-white float-end">Add Product</a>

                     </h4>
                     <div style="display: flex; align-items: center;">
                        <form method="get" action="{{route('back.product.search')}}">
                            <div style="display: flex; align-items: center;">
                                <input type="search" name="query" class="form-control form-control-sm rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" style="margin-right: 4px;" />
                                <button type="submit" class="btn btn-outline-danger btn-sm">Search</button>
                        </form>
                     </div>



              </div>

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







             {{-- <livewire:admin.category.index/> --}}
                <!-- Order Statistics -->


                <!--/ Order Statistics -->

                <!-- Expense Overview -->

                <!--/ Expense Overview -->

                <!-- Transactions -->

                <!--/ Transactions -->

              </div>
            </div>
          </div>
        </div>
    </div>

@endsection
