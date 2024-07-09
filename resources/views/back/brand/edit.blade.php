@extends('back.master')

@section('title','Edit brand page')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Brand
                        <a href="{{url('back/brands')}}" class="btn btn-danger text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('back/brands/'.$brand->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" value="{{$brand->name}}"/>
                                @error('name') <small class="text-danger">{{$message}}</small>  @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">slug</label>
                                <input type="text" name="slug" value="{{$brand->slug}}" class="form-control"/>
                                @error('slug') <small class="text-danger">{{$message}}</small>  @enderror
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <label for="category-input">Category</label>
                                <select class="form-control" id="vendor-input" name="category_id">
                                    <option value="">--Select category--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"{{ $category->id == $brand->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div> --}}
                            <div class="col-md-6 mb-3">
                                </br>
                                <label for="">Active</label>
                                <input type="checkbox" name="active" {{ $brand->active == '1' ? 'checked' : ''}} />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Vendor</label>
                                <select name="vendor_id" class="form-control">
                                    <option value="">Select Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ $vendor->id == $brand->vendor_id ? 'selected' : '' }}>
                                            {{ $vendor->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vendor_id') <small class="text-danger">{{ $message }}</small> @enderror
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
