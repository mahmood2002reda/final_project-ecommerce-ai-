@extends('back.master')

@section('title','Add vendor page')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">

           <div class="row">
                 <div class="col-md-12">

                   <div class="card">

                       <div class="card-header">

                              <h4>Add user

                                <a href="{{url('back/users')}}" class="btn btn-danger text-white float-end">Back</a>

                              </h4>



                       </div>

                       <div class="card-body">


                               <form action="{{url('back/users')}}" method="post" enctype="multipart/form-data">

                                       @csrf
                                         <div class="row">
                                            @if(session('message'))
                                            <div class="alert @if(session('message_type') === 'error') alert-warning @else alert-success @endif">
                                               {{ session('message') }}
                                            </div>
                                         @endif

                                                 <div class="col-md-6 mb-3">

                                                     <label for="">Name</label>

                                                     <input type="text" name="name" class="form-control"/>
                                                     @error('name') <small class="text-danger">{{$message}}</small>  @enderror

                                                </div>

                                              <div class="col-md-6 mb-3">

                                                 <label for="">email</label>

                                                   <input type="email" name="email" class="form-control"/>
                                                   @error('email') <small class="text-danger">{{$message}}</small>  @enderror

                                               </div>

                                               <div class="col-md-6 mb-3">
                                                <label for="">Password</label>
                                                <input type="password" name="password" class="form-control"/>
                                                @error('password') <small class="text-danger">{{$message}}</small>  @enderror

                                                   <br> <br>
                                                <div class="col-md-12 mb-3">
                                                    <button type="submit" class="btn btn-primary float-end-right">save</button>
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
