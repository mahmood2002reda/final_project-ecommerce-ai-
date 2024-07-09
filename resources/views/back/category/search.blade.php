
{{-- @extends('back.master')

@section('title','search page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">



             <livewire:admin.category.search/>
                <!-- Order Statistics -->


                <!--/ Order Statistics -->

                <!-- Expense Overview -->

                <!--/ Expense Overview -->

                <!-- Transactions -->

                <!--/ Transactions -->
              </div>

@endsection --}}

  @extends('back.master')
@section("content")

<div class="container-xxl flex-grow-1 container-p-y">
 <div class="row">
 <div class="col-md-12">
 <div class="card">
   <div class="card-header">
            <h4>Result for Categories</h4>
            <a href="{{url('back/category')}}" class="btn btn-danger text-white float-end">Back</a>

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


        </div>

        <div class="card-body">

           <table class="table table-bordered table-striped">

            <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Active</th>
                        <th>category image</th>
                        <th>Action</th>


                    </tr>


            </thead>

            <tbody>


                <?php $i = 0; ?>
                @foreach($categories as $category)
                <?php $i++ ?>

                     <a href="detail/{{$category->id}}">
                           <tr>

                                 <td>{{$i}}</td>
                                 <td>{{$category->name}}</td>
                                 <td>{{$category->active=='1'?'visible':'hidden'}}</td>

                               <td>           @if ($category->image)
                                <img src="{{asset('/uploads/category/'.$category->image)}}"  width="70px" height="70px"   alt="">
                            @else
                                <img src="{{ asset('uploads/slider/image-not-found.png') }}" style="width: 70px; height: 70px;" alt="Image Not Found">
                            @endif</td>
                                 <td>

                                     <a href="{{ route('back.subcategory.create', ['category' => $category->id]) }}"
                                         class="btn btn-primary btn-sm">Create Subcategory</a>
                                         <a href="{{ route('back.subcategory.show', ['category' => $category->id]) }}"
                                             class="btn btn-primary btn-sm">show subcategories</a>
                                      <a href="{{url('back/category/'.$category->id.'/edit')}}" class="btn btn-success btn-sm">Edit</a>
                                      <a href="{{url('back/category/'.$category->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete this data?')">Delete</a>

                                 </td>







                           </tr>
                        </a>

                       @endforeach


            </tbody>



      </table>
  </div>
</div>
</div>
</div>
</div>
@endsection
