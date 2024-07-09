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

                     <h4>Add color
                       <a href="{{url('back/colors')}}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                     </h4>
              </div>

              <div class="card-body">
                <form action="{{url('back/colors')}}" method="POST">

                    @csrf
                  <div class="mb-3">
                       <label for="">Color Name</label>
                       <input type="text" name="color" class="form-control">
                  </div>
                 <div class="mb-3">
                  <label for="">status</label><br>
                   <input type="checkbox" name="active" style="width:30px;height:30px;">
                 </div>
                 <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                 </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection
