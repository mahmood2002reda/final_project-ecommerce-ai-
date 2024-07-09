
<div class="container-xxl flex-grow-1 container-p-y">

    @include('livewire.admin.brands.modal-form')


  <div class="row" wire:poll.10s>






     <div class="col-md-12" >


            <!-- Rest of the Livewire component template code -->
            @if(session('message'))
               <div class="alert @if(session('message_type') === 'error') alert-warning @else alert-success @endif">
                  {{ session('message') }}
               </div>
           @endif



            <!-- Rest of the template code -->


             <div class="card">

                <div class="card-header">
                    <h4 class="d-flex align-items-center justify-content-between">
                        <span>Brand list</span>
                        <div style="display: flex; align-items: center;">
                            <form method="get" action="{{route('back.brands.search')}}">
                                @csrf
                                <div style="display: flex; align-items: center;">
                                    <input type="search" name="query" class="form-control form-control-sm rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" style="margin-right: 4px;" />
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Search</button>
                                </div>
                            </form>
                        </div>
                        <a href="" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="menu-link btn btn-primary btn-sm">
                            <div data-i18n="Under Maintenance">Add brand</div>
                          </a>
                    </h4>
                </div>



                   <div class="card-body">

                        <table class="table table-borderd table-striped ">
                             <thead>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Slug</th>
                                 <th>Vendor</th>
                                 {{-- <th>category</th> --}}
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
                                             <td>{{ $brand->vendor->name }}</td>
                                             {{-- <td>{{ $brand->category->name }}</td> --}}
                                             <td>{{$brand->active=='1'?'visible':'hidden'}}</td>


                                             <td>

                                                <a href="{{url('back/brands/'.$brand->id.'/edit')}}" class="btn btn-success btn-sm ">Edit</a>

                                                <a href="" data-bs-toggle="modal" wire:click="deleteBrand({{$brand->id}})"    data-bs-target="#deleteModal" class="btn btn-danger btn-sm "  >Delete</a>

                                             </td>







                                       </tr>

                                  @empty
                                     <tr>

                                        <td colspan="5">No Brands Found</td>

                                     </tr>



                                   @endforelse


                             </tbody>
                        </table>
                        <div>{{$brands->links()}}</div>
                   </div>
             </div>
     </div>







  </div>

</div>









