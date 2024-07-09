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

                     <h4>Edit slider
                       <a href="{{url('back/sliders')}}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                     </h4>
              </div>

              <div class="card-body">
                <form action="{{url('back/sliders/'.$slider->id)}}" method="POST" enctype="multipart/form-data" >

                    @csrf
                    @method('PUT')
                  <div class="mb-3">
                       <label for="">Title</label>
                       <input type="text" name="title" value="{{$slider->title}}" class="form-control">
                  </div>
                  @error('title') <small class="text-danger">{{$message}}</small>  @enderror
                  <div class="mb-3">
                    <label for="">description</label>
                    <textarea name="description" id="" class="form-control" rows="3">{{$slider->description}}</textarea>
                 </div>
                 @error('description') <small class="text-danger">{{$message}}</small>  @enderror
                 <div class="mb-3">
                    <label for="">Image</label>
                    <input type="file" name="image" id="" class="form-control"><br>
                    @if ($slider->image)
                    <img src="{{ asset($slider->image) }}" style="width: 70px; height: 70px;" alt="">
                @else
                    <img src="{{ asset('uploads/slider/image-not-found.png') }}" style="width: 90px; height: 90px;" alt="Image Not Found">
                @endif
                 </div>
                 @error('image') <small class="text-danger">{{$message}}</small>  @enderror
                 <div class="mb-3">
                  <label for="">status</label><br>
                   <input type="checkbox" name="active"  {{$slider->active=='1' ? 'checked':''}} style="width:30px;height:30px;">
                 </div>
                 @error('active') <small class="text-danger">{{$message}}</small>  @enderror
                 <div class="mb-3">
                    <button type="submit" class="btn btn-primary">update</button>
                 </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection
