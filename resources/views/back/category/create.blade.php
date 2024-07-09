@extends('back.master')

@section('title','back home page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">

           <div class="row">
                 <div class="col-md-12">

                   <div class="card">

                       <div class="card-header">

                              <h4>Add Category

                                <a href="{{url('back/category')}}" class="btn btn-danger text-white float-end">Back</a>

                              </h4>



                       </div>

                       <div class="card-body">


                               <form action="{{url('back/category')}}" method="post" enctype="multipart/form-data">

                                       @csrf
                                         <div class="row">
                                                 <div class="col-md-6 mb-3">

                                                     <label for="">Name</label>

                                                     <input type="text" name="name" class="form-control"/>
                                                     @error('name') <small class="text-danger">{{$message}}</small>  @enderror

                                                </div>

                                              <div class="col-md-6 mb-3">

                                                 <label for="">slug</label>

                                                   <input type="text" name="slug" class="form-control"/>
                                                   @error('slug') <small class="text-danger">{{$message}}</small>  @enderror

                                               </div>
                                                <div class="col-md-12 mb-3">
                                                     <label for="">Description</label>
                                                    <textarea name="description" id=""  rows="3" class="form-control"></textarea>
                                                    @error('description') <small class="text-danger">{{$message}}</small>  @enderror
                                                </div>

                                              <div class="col-md-6 mb-3">
                                                  <label for="">Image</label>
                                                   <input type="file" name="image" class="form-control"/>
                                                   @error('image') <small class="text-danger">{{$message}}</small>  @enderror
                                               </div>

                                                 <div class="col-md-6 mb-3">
                                                 </br>
                                                   <label for="">Active</label>
                                                   <input type="checkbox" name="active"/>
                                               </div>
                                               <br>
                                               <div class="col-md-12 mb-3">
                                                   <h4>SEO Tags</h4>
                                               </div>
                                              <div class="col-md-6 mb-3">
                                                   <label for="">Meta Title</label>
                                                   <input type="text" name="meta_title" class="form-control"/>
                                                   @error('meta_title') <small class="text-danger">{{$message}}</small>  @enderror
                                               </div>

                                                  <div class="col-md-12 mb-3">
                                                   <label for="">Meta Keyword</label>
                                                   <input type="text" name="meta_keyword" class="form-control"/>
                                                   @error('meta_keyword') <small class="text-danger">{{$message}}</small>  @enderror
                                               </div>

                                                   <div class="col-md-12 mb-3">
                                                     <label for="">meta-description</label>
                                                    <textarea name="meta_description" id=""  rows="3" class="form-control"></textarea>
                                                    @error('meta_description') <small class="text-danger">{{$message}}</small>  @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <button type="submit" class="btn btn-primary float-end">save</button>
                                                </div>


                                          </div>





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
