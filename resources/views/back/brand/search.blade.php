
@extends('back.master')
@section("content")

<div class="container-xxl flex-grow-1 container-p-y">
 <div class="row">
 <div class="col-md-12">
 <div class="card">
   <div class="card-header">
            <h4>Result for brands</h4>
            <a href="{{url('back/brands')}}" class="btn btn-danger text-white float-end">Back</a>
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
           <table class="table table-bordered table-striped">

            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Active</th>
                <th>Action</th>
            </thead>

            <tbody>


                 <?php $i=0;?>
                @forelse($brands as $brand)
                <?php $i++;?>
                      <tr>

                            <td>{{$i}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->slug}}</td>
                            <td>{{$brand->active=='1'?'visible':'hidden'}}</td>


                            <td>

                               <a href="{{url('back/brands/'.$brand->id.'/edit')}}" class="btn btn-success btn-sm ">Edit</a>

                               <a href="{{url('back/brands/'.$brand->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure, you want to delete this data?')">Delete</a>

                            </td>







                      </tr>

                 @empty
                    <tr>

                       <td colspan="5">No Brands Found</td>

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
