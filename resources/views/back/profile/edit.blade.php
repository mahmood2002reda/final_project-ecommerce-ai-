@extends('back.master')

@section('title','Admin profile page')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12" wire:poll.10s>
            @if(session('message'))
               <div class="alert @if(session('message_type') === 'error') alert-warning @else alert-success @endif">
                  {{ session('message') }}
               </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>My profile
                        <a href="{{route('back.admin.profile')}}" class="btn btn-danger text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form method='POST' action="{{route('back.admin.info.update')}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name"> Name</label>
                            <input value="{{$Admin->name}}" type="text" class="form-control" name="name" placeholder=" Name">

                            @error('name')
                                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">email</label>
                            <input value="{{$Admin->email}}" type="text" class="form-control" name="email" placeholder="email">

                            @error('email')
                                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>



                       </br>
                        <div class="form-group">

                        <button type="submit" class="btn btn-primary">update </button>
                    </div>
                    </form>
                  {{-- {{$Admins->links()}} --}}
                </div>
            </div>
        </div>
    </div>

@endsection
