<div>
    {{-- Do your work, then step back. --}}
    <!-- Modal -->
<div   wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModal">delete category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
   <form wire:submit.prevent="destroyCategory" >
      <div class="modal-body">
        <h6>Are you sure you want to delete this data?</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary"  data-bs-dismiss="modal" >Yes delete</button>
      </div>
      </form>
    </div>
  </div>
</div>

    <div class="row"  wire:poll.10s>


                 <div class="col-md-12">

                    @if(session('message'))
                    <div class="alert @if(session('message_type') === 'error') alert-warning @else alert-success @endif">
                       {{ session('message') }}
                    </div>
                @endif









                   <div class="card">
                    <div class="card-header">
                        <h4 class="d-flex align-items-center justify-content-between">
                            <span>Category</span>
                            <div style="display: flex; align-items: center;">
                                <form method="get" action="{{route('back.category.search')}}">
                                    <div style="display: flex; align-items: center;">
                                        <input type="search" name="query" class="form-control form-control-sm rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" style="margin-right: 4px;" />
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Search</button>
                                    </div>
                                </form>
                            </div>
                            <a href="{{url('back/category/create')}}" class="btn btn-primary btn-sm">Add Category</a>
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

                                                                <a href="{{ route('back.subcategory.create', ['category' => $category->id]) }}"
                                                                    class="btn btn-primary btn-sm">Create Subcategory</a>
                                                                    <a href="{{ route('back.subcategory.show', ['category' => $category->id]) }}"
                                                                        class="btn btn-primary btn-sm">show subcategories</a>
                                                                 <a href="{{url('back/category/'.$category->id.'/edit')}}" class="btn btn-success btn-sm">Edit</a>
                                                                 <a href="" data-bs-toggle="modal" wire:click="deleteCategory({{$category->id}})"    data-bs-target="#deleteModal" class="btn btn-danger btn-sm"  >Delete</a>

                                                            </td>







                                                      </tr>


                                                  @endforeach


                                       </tbody>



                                 </table>

                          <div>


                                  {{$categories->links()}}


                          </div>




                       </div>






                   </div>


                 </div>



           </div>

</div>


<script>

import { Input, Ripple, initMDB } from "mdb-ui-kit";

initMDB({ Input, Ripple });
</script>

{{-- <style>
    .custom-search-button {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
</style> --}}
