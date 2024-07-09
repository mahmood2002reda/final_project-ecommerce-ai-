@extends('back.master')

@section('title','back home page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col-md-12" wire:poll.10s>
            @if(session('message'))
            <div class="alert alert-success">



                {{session('message')}}




            </div>

          @endif

          <div class="card">

              <div class="card-header">

                     <h4>Sub categories

                       <a href="{{url('back/category/')}}" class="btn btn-danger btn-sm text-white float-end">Back</a>

                     </h4>



              </div>

              <div class="card-body">



                <table class="table table-bordered table-striped">

                    <thead>

                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Active</th>
                                <th>Action</th>

                            </tr>


                    </thead>

                    <tbody>

                              <?php $i = 0; ?>
                             @foreach($categories as $category)
                             <?php $i++ ?>
                                   <tr>

                                         <td>{{$i}}</td>
                                         <td>{{$category->name}}</td>
                                         <td>{{$category->active=='1'?'visible':'hidden'}}</td>


                                         <td>
{{--
                                             <a href="{{ route('back.subcategory.create', ['category' => $category->id]) }}"
                                                 class="btn btn-primary btn-sm">Create Subcategory</a>
                                                 <a href="{{ route('back.subcategory.show', ['category' => $category->id]) }}"
                                                     class="btn btn-primary btn-sm">show subcategories</a> --}}
                                              <a href="{{url('back/category/'.$category->id.'/edit')}}" class="btn btn-success btn-sm">Edit</a>
                                              <a href="{{url('back/category/'.$category->id.'/delete-subcategory')}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete this data?')">Delete</a>

                                         </td>







                                   </tr>


                               @endforeach


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

@endsection
