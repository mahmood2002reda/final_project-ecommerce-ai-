@extends('back.master')

@section('title','Edit size page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">

           <div class="row">
                 <div class="col-md-12">

                   <div class="card">

                       <div class="card-header">

                              <h4>Edit size

                                <a href="{{url('back/sizes')}}" class="btn btn-danger text-white float-end">Back</a>

                              </h4>



                       </div>

                       <div class="card-body">


                               <form action="{{url('back/sizes/'.$size->id)}}" method="post" enctype="multipart/form-data">

                                       @csrf
                                       @method('PUT')
                                         <div class="row">
                                                 <div class="col-md-6 mb-3">

                                                     <label for="">Name</label>

                                                     <input type="text" name="size" class="form-control" value="{{$size->size}}"/>
                                                     @error('name') <small class="text-danger">{{$message}}</small>  @enderror

                                                </div>

                                              <div class="col-md-6 mb-3">

                                                 <label for="">code</label>

                                                   <input type="text" name="code" value="{{$size->code}}" class="form-control"/>
                                                   @error('slug') <small class="text-danger">{{$message}}</small>  @enderror

                                               </div>


                                                 <div class="col-md-6 mb-3">
                                                 </br>
                                                   <label for="">Active</label>
                                                   <input type="checkbox" name="active"  {{ $size->active =='1'?'checked':''}} />
                                               </div>




                                                <div class="col-md-12 mb-3">
                                                    <button type="submit" class="btn btn-primary float-end">update</button>
                                                </div>


                                          </div>





                               </form>





                       </div>






                   </div>


                 </div>



           </div>



              </div>

@endsection
