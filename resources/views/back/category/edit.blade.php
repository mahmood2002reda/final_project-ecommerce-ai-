@extends('back.master')

@section('title','back home page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">

           <div class="row">
                 <div class="col-md-12">

                   <div class="card">

                       <div class="card-header">

                              <h4>Edit Category

                                <a href="{{url('back/category')}}" class="btn btn-danger text-white float-end">Back</a>

                              </h4>



                       </div>

                       <div class="card-body">


                               <form action="{{url('back/category/'.$category->id)}}" method="post" enctype="multipart/form-data">

                                       @csrf
                                       @method('PUT')
                                         <div class="row">
                                                 <div class="col-md-6 mb-3">

                                                     <label for="">Name</label>

                                                     <input type="text" name="name" class="form-control" value="{{$category->name}}"/>
                                                     @error('name') <small class="text-danger">{{$message}}</small>  @enderror

                                                </div>

                                              <div class="col-md-6 mb-3">

                                                 <label for="">slug</label>

                                                   <input type="text" name="slug" value="{{$category->slug}}" class="form-control"/>
                                                   @error('slug') <small class="text-danger">{{$message}}</small>  @enderror

                                               </div>
                                                <div class="col-md-12 mb-3">
                                                     <label for="">Description</label>
                                                    <textarea name="description" id=""  rows="3" class="form-control">{{$category->description}}</textarea>
                                                    @error('description') <small class="text-danger">{{$message}}</small>  @enderror
                                                </div>

                                              <div class="col-md-6 mb-3">
                                                  <label for="">Image</label>
                                                   <input type="file" name="image" class="form-control"/>
                                                   <br>
                                                   @if ($category->image)
                                                   <img src="{{asset('/uploads/category/'.$category->image)}}"  width="70px" height="70px"   alt="">
                                               @else
                                                   <img src="{{ asset('uploads/slider/image-not-found.png') }}" style="width: 70px; height: 70px;" alt="Image Not Found">
                                               @endif
                                                   @error('image') <small class="text-danger">{{$message}}</small>  @enderror
                                               </div>

                                                 <div class="col-md-6 mb-3">
                                                 </br>
                                                   <label for="">Active</label>
                                                   <input type="checkbox" name="active"  {{ $category->active =='1'?'checked':''}} />
                                               </div>
                                               <br>
                                               <div class="col-md-12 mb-3">
                                                   <h4>SEO Tags</h4>
                                               </div>
                                              <div class="col-md-6 mb-3">
                                                   <label for="">Meta Title</label>
                                                   <input type="text" name="meta_title" class="form-control" value="{{$category->meta_title}}"/>
                                                   @error('meta_title') <small class="text-danger">{{$message}}</small>  @enderror
                                               </div>

                                                  <div class="col-md-12 mb-3">
                                                   <label for="">Meta Keyword</label>
                                                   <input type="text" name="meta_keyword" class="form-control" value="{{$category->meta_keyword}}"/>
                                                   @error('meta_keyword') <small class="text-danger">{{$message}}</small>  @enderror
                                               </div>

                                                   <div class="col-md-12 mb-3">
                                                     <label for="">meta-description</label>
                                                    <textarea name="meta_description" id=""  rows="3" class="form-control">{{$category->meta_description}}</textarea>
                                                    @error('meta_description') <small class="text-danger">{{$message}}</small>  @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <button type="submit" class="btn btn-primary float-end">update</button>
                                                </div>


                                          </div>





                               </form>

                               @if(isset($category))
                               <div class="mt-3">
                                   <a href="{{ route('back.subcategory.create', ['category' => $category->id]) }}"
                                       class="btn btn-primary btn-sm">Create Subcategory</a>
                               </div>
                               @endif



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
